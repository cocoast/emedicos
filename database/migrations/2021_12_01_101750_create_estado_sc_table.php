<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoScTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_sc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sc')->constrained('solicitud_compras')->onDelete('cascade');
            $table->date('fecha');
            $table->string('estado_sc');
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
        Schema::dropIfExists('estado_sc');
    }
}
