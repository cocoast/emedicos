<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServicioClinico;
use App\Models\Ssalud;
use App\Models\CentroSalud;
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
  public function Establecimiento(){
        return $this->belongsTo('App\Models\Establecimiento','establecimiento','id');
    } 
    public function Licitacion(){
     return $this->hasMany('App\Models\Licitacion', 'servicio');
  } 
  // relacion Polimorfica
    public function Unidad(){
        return $this->morphTo('dependentable');
    }
  //relacion uno es a muchos polimorfica para usuario
    public function dependence(){
        return $this->morphMany('App\Models\Dependence','Dependencetable','dependencetable_type','dependencetable_id','id');
    }
   public function Unidades()
    {
        return $this->hasManyThrough(ServicioClinico::class,ServicioClinico::class,'id','dependencetable_id');
    }

}
