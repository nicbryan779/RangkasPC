<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('name');
            $table->string('brand');
            $table->text('description');
            $table->string('gameplay');
            $table->integer('price')->unsigned();
            $table->integer('views')->unsigned()->default('0');
            $table->integer('stock')->unsigned()->default('0');
            $table->integer('sold')->default('0');
            $table->string('img')->default("default.png");
            $table->string('video')->nullable();
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
        Schema::dropIfExists('products');
    }
}
