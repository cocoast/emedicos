<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
     public function Equipo(){
     	return  $this->hasMany('App\Models\Equipo');
     } 
     public function Convenio(){
        return  $this->hasMany('App\Models\Convenio');
     }
     public function Garantia(){
        return  $this->hasMany('App\Models\Garantia','proveedor');
     }
      public function PlanificaMP(){
        return  $this->hasMany('App\Models\Planificamp');
     }
     public function Producto(){
      return  $this->hasMany('App\Models\Producto');
     } 
}
