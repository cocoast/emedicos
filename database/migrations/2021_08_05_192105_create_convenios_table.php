<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convenios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('licitacion',20);
            $table->string('solicitud',20);
            $table->integer('resolucion');
            $table->string('fecharesolucion',10);
            $table->string('fechaincio',10);
            $table->string('fechafin',10);
            $table->string('meses',10);
            $table->string('valor',20);
            $table->string('frecuenciapago',10);
            $table->string('tipoconvenio',50);
            $table->string('link',300);
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
        Schema::dropIfExists('convenios');
    }
}
