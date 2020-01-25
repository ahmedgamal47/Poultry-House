<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('buyerUserId');
            $table->unsignedInteger('productId');
            $table->float('productPrice');
            $table->integer('productWeight');
            $table->integer('productWeightType');
            $table->unsignedInteger('quantity');
            $table->string('number')->unique();
            $table->timestamp('date');
            $table->integer('status');
            $table->float('price');

            $table->index('buyerUserId');
            $table->index('productId');
            $table->foreign('buyerUserId')->references('id')->on('users');
            $table->foreign('productId')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
