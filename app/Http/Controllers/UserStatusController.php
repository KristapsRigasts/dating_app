<?php

namespace App\Http\Controllers;




use App\Models\UserStatus;
use Illuminate\Support\Facades\Redirect;

class UserStatusController
{
    public function yes($id)
    {

        UserStatus::create([
            'user_id' => 1, //aut_user_id
            'interacted_user_id' => $id,
            'status' => 'yes'
        ]);

        return Redirect('/users');

    }

    public function no($id)
    {
        UserStatus::create([
            'user_id' => 1, //aut_user_id
            'interacted_user_id' => $id,
            'status' => 'yes'
        ]);

    }
}
