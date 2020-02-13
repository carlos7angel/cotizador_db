<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_place', function (Blueprint $table) {

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('quotation_orders')->onDelete('cascade');
            $table->unsignedBigInteger('place_id');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->dateTime('date_start')->nullable();
            $table->dateTime('date_finish')->nullable();
            $table->dateTime('mount_start_date')->nullable();
            $table->dateTime('mount_finish_date')->nullable();
            $table->dateTime('dismount_start_date')->nullable();
            $table->dateTime('dismount_finish_date')->nullable();
            $table->integer('quantity')->nullable(); // only 1
            $table->float('price');
            $table->text('detail')->nullable();

            $table->primary(['order_id', 'place_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_place');
    }
}
