<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoSc extends Model
{
    use HasFactory;
    public function SC(){
        return $this->belongsTo('App\Models\solicitudCompra','sc','id');
    }
}
 