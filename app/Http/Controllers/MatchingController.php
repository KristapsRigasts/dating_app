<?php

namespace App\Http\Controllers;

use App\Models\UserPicture;
use App\Models\UserProfile;
use App\Models\UserStatus;
use Illuminate\Support\Facades\DB;

class MatchingController extends Controller
{
    public function index()
    {
        $userRange = DB::table('search_ranges')
            ->where('user_id',auth()->id())
            ->first();

        //jaatrod profili kuri nav age, gender range!
        // jaatrod profili ar kuriem ir jau interaktots
        //jaizsledz savu profilu!
        //randoma viens jaizvelas

        $correctUserId =[];

        $correctUserId[] = auth()->id();

        $userAgeRange = DB::table('user_profiles')
            ->whereNotBetween('age',[$userRange->age_from,$userRange->age_till])
            ->get();

        if($userAgeRange->isNotEmpty())
        {
            foreach($userAgeRange as $ageData)
            {
                $correctUserId[] = $ageData->user_id;
            }
        }

        $userGenderRange = DB::table('user_profiles')
            ->where('gender', $userRange->gender)
            ->get();

        if($userGenderRange->isNotEmpty())
        {
            foreach($userGenderRange as $genderData)
            {
                $correctUserId[] = $genderData->user_id;
            }
        }

        $userAlreadyInteracted = DB::table('user_statuses')
            ->where('user_id', auth()->id())
            ->get();

        if($userAlreadyInteracted->isNotEmpty())
        {
            foreach($userAlreadyInteracted as $interactedData)
            {
                $correctUserId[] = $interactedData->interacted_user_id;
            }
        }

        $usersForMatch = DB::table('user_profiles')
            ->whereNotIn('user_id',$correctUserId)
            ->get('user_id');


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

            return view('findmatch',['user' => $randomUser, 'picture' => $profilePicture ]);
        }
        else{
            return view('notinrange');

        }


    }

    public function declined($id)
    {
        UserStatus::create([
            'user_id' => auth()->id(),
            'interacted_user_id' => $id,
            'status' => 'no'
        ]);

        return redirect('/findmypartner');
    }

    public function accepted($id)
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
            $matchUser = UserProfile::where('user_id',$id )->first();

            $profilePicture = UserPicture::where('id',$matchUser->profile_picture_id)->first();

            return view('match',['user' => $matchUser, 'picture' => $profilePicture ]);
        }

    }
}
