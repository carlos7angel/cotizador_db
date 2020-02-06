<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_service', function (Blueprint $table) {

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('quotation_orders')->onDelete('cascade');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_finish')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('days')->nullable();
            $table->float('price');
            $table->text('detail')->nullable();

            $table->primary(['order_id', 'service_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_service');
    }
}
