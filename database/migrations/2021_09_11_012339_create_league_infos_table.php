<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeagueInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('summoner_id')->unique()->constrained();
            $table->string('tier', 25);
            $table->string('rank', 5);
            $table->integer('league_points');
            $table->integer('wins');
            $table->integer('losses');
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
        Schema::dropIfExists('league_infos');
    }
}
