<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_documents', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('unique_code')->unique();
            //$table->enum('type_document', ['acta', 'orden', 'carta', 'compromiso', 'informe'])->nullable();
            $table->string('name'); // compromiso de pago
            $table->dateTime('date_document');
            $table->string('file_document');
            $table->string('code_document')->nullable();
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
        Schema::dropIfExists('project_documents');
    }
}
