<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablecimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('establecimiento', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('direccion',250);
            $table->string('logo')->nullable();
            $table->integer('jerarquia');
            $table->string('rut')->nullable();
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::dropIfExists('establecimiento');*/
    }
}
