<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePCsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_cs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('ram_id')->unsigned();
            $table->integer('vga_id')->unsigned();
            $table->integer('processor_id')->unsigned();
            $table->integer('mobo_id')->unsigned();
            $table->integer('hdd_id')->unsigned();
            $table->integer('ssd_id')->unsigned();
            $table->integer('optical_id')->unsigned();
            $table->integer('psu_id')->unsigned();
            $table->integer('fan1_id')->unsigned();
            $table->integer('fan2_id')->unsigned();
            $table->integer('network_id')->unsigned();
            $table->integer('casing_id')->unsigned();
            $table->integer('monitor_id')->unsigned();


//            $table->timestamps();
        });

        Schema::table('p_cs', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ram_id')->references('id')->on('products');
            $table->foreign('vga_id')->references('id')->on('products');
            $table->foreign('processor_id')->references('id')->on('products');
            $table->foreign('mobo_id')->references('id')->on('products');
            $table->foreign('hdd_id')->references('id')->on('products');
            $table->foreign('ssd_id')->references('id')->on('products');
            $table->foreign('optical_id')->references('id')->on('products');
            $table->foreign('fan1_id')->references('id')->on('products');
            $table->foreign('fan2_id')->references('id')->on('products');
            $table->foreign('network_id')->references('id')->on('products');
            $table->foreign('casing_id')->references('id')->on('products');
            $table->foreign('monitor_id')->references('id')->on('products');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_cs');
    }
}
