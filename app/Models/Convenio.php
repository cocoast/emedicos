<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use HasFactory;
    
    public function Proveedor(){
        return $this->belongsTo('App\Models\Proveedor','proveedor','id');
    }
    public function EquipoConvenio(){
        return  $this->hasMany('App\Models\EquipoConvenio','convenio');
     }
      public function Pago(){
        return  $this->hasMany('App\Models\Pago','convenio');
     }
}
