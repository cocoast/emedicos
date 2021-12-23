<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public function Proveedor(){
        return $this->belongsTo('App\Models\Proveedor','proveedor','id');
    }
    public function Familia(){
        return $this->belongsTo('App\Models\Familia','familia','id');
    }
    public function SubFamilia(){
        return $this->belongsTo('App\Models\SubFamilia','subfamilia','id');
    }
    public function Detallesc(){
        return  $this->hasMany('App\Models\DetalleSolicitud');
     }
}
