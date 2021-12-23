<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudComprasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_compras', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->date('fecha');
            $table->string('tipo');
            $table->string('referente');
            $table->foreignId('servicio')->constrained('servicio_clinicos')->onDelete('cascade');
            $table->string('justificacion',1000);
            $table->integer('neto');
            $table->integer('iva');
            $table->integer('total');
            $table->string('archivo');
            $table->string('informe');
            $table->string('referenteTecnico');
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
        Schema::dropIfExists('solicitud_compras');
    }
}
