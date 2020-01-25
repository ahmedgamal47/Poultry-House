<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoultryJamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poultry_jam', function (Blueprint $table) {
            $table->increments('id');
            $table->string('field')->nullable();
            $table->string('code')->nullable();
            $table->unsignedInteger('userId');
            $table->timestamps();

            $table->index('userId');
            $table->foreign('userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poultry_jam');
    }
}
