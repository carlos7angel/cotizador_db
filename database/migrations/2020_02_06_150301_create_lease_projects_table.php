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
            $table->enum('type_from', ['pre-order', 'email', 'note'])->default('pre-order');

            $table->enum('status', ['solicitude', 'inprocess', 'reserved', 'confirmed', 'unconfirmed', 'devolution', 'done', 'finished', 'annulled'])->default('solicitude'); // for check dates only reserved & confirmed

            // solicitude -> precotizacion
            // inprocess -> cuando estas generado la cotizacion final en 4 pasos.
            // reserved -> (30 dias)
            // confirmed

            $table->unsignedBigInteger('pre_order_id')->nullable();
            $table->foreign('pre_order_id')->references('id')->on('quotation_orders');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('quotation_orders')->onDelete('cascade');

            $table->text('reasons_finished')->nullable();
            $table->text('reasons_annulled')->nullable();

            $table->string('file_pdf_places')->nullable();
            $table->string('file_pdf_services')->nullable();

            $table->string('document_delivery_certificate')->nullable(); // acta de entrega
            $table->string('document_service_order')->nullable(); // orden de servicio
            $table->string('document_return_certificate')->nullable(); // acta de devolucion
            $table->string('document_confirmation_letter')->nullable(); // carta de confirmacion
            $table->string('document_payment_commitment')->nullable(); // compromiso de pago
            $table->string('document_event_start_report')->nullable(); // informe del inicion de evento
            $table->string('document_closing_report')->nullable(); // informe tecnico de cierre

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
