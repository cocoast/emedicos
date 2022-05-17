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
    public function dependence(){
        return $this->morphMany('App\Models\Dependence','dependencetable');
    }
    //relacion 1 a muchos polimorfica
    public function ConveniosMinsal(){
        return $this->morphMany('App\Models\ConveniosMinsal','dependencetable');
    }
}
