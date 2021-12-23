<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanificampTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planificamps', function (Blueprint $table) {
            $table->id();
            $table->date('fechacorte');
            $table->date('fechaprogramacion');
            $table->string('tipomp');
            $table->foreignId('equipo')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('proveedor')->constrained('proveedors')->onDelete('cascade');
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
        Schema::dropIfExists('planificamps');
    }
}
