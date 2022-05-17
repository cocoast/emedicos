<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroSalud extends Model
{
    use HasFactory;
     protected $table='centrosalud';

    public function Ssalud(){
        return $this->belongsTo('App\Models\Ssalud','ssalud','id');
    }

//relacion uno es a muchos polimorfica
    public function dependence(){
        return $this->morphMany('App\Models\Dependence','depndencetable');
    }
    //relacion 1 a muchos polimorfica
    public function ConveniosMinsal(){
        return $this->morphMany('App\Models\ConveniosMinsal','dependencetable');
    }
}
