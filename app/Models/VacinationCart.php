<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacinationCart extends Model
{
    use HasFactory;


    protected $table = 'vaccination_cart';

    protected $fillable = [
        'vaccination_name',
        'vacicnation_parente',
        'status',
    ];
}
