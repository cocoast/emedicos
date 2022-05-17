<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinsalFactura extends Model
{
    use HasFactory;
    protected $table="minsalfacturas";

    public function MinsalConvenio(){
        return $this->hasMany('App\Models\MinsalConvenio','minsalconvenio');
    }
    public function Fecha($fecha){
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $date =date('n',strtotime($fecha))-1;
        return $meses[$date];

    }
}
