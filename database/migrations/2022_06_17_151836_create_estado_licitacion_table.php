<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoLicitacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_licitacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('licitacion')->constrained('licitaciones')->onDelete('cascade');
            $table->foreignId('estado')->constrained('estadoslicitaciones')->onDelete('cascade');
            $table->string('comentario');
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
        Schema::dropIfExists('estado_licitacion');
    }
}
