<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_orders', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('code')->unique()->nullable();
            $table->dateTime('date')->nullable();
            $table->float('total_price_places')->default(0);
            $table->float('total_price_services')->default(0);
            $table->enum('status', ['consult','submited','attended','finished'])->default('consult'); // delete with cron
            $table->enum('type', ['pre-order', 'order'])->default('pre-order');
            $table->enum('created', ['client', 'cfchm'])->default('client');
            $table->unsignedBigInteger('created_by')->nullable(); //only cfchm
            $table->foreign('created_by')->references('id')->on('users');
            $table->string('file_pdf_generated')->nullable();
            $table->text('observations')->nullable();

            $table->text('data_contact')->nullable(); // json {}
            // $table->string('firstname', 100)->nullable();
            // $table->string('lastname', 100)->nullable();
            // $table->string('email', 150)->nullable();
            // $table->string('phone', 100)->nullable();
            // $table->string('business_name', 100)->nullable();
            // $table->string('nit', 50)->nullable();
            // $table->string('event', 150)->nullable();
            // $table->text('description')->nullable();

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
        Schema::dropIfExists('quotation_orders');
    }
}
