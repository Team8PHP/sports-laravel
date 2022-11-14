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
        Schema::create('group_standings', function (Blueprint $table) {
            $table->unsignedInteger('comp_id');
            $table->foreign('comp_id')->references('id')->on('competetions');
            $table->unsignedInteger('club_id');
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->integer('position');
            $table->enum('group_name', [
                'GROUP_A' , 'GROUP_B' , 'GROUP_C' , 'GROUP_D' , 'GROUP_E' , 'GROUP_F' ,
                'GROUP_G' , 'GROUP_H' , 'GROUP_I' , 'GROUP_J' , 'GROUP_K' , 'GROUP_L'
            ]);
            $table->integer('goals_scored');
            $table->integer('goals_against');
            $table->string('form');
            $table->integer('matches_played');
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
        Schema::dropIfExists('group_standings');
    }
};
