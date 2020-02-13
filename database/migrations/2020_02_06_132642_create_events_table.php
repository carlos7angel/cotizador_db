<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('finish_date');
            $table->enum('type_organizer', ['third-party', 'cfchm', 'co-organized'])->default('third-party');
            $table->unsignedBigInteger('organizer_id');
            $table->foreign('organizer_id')->references('id')->on('organizers')->onDelete('cascade');
            $table->enum('status', ['draft', 'published', 'unpublished'])->default('published');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('event_place', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('place_id');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->dateTime('start_date');
            $table->dateTime('finish_date');
            $table->dateTime('mount_start_date')->nullable();
            $table->dateTime('mount_finish_date')->nullable();
            $table->dateTime('dismount_start_date')->nullable();
            $table->dateTime('dismount_finish_date')->nullable();
            $table->primary(['event_id', 'place_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_place');
    }
}
