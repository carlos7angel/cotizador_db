<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_project', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('lease_projects')->onDelete('cascade');

            $table->unsignedBigInteger('role_id'); // only "sales executive" or "lawer" or "finance"
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            $table->dateTime('date_assign')->nullable();
            $table->text('comments_assign')->nullable();
            $table->enum('status', ['assigned', 'attended', 'finished'])->default('assigned');
            $table->dateTime('date_finish')->nullable();

            $table->primary(['user_id', 'project_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_project');
    }
}
