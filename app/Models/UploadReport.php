<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadReport extends Model
{
    use HasFactory;

    protected $table = 'upload_report';

    protected $fillable = [
        'titel',
        'date',
        'file',
        'userid',
        'category_id',
        'status',
    ];
}
