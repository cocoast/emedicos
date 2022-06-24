<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrasladoPeriferico extends Model
{
    use HasFactory;
    protected $table="trasladoperifericos";


    public function Traslado()
    {
        return  $this->belongsTo('App\Models\Traslado');
    }
}
