<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;


    protected $table = 'setting';

    protected $fillable = [
        'title',
        'vedio',
        'andriod_app_link',
        'ios_app_link',
        'app_logo',
        'andqr',
        'iosqrcode',
        'vaccinationchart',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'razor_pay_key'
    ];
}
