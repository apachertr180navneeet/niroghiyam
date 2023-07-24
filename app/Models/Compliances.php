<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compliances extends Model
{
    use HasFactory;

    protected $table = 'complaint';

    protected $fillable = [
        'type',
        'titel',
        'description',
        'file',
        'userid'
    ];
}
