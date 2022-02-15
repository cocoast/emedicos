<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioClinico extends Model
{
    use HasFactory;
     public function Equipo(){
     	return  $this->hasMany('App\Models\Equipo');
     }
     public function Solicitud(){
        return  $this->hasMany('App\Models\solicitudCompra');
     }
     public function Actual(){
     return $this->hasMany('App\Models\Traslado', 'actual');
  }
    public function Destino(){
     return $this->hasMany('App\Models\Traslado', 'destino');
  }  
}
