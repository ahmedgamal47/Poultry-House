<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->text('image');
            $table->float('price');
            $table->integer('weight');
            $table->integer('weightType');
            $table->unsignedInteger('companyId');
            $table->string('validity');
            $table->date('productionDate');
            $table->text('usage');
            $table->unsignedInteger('categoryId');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->index('companyId');
            $table->index('categoryId');
            $table->foreign('companyId')->references('id')->on('users');
            $table->foreign('categoryId')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
