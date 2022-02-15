<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traslado extends Model
{
    use HasFactory;

    public function Equipo(){
        return  $this->belongsTo('App\Models\Equipo','equipo');
     }
    public function ServicioClinicos(){
        return  $this->hasMany('App\Models\ServicioClinico');
     } 
    public function Actual(){
     return $this->belongsTo('App\Models\ServicioClinico', 'actual');
  }
    public function Destino(){
     return $this->belongsTo('App\Models\ServicioClinico', 'destino');
  }  
}
