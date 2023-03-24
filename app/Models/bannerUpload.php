<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bannerUpload extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'bannertype',
        'uploader',
        'url'
    ];
}
