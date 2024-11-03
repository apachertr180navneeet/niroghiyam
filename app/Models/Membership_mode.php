<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership_mode extends Model
{
    use HasFactory;


    protected $table = 'membership_mode';

    protected $fillable = [
        'name',
        'description'
    ];
}
