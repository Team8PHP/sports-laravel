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
            $table->unsignedBigInteger("Id");
            $table->primary("Id");
            $table->unsignedInteger('home_id');
            $table->foreign('home_id')->references('id')->on('clubs');
            $table->unsignedInteger('away_id');
            $table->foreign('away_id')->references('id')->on('clubs');
            $table->string('status');
            $table->unsignedInteger('comp_id');
            $table->foreign('comp_id')->references('id')->on('competetions');
            $table->string('stage');    
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
