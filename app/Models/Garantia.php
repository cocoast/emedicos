<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantia extends Model
{
    use HasFactory;

     public function Equipo(){
        return $this->belongsTo('App\Models\Equipo','equipo');
    }
    public function Proveedor(){
        return $this->belongsTo('App\Models\Proveedor','proveedor','id');
    }
}
