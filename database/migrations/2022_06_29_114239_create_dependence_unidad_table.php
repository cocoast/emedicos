<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependenceUnidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependence_unidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unidad')->constrained('servicio_clinicos')->onDelete('cascade');
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
        Schema::dropIfExists('dependence_unidad');
    }
}
