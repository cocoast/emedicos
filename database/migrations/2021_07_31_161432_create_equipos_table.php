<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('inventario',10);
            $table->string('serie',50);
            $table->string('fecha_adquisicion',10);
            $table->string('eq',10);
            $table->integer('fabricacion');
            $table->string('tipoactivo',10);
            $table->string('valor',30);
            $table->string('oc',30)->nullable();
            $table->string('licitacion',30)->nullable();

        
           
            $table->foreignId('familia')->constrained('familias')->onDelete('cascade');
            $table->foreignId('subfamilia')->constrained('sub_familias')->onDelete('cascade');
            $table->foreignId('clase')->constrained('clases')->onDelete('cascade');
            $table->foreignId('subclase')->constrained('sub_clases')->onDelete('cascade');
            $table->foreignId('modelo')->constrained('modelos')->onDelete('cascade');
            $table->foreignId('marca')->constrained('marcas')->onDelete('cascade');
            $table->foreignId('proveedor')->constrained('proveedors')->onDelete('cascade');
            $table->foreignId('servicioClinico')->constrained('servicio_clinicos')->onDelete('cascade');

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
        Schema::dropIfExists('equipos');
    }
}
