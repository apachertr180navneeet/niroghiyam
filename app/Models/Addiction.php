<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addiction extends Model
{
    use HasFactory;


    protected $table = 'addiction';

    protected $fillable = [
        'name',
        'status',
    ];
}
