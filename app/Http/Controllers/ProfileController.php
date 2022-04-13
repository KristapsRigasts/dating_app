<?php

namespace App\Http\Controllers;

use App\Models\SearchRange;
use App\Models\User;
use App\Models\UserPicture;
use App\Models\UserProfile;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic;

class ProfileController extends Controller
{
    public function profile()
    {

        $userId =auth()->id();
        $user = UserProfile::where('user_id',$userId)->first();

        $profilePicture = UserPicture::where('id',$user->profile_picture_id)->first();

        return view ('profiles.profile',['user' => $user, 'picture' => $profilePicture]);
    }

    public function myProfile()
    {
        $userId =auth()->id();
        $user = UserProfile::where('user_id',$userId)->first();

        return view ('profiles.myprofile',['user' => $user]);
    }


    public function updateProfile(Request $request)
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

    public function myPictures()
    {
        $userPictures = UserPicture::where('user_id',auth()->id())->get();

        $profilePictureId = UserProfile::where('user_id',auth()->id())->first();

        $profilePicture = UserPicture::where('id',$profilePictureId->profile_picture_id)->first();

//        $pictures =[];
//
//        foreach($userPictures as $picture)
//        {
//            $pictures[] = 'storage/' . $picture->picture;
//
//        }


        return view ('profiles.mypicture',['pictures' => $userPictures, 'profilePicture'=>$profilePicture]);
    }

    public function uploadPicture(Request $request)
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

//        $request->validate([
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
//        ]);
//
//        $path = $request->file('image')->store('images',['disk'=>'public']);
////
////        $picture = ImageManagerStatic::make($image)->resize(400,400);
//
//        $userPicture = UserPicture::create([
//            'user_id' => auth()->id(),
//            'picture' => $path,
//        ]);
//
//
        UserStatus::where('interacted_user_id',auth()->id())->where('status', 'no')->delete();

        return redirect('/mypictures');
    }

    public function profilePicture($id)
    {

        UserProfile::where('user_id', auth()->id())
            ->update([
                'profile_picture_id' => $id
            ]);

        return redirect('/profile');
    }

    public function searchRange()
    {
        $userSearchRange = SearchRange::where('user_id',auth()->id())->first();

        return view ('profiles.searchrange',['search' => $userSearchRange]);
    }

    public function searchRangeUpdate(Request $request)
    {

//        $request->validate([
//            'ageFrom' => ['required', 'integer', "gte:18"],
//            'ageTill' => ['required', 'integer', "gte:18"],
//        ]);
//
//        $ageTill = $request->ageTill;
//
//        if($ageTill < $request->ageFrom)
//        {
//            $ageTill = 100;
//        }

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

    public function show($id)
    {
        $user = UserProfile::where('user_id',$id)->first();

        $pictures = UserPicture::where('user_id',$id)->get();

        return view ('profiles.userprofile',['user' => $user, 'pictures' => $pictures]);
    }



//    public function deletePicture($id)
//    {
//       $deleted = Flight::where('active', 0)->delete();
//        var_dump($id);
//        var_dump('here');
//
//    }

}
