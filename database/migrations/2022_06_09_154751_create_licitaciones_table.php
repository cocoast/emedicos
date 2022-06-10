<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicitacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('id_mercadopublico')->nullable();
            $table->string('url_mercadopublico')->nullable();
            $table->foreignId('servicio')->constrained('servicio_clinicos')->onDelete('cascade');
            $table->string('solicitud_compra')->nullable();
            $table->string('fecha_solicitud_compra')->nullable();
            $table->string('file_solicitud_compra')->nullable();
            $table->integer('presupuesto');
            $table->integer('vigencia');
            $table->integer('licitador');
            $table->string('resolucion_base')->nullable();
            $table->string('fecha_resolucion_base')->nullable();
            $table->string('resolucion_licitacion')->nullable();
            $table->string('fecha_resolucion_licitacion')->nullable();
            $table->foreignId('categoria')->constrained('categorias_licitaciones')->onDelete('cascade');
            $table->integer('estado_actual');
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
        Schema::dropIfExists('licitaciones');
    }
}
