<?php

namespace App\Http\Controllers;

use App\Models\SearchRange;

use App\Models\UserPicture;
use App\Models\UserProfile;
use App\Models\UserStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ProfileController extends Controller
{
    public function profile(): View|Factory|Application
    {

        $userId =auth()->id();
        $user = UserProfile::where('user_id',$userId)->first();

        $profilePicture = UserPicture::where('id',$user->profile_picture_id)->first();

        return view ('profiles.profile',['user' => $user, 'picture' => $profilePicture]);
    }

    public function myProfile(): View|Factory|Application
    {
        $userId =auth()->id();
        $user = UserProfile::where('user_id',$userId)->first();

        return view ('profiles.myprofile',['user' => $user]);
    }


    public function updateProfile(Request $request): Redirector|RedirectResponse|Application
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', "gte:18"],
            'location' => ['required'],
            'information' => ['required']
        ]);

        UserProfile::where('user_id', auth()->id())
            ->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'age' => $request->age,
                'gender' => $request->gender,
                'location' => $request->location,
                'information' => $request->information
                ]);

        return redirect('/profile');
    }

    public function myPictures(): View|Factory|Application
    {
        $userPictures = UserPicture::where('user_id',auth()->id())->get();

        $profilePictureId = UserProfile::where('user_id',auth()->id())->first();

        $profilePicture = UserPicture::where('id',$profilePictureId->profile_picture_id)->first();

        return view ('profiles.mypicture',['pictures' => $userPictures, 'profilePicture'=>$profilePicture]);
    }

    public function uploadPicture(Request $request): Redirector|RedirectResponse|Application
    {

        if($request->has('image'))
        {
            foreach($request->file('image') as $imageData)
            {
                $path = $imageData->store('images',['disk'=>'public']);
                UserPicture::create([
                    'user_id' => auth()->id(),
                    'picture' => $path,
                ]);
            }
        }

        UserStatus::where('interacted_user_id',auth()->id())->where('status', 'no')->delete();

        return redirect('/mypictures');
    }

    public function profilePicture($id): Redirector|RedirectResponse|Application
    {
        UserProfile::where('user_id', auth()->id())
            ->update([
                'profile_picture_id' => $id
            ]);

        return redirect('/profile');
    }

    public function searchRange(): View|Factory|Application
    {
        $userSearchRange = SearchRange::where('user_id',auth()->id())->first();

        return view ('profiles.searchrange',['search' => $userSearchRange]);
    }

    public function searchRangeUpdate(Request $request)
    {
        $ageFrom = (int) $request->slider1;
        $ageTill = (int) $request->slider2;


        SearchRange::where('user_id', auth()->id())
            ->update([
                'age_from' => $ageFrom,
                'age_till' => $ageTill,
                'gender' => $request->gender
            ]);

        return redirect('/findmypartner');
    }

    public function show($id): View|Factory|Application
    {
        $user = UserProfile::where('user_id',$id)->first();

        $pictures = UserPicture::where('user_id',$id)->get();

        return view ('profiles.userprofile',['user' => $user, 'pictures' => $pictures]);
    }
}
