<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licitacion extends Model
{
    use HasFactory;
    protected $table="licitaciones";

      public function Categoria(){
        return $this->belongsTo('App\Models\CategoriaLicitacion','categoria','id');
    }
     public function Servicio(){
        return $this->belongsTo('App\Models\ServicioClinico','servicio','id');
    }
    public function Licitador(){
        return $this->belongsTo('App\Models\User','licitador','id');
    }
    public function Estados()
    {
        return $this->belongsToMany('App\Models\EstadosLicitacion','estado_licitacion','licitacion','estado')->withPivot('comentario','created_at','updated_at');
    }
    
}
