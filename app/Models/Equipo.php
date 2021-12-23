<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    public function Modelo(){
    	return $this->belongsTo('App\Models\Modelo','modelo','id');
    }
    public function Marca(){
    	return $this->belongsTo('App\Models\Marca','marca','id');
    }
    public function Proveedor(){
    	return $this->belongsTo('App\Models\Proveedor','proveedor','id');
    }
    public function ServicioClinico(){
    	return $this->belongsTo('App\Models\ServicioClinico','servicioClinico','id');
    }
    public function Familia(){
        return $this->belongsTo('App\Models\Familia','familia','id');
    }
    public function SubFamilia(){
        return $this->belongsTo('App\Models\SubFamilia','subfamilia','id');
    }
    public function Clase(){
        return $this->belongsTo('App\Models\Clase','clase','id');
    }
    public function SubClase(){
        return $this->belongsTo('App\Models\SubClase','subclase','id');
    }
    public function EquipoConvenio(){
        return  $this->hasMany('App\Models\EquipoConvenio','equipo');
     }
    public function Garantias(){
        return  $this->hasMany('App\Models\Garantia','equipo');
     }
     public function Bajas(){
        return  $this->hasMany('App\Models\Baja','equipo');
     }
     public function PlanificaMP(){
        return  $this->hasMany('App\Models\Planificamp','equipo');
     }
       
}
