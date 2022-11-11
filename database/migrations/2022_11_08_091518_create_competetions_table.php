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
        Schema::create('competetions', function (Blueprint $table) {
            $table->unsignedInteger("id");
            $table->primary("Id");
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('type')->nullable();
            $table->string('country')->nullable();
            $table->string('country_image')->nullable();
            $table->integer('current_matchday')->nullable();
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
        Schema::dropIfExists('competetions');
    }
};
