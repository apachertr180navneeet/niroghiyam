<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class user_detail extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = 'user_detail';

    protected $fillable = [
        'user_id',
        'address',
        'pincode',
        'city',
        'country',
        'state',
        'membership_id',
        'memebership_start_date',
        'memebership_end_date',
        'gender',
        'blood_group',
        'allergy',
        'vecination',
        'date_of_birth',
        'addiction'
    ];
}
