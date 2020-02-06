<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaseProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lease_projects', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('code')->unique(); // inform or hash
            $table->enum('created_type', ['client', 'cfchm'])->default('client');
            $table->enum('status', ['pre-reserved', 'reserved', 'confirmed', 'finished', 'cancelled'])->default('reserved'); // add more status
            $table->enum('phase', ['01', '02', '03'])->nullable(); // todo: confirm!
            $table->text('phases_data')->nullable(); // json register dates eg [{"phase": "01", "name_phase": "create...", "close_date": ...dateTime()}]
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('quotation_orders')->onDelete('cascade');
            $table->text('reasons_not_selled')->nullable();
            $table->string('pdf_places')->nullable(); // hash or path_file (its depends only download)
            $table->string('pdf_services')->nullable();
            $table->string('file_guarantee')->nullable();
            $table->string('file_report_confirmed')->nullable();
            $table->string('file_contract')->nullable();
            $table->string('file_note_cash')->nullable(); // todo: update names
            $table->string('file_final_report')->nullable();
            $table->unsignedBigInteger('event_id')->nullable(); // null only is prereserved
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('organizer_id')->nullable(); // null only is prereserved
            $table->foreign('organizer_id')->references('id')->on('organizers')->onDelete('cascade');
            $table->text('observations')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lease_projects');
    }
}
