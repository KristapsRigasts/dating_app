<?php

namespace App\Http\Controllers;

use App\Jobs\UserMatchEmailJob;
use App\Models\SearchRange;
use App\Models\User;
use App\Models\UserPicture;
use App\Models\UserProfile;
use App\Models\UserStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;


class MatchingController extends Controller
{
    public function index(): View|Factory|Application
    {
        $userRange = SearchRange::where('user_id',auth()->id())->first();

        $correctUserId =[];

        $correctUserId[] = auth()->id();

        $userAgeRange = UserProfile::whereNotBetween('age',[$userRange->age_from,$userRange->age_till])->get();

        if($userAgeRange->isNotEmpty())
        {
            foreach($userAgeRange as $ageData)
            {
                $correctUserId[] = $ageData->user_id;
            }
        }

        $userGenderRange = UserProfile::where('gender', $userRange->gender)->get();

        if($userGenderRange->isNotEmpty())
        {
            foreach($userGenderRange as $genderData)
            {
                $correctUserId[] = $genderData->user_id;
            }
        }

        $userAlreadyInteracted = UserStatus::where('user_id', auth()->id())->get();

        if($userAlreadyInteracted->isNotEmpty())
        {
            foreach($userAlreadyInteracted as $interactedData)
            {
                $correctUserId[] = $interactedData->interacted_user_id;
            }
        }

        $usersForMatch = UserProfile::whereNotIn('user_id',$correctUserId)->get('user_id');

        $usersToChooseFrom = [];

        if($usersForMatch->isNotEmpty())
        {
            foreach($usersForMatch as $userForMatch)
            {
                $usersToChooseFrom[] = $userForMatch->user_id;
            }
            $randomUserId = $usersToChooseFrom[array_rand($usersToChooseFrom)];

            $randomUser = UserProfile::where('user_id',$randomUserId )->first();

            $profilePicture = UserPicture::where('id',$randomUser->profile_picture_id)->first();

            return view('matches.findmatch',['user' => $randomUser, 'picture' => $profilePicture ]);
        }
        else{
            return view('matches.notinrange');
        }
    }

    public function dislike($id): Redirector|RedirectResponse|Application
    {
        UserStatus::create([
            'user_id' => auth()->id(),
            'interacted_user_id' => $id,
            'status' => 'no'
        ]);

        return redirect('/findmypartner');
    }

    public function like($id): Factory|View|Redirector|Application|RedirectResponse
    {
        UserStatus::create([
            'user_id' => auth()->id(),
            'interacted_user_id' => $id,
            'status' => 'yes'
        ]);

        $matchesQuery = UserStatus::where('interacted_user_id', auth()->id())->where('status', 'yes')->get();

        $matches = [];

        foreach($matchesQuery as $data)
        {
            $matches[] = $data->user_id;
        }

        if(!in_array($id, $matches))
        {
            return redirect('/findmypartner');

        } else{

            $userEmail =User::where('id', auth()->id())->first();

            $activeUser= UserProfile::where('user_id',auth()->id() )->first();

            $activeUserName = $activeUser->name . " " . $activeUser->surname;

            $matchUserEmail = User::where('id', $id)->first();

            $matchUser = UserProfile::where('user_id',$id )->first();

            $matchUserName = $matchUser->name . " " . $matchUser->surname;

            $this->dispatch(new UserMatchEmailJob($userEmail->email,$activeUserName, $matchUserEmail->email,$matchUserName));

            $profilePicture = UserPicture::where('id',$matchUser->profile_picture_id)->first();

            return view('matches.match',['user' => $matchUser, 'picture' => $profilePicture ]);
        }
    }

    public function userMatches(): View|Factory|Application
    {
        $matchesUserId = [];

        $usersThatLiked =[];

        $userWasLiked = UserStatus::where('interacted_user_id',auth()->id())->where('status', 'yes')->get();

        foreach ($userWasLiked as $userLikedData)
        {
            $usersThatLiked [] = $userLikedData->user_id;
        }

        $userLiked = UserStatus::where('user_id',auth()->id())->where('status', 'yes')->orderBy('created_at','desc')->get();
        foreach ($userLiked as $userData)
        {
            if(in_array($userData->interacted_user_id,$usersThatLiked))
            {
                $matchesUserId[] = $userData->interacted_user_id;
            }
        }

        $matchedUsers = UserProfile::with('pictures')->whereIn('user_id', $matchesUserId)->get();

        return view('matches.mymatches',['users' => $matchedUsers]);
    }
}
