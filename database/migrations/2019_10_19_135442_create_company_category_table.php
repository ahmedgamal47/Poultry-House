<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_category', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('companyId');
            $table->unsignedInteger('categoryId');

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
        Schema::dropIfExists('company_category');
    }
}
