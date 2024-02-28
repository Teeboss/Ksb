<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todayGames extends Model
{
    public $table = 'today_games';
       public $fillable = ["games", "fixture_id", "league_id", "odd", "oddTwo", "vendor","vendorTwo","header", "url", "urlTwo", "booking", "bookingTwo", "status"];
    use HasFactory;
 
}
