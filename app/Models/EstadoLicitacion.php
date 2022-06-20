<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EstadoLicitacion extends Pivot
{
    use HasFactory;
    protected $table='estado_licitacion';
    
}