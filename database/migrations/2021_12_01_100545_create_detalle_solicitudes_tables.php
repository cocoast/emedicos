<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleSolicitudesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sc')->constrained('solicitud_compras')->onDelete('cascade');
            $table->string('producto');
            $table->string('detalle tecnico');
            $table->integer('cantidad');
            $table->integer('neto');
            $table->integer('dcto');
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
        Schema::dropIfExists('detalle_solicitudes');
    }
}
