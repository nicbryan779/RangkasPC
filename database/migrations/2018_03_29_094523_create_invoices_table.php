<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('total_price')->unsigned();
            $table->tinyInteger('total_item');
            $table->string('status')->default('Not Paid');
            $table->string('payment_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->date('payment_date')->nullable();
            //$table->timestamps();
        });

        Schema::table('invoices', function($table){
           $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
