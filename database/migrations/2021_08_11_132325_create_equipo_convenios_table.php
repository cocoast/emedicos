<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoConveniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_convenios', function (Blueprint $table) {
            $table->id();
            $table->integer('valor');
            $table->string('fechaincorporacion',10);
            $table->string('mp',10);
            $table->string('mc',10);
            $table->string('repuesto',10);
            $table->foreignId('equipo')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('convenio')->constrained('convenios')->onDelete('cascade');
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
        Schema::dropIfExists('equipo_convenios');
    }
}
