<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planificamp extends Model
{
    use HasFactory;

    public function Proveedor(){
        return $this->belongsTo('App\Models\Proveedor','proveedor','id');
    }
    public function Equipo(){
        return $this->belongsTo('App\Models\Equipo','equipo','id');
     }
}
