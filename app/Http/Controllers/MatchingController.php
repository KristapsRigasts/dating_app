<?php

namespace App\Http\Controllers;

use App\Models\UserPicture;
use App\Models\UserProfile;
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

        }

        $randomUserId = $usersToChooseFrom[array_rand($usersToChooseFrom)];


        $randomUser = UserProfile::where('user_id',$randomUserId )->first();

        $profilePicture = UserPicture::where('id',$randomUser->profile_picture_id)->first();

//check if profile has picture if no give blank picture



        return view('findmatch',['user' => $randomUser, 'picture' => $profilePicture ]);
    }
}
