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
        Schema::create('clubs', function (Blueprint $table) {
            $table->unsignedInteger("id");
            $table->primary("id");
            $table->string('name');
            $table->string('tla')->nullable();
            $table->string('venue')->nullable();
            $table->string('image')->nullable();
            $table->string('country_name')->nullable();
            $table->string('country_image')->nullable();
            $table->string('founded')->nullable();
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
        Schema::dropIfExists('clubs');
    }
};
