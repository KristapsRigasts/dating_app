<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\User;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(): Factory|View|Application
    {

        return view('users');
    }

    public function play()
    {
        $userId = 1;

        //check also for gender

        $interactedUsers= DB::table('user_statuses')
            ->where('user_id', [$userId])
            ->get('interacted_user_id');
        var_dump($interactedUsers);die;

        // user_id not in user_status interacted_user_id

        $user = DB::table('users')
            ->whereNotIn('id', [$userId])
            ->first();

        return view('play',['user' => $user]);
    }


}
