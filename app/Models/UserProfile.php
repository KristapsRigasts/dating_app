<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'age',
        'gender',
        'location',
        'information',
        'profile_picture_id',
    ];

    public function pictures()
    {
        return $this->hasMany(UserPicture::class,'user_id');
    }

}
