<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('unique_code');
            $table->string('file_hash')->nullable();
            $table->string('name');
            $table->string('old_name');
            $table->text('description')->nullable();
            $table->string('mime_type');
            $table->integer('size');
            $table->text('url_file');
            $table->text('path_file');
            $table->text('options')->nullable();
            $table->enum('type', ['uploaded', 'generated'])->default('uploaded');
            $table->boolean('active')->default(1);
            $table->enum('upload', ['local', 's3', 'sftp'])->default('local');
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
        Schema::dropIfExists('files');
    }
}
