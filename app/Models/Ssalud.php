<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ssalud extends Model
{
    use HasFactory;
    protected $table='ssalud';

    public function CentroSalud(){
        return $this->hasMany('App\Models\CentroSalud', 'ssalud');
    }
   //relacion uno es a muchos polimorfica para usuario
    public function dependence(){
        return $this->morphMany('App\Models\Dependence','Dependencetable','dependencetable_type','dependencetable_id','id');
    }
    //relacion muchos a 1 polimorfica
    public function ConveniosMinsal(){
        return $this->morphMany('App\Models\ConveniosMinsal','dependencetable');
    }
   //relacion 1 a muchos polimorfica Servicio Clinico
    public function Unidad(){
        return $this->morphMany('App\Models\ServicioClinico','Unidad','dependentable_type','dependentable_id','id');
    }
    //relacion polimorfica con el establecimeinto de un servicio clinico (unidad)
     public function Establecimiento(){
        return $this->morphMany('App\Models\ServicioClinico','Establecimiento','establecimiento_type','establecimiento_id','id');
    }
    //relacion polimorfica de los usuarios con su lugar de trabajo establecimiento
     public function Trabajoen(){
        return $this->morphMany('App\Models\User','Trabajoen','establecimiento_type','establecimiento_id','id');
    }
}
