<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinsalconveniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minsalconvenios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('resolucion');
            $table->string('fecha_resolucion');
            $table->string('fecha_termino');
            $table->integer('ano');
            $table->integer('monto_anual');
            $table->string('glosa');
            $table->foreignId('sigfe')->constrained('sigfes')->onDelete('cascade');
            $table->unsignedBigInteger('dependencetable_id');
            $table->string('dependencetable_type');
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
        Schema::dropIfExists('minsalconvenios');
    }
}
