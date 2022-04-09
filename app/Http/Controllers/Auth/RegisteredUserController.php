<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SearchRange;
use App\Models\User;
use App\Models\UserPicture;
use App\Models\UserProfile;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'age' => ['required', 'integer', "gte:18"],
            'location' => ['required'],
            'information' => ['required'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        $user = User::create([
            'name' => $request->name ." " . $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $path = $request->file('image')->store('images',['disk'=>'public']);

        $userPicture = UserPicture::create([
            'user_id' => $user->id,
            'picture' => $path,
        ]);

        $userProfile = UserProfile::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'surname' => $request->surname,
            'age' => $request->age,
            'gender' => $request->gender,
            'location' => $request->location,
            'information' => $request->information,
            'profile_picture_id' => $userPicture->id,
        ]);

        SearchRange::create([
            'user_id' => $user->id,
            'gender' => $request->gender,
            'age_from' => 18,
            'age_till' => 100,
        ]);


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
