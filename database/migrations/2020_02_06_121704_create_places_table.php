<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('content_html')->nullable();
            $table->text('banner_photos')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('place_category_id'); // confirmar
            $table->foreign('place_category_id')->references('id')->on('place_categories')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('area')->nullable();
            $table->string('capacity_stands')->nullable();
            $table->string('capacity_people')->nullable();
            $table->string('floor')->nullable();
            $table->enum('type', ['block','room'])->default('block');
            $table->boolean('has_services')->default(1);
            $table->string('file_pdf_map')->nullable();
            $table->enum('sector_inweb', ['Bloque Rojo', 'Bloque Amarillo', 'Bloque Verde', 'Auditorio', 'Plazas', 'Salones'])->default('Bloque Rojo'); // only cotizador
            $table->text('photos')->nullable(); // []
            $table->text('photos360')->nullable(); // []
            $table->text('price_normal'); // json {}
            $table->text('price_promotion'); // json {}
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('place_categories');
        Schema::dropIfExists('places');
    }
}
