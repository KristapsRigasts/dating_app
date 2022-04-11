<?php

namespace App\Http\Controllers;

use App\Models\SearchRange;
use App\Models\UserPicture;
use App\Models\UserProfile;
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

        return view ('profile',['user' => $user, 'picture' => $profilePicture]);

    }

    public function myProfile()
    {
        $userId =auth()->id();
        $user = UserProfile::where('user_id',$userId)->first();

        return view ('myprofile',['user' => $user]);
    }

    /**
     * Handle an incoming update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

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


        return view ('mypicture',['pictures' => $userPictures, 'profilePicture'=>$profilePicture]);
    }

    public function uploadPicture(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        $path = $request->file('image')->store('images',['disk'=>'public']);
//
//

//        $picture = ImageManagerStatic::make($image)->resize(400,400);


        $userPicture = UserPicture::create([
            'user_id' => auth()->id(),
            'picture' => $path,
        ]);

//        UserProfile::where('user_id', auth()->id())
//            ->update([
//                'profile_picture_id' => $userPicture->id
//            ]);

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

        return view ('searchrange',['search' => $userSearchRange]);
    }

    public function searchRangeUpdate(Request $request)
    {
        $request->validate([
            'ageFrom' => ['required', 'integer', "gte:18"],
            'ageTill' => ['required', 'integer', "gte:18"],
        ]);

        $ageTill = $request->ageTill;

        if($ageTill < $request->ageFrom)
        {
            $ageTill = 100;
        }

        SearchRange::where('user_id', auth()->id())
            ->update([
                'age_from' => $request->ageFrom,
                'age_till' => $ageTill,
                'gender' => $request->gender
            ]);

        return redirect('/profile');
    }

//    public function deletePicture($id)
//    {
//       $deleted = Flight::where('active', 0)->delete();
//        var_dump($id);
//        var_dump('here');
//
//    }

}
