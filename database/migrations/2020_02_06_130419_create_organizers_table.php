<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('business_name');
            $table->text('description')->nullable();
            $table->enum('type', ['public_institution', 'private_institution'])->default('private_institution');
            $table->string('legal_address');
            $table->string('country'); // table(?)
            $table->string('city');
            $table->string('business_sector');
            $table->string('logo')->nullable();
            $table->string('nit')->nullable();
            $table->string('fundempresa')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('website')->nullable();
            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_position')->nullable();
            $table->string('representant_first_name')->nullable();
            $table->string('representant_last_name')->nullable();
            $table->string('representant_document')->nullable();
            $table->string('representant_document_exp')->nullable();
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
        Schema::dropIfExists('organizers');
    }
}
