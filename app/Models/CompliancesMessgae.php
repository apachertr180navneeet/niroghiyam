<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompliancesMessgae extends Model
{
    use HasFactory;

    protected $table = 'complaint_messgae';

    protected $fillable = [
        'complaint_id',
        'user_id',
        'message_user_type',
        'message',
        'readed',
        'message_at'
    ];
}
