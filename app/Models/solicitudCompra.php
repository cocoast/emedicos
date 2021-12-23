<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitudCompra extends Model
{
    use HasFactory;
     public function ServicioClinico(){
        return $this->belongsTo('App\Models\ServicioClinico','servicioClinico','id');
    }
    public function Detallesc(){
        return  $this->hasMany('App\Models\DetalleSolicitud');
     }
   
}
