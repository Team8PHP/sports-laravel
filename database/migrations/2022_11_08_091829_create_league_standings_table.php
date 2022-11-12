<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_standings', function (Blueprint $table) {
            $table->unsignedInteger('comp_id');
            $table->foreign('comp_id')->references('id')->on('competetions');
            $table->unsignedInteger('club_id');
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->integer('position');
            $table->integer('goals_scored');
            $table->integer('goals_against');
            $table->string('form');
            $table->integer('matches_played');
            $table->integer('points');
            $table->integer('wins');
            $table->integer('losses');
            $table->integer('draws');
            $table->primary(['club_id','comp_id']);
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
        Schema::dropIfExists('league_standings');
    }
};
