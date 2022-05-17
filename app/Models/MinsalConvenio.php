<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinsalConvenio extends Model
{
    use HasFactory;
    protected $table='minsalconvenios';

    public function Sigfe(){
        return $this->belongsTo('App\Models\Sigfe','sigfe');
    }
   
    //relacion uno es a muchos polimorfica
    public function dependencetable(){
        return $this->morphTo();
    }
    public function MinsalFactura(){
        return $this->belongsTo('App\Models\MinsalFactura','minsalconvenio');
    }
}
