<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('today_games', function (Blueprint $table) {
            $table->id();
            $table->mediumText('games');
            $table->string('fixture_id');
            $table->string('league_id');
            $table->string('odd');
            $table->string('oddTwo');
            $table->string('vendor');
            $table->string('vendorTwo');
            $table->string('header');
            $table->string('url');
            $table->string('urlTwo');
            $table->string('booking');
            $table->string('bookingTwo');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('today_games');
    }
};
