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
        Schema::create('matches', function (Blueprint $table) {
            $table->unsignedBigInteger("id");
            $table->primary("id");
            $table->unsignedInteger('home_id');
            $table->foreign('home_id')->references('id')->on('clubs');
            $table->unsignedInteger('away_id');
            $table->foreign('away_id')->references('id')->on('clubs');
            $table->enum('status', [
                'SCHEDULED' , 'TIMED' , 'IN_PLAY' , 'PAUSED' , 'EXTRA_TIME' , 'PENALTY_SHOOTOUT' , 'FINISHED' ,
                 'SUSPENDED' , 'POSTPONED' , 'CANCELLED' , 'AWARDED'
            ]);
            $table->unsignedInteger('comp_id');
            $table->foreign('comp_id')->references('id')->on('competetions');
            $table->enum('stage', [
                'REGULAR_SEASON','FINAL','THIRD_PLACE' ,'SEMI_FINALS' ,'QUARTER_FINALS' ,'LAST_16' ,'LAST_32' ,'LAST_64' ,
                'ROUND_4','ROUND_3' , 'ROUND_2' , 'ROUND_1' , 'GROUP_STAGE' , 'PRELIMINARY_ROUND' , 'QUALIFICATION' ,
                'QUALIFICATION_ROUND_1' , 'QUALIFICATION_ROUND_2' , 'QUALIFICATION_ROUND_3' , 'PLAYOFF_ROUND_1' , 'PLAYOFF_ROUND_2' ,
                 'PLAYOFFS', 'CLAUSURA' , 'APERTURA' , 'CHAMPIONSHIP' , 'RELEGATION' , 'RELEGATION_ROUND',
            ]);
            $table->date('date');
            $table->string('time');
            $table->integer('matchday');
            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();
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
        Schema::dropIfExists('matches');
    }
};
