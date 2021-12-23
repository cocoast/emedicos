<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    use HasFactory;
     public function Equipo(){
     	return  $this->hasMany('App\Models\Equipo');
     }
     public function Producto(){
        return  $this->hasMany('App\Models\Producto');
     }
}
