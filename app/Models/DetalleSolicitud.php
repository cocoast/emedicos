<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSolicitud extends Model
{
    use HasFactory;
    public function SC(){
        return $this->belongsTo('App\Models\solicitudCompra','sc','id');
    }
    public function ServicioClinico(){
        return $this->belongsTo('App\Models\Producto','producto','id');
    }
}
