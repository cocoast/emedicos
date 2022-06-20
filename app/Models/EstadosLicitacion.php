<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosLicitacion extends Model
{
    use HasFactory;
    protected $table='estadoslicitaciones';

    public function Licitaciones()
    {
        return $this->belongsToMany('App\Models\Licitacion','estado_licitacion','licitacion','estado')->withPivot('comentario');
    }
}
