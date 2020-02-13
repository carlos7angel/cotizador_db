<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_payments', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('lease_projects')->onDelete('cascade');
            //adelanto
            $table->float('advance_percentage')->nullable();
            $table->string('advance_depositor_name')->nullable();
            $table->dateTime('advance_date')->nullable();
            $table->float('advance_amount')->nullable();
            $table->string('advance_file')->nullable();
            //garantia
            $table->float('warranty_percentage')->nullable();
            $table->string('warranty_depositor_name')->nullable();
            $table->dateTime('warranty_date')->nullable();
            $table->float('warranty_amount')->nullable();
            $table->string('warranty_file')->nullable();
            //saldo
            $table->float('balance_percentage')->nullable();
            $table->string('balance_depositor_name')->nullable();
            $table->dateTime('balance_date')->nullable();
            $table->float('balance_amount')->nullable();
            $table->string('balance_file')->nullable();
            //factura
            $table->string('billing_number')->unique()->nullable();
            $table->string('billing_nit')->nullable();
            $table->string('billing_business_name')->nullable();
            $table->dateTime('billing_date')->nullable();
            $table->string('billing_file')->nullable();

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
        Schema::dropIfExists('project_payments');
    }
}
