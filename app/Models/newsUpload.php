<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newsUpload extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'newstitle',
        'newsbody',
        'uploader',
    ];
}
