<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\MatchingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';

Route::get('/profile', [ProfileController::class, 'profile'])->middleware('auth')->name('profile');

Route::get('/myprofile', [ProfileController::class, 'myProfile'])->middleware('auth')->name('myProfile');

Route::post('/profileupdate', [ProfileController::class, 'updateProfile'])->middleware('auth')->name('profileUpdate');

Route::get('/mypictures', [ProfileController::class, 'mypictures'])->middleware('auth')->name('myPictures');
//Route::get('/mypictures/{id}/delete', [ProfileController::class, 'deletePicture'])->middleware('auth');
Route::post('/mypictures/upload', [ProfileController::class, 'uploadPicture'])->middleware('auth')->name('uploadPicture');
Route::get('/mypictures/{id}/profile', [ProfileController::class, 'profilePicture'])->middleware('auth')->name('profilePicture');

Route::get('/profile/searchrange', [ProfileController::class, 'searchRange'])->middleware('auth')->name('searchRange');
Route::post('/profile/searchrange', [ProfileController::class, 'searchRangeUpdate'])->middleware('auth')->name('searchRangeUpdate');

Route::get('/findmypartner', [MatchingController::class , 'index'])->middleware('auth')->name('findMatch');
Route::get('/findmypartner/{id}/no', [MatchingController::class , 'declined'])->middleware('auth');
Route::get('/findmypartner/{id}/yes', [MatchingController::class , 'accepted'])->middleware('auth');



//Route::get('say',[HelloController::class,'say']);
//
//Route::get('sayhello',[HelloController::class,'sayHello']);
//
//Route::get('saybye',[HelloController::class,'sayBye']);


