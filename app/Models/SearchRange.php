<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchRange extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'age_from',
        'age_till',
    ];
}
