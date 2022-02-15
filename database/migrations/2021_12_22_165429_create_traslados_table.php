<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrasladosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traslados', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->date('fecha');
            $table->foreignId('actual')->constrained('servicio_clinicos')->onDelete('cascade');
            $table->foreignId('destino')->constrained('servicio_clinicos')->onDelete('cascade');
            $table->foreignId('equipo')->constrained('equipos')->onDelete('cascade');
            $table->string('archivo',250);
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
        Schema::dropIfExists('traslados');
    }
}
