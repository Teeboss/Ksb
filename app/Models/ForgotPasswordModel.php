<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\forgotPasswordMail;

class ForgotPasswordModel extends Model
{
    use HasFactory;

    public $fillable = ['email', 'pin'];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public static function boot()
    {

        parent::boot();

        static::created(function ($item) {

            $adminEmail = $item->email;
            Mail::to($adminEmail)->send(new forgotPasswordMail($item));
        });
    }
}
