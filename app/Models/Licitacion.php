<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licitacion extends Model
{
    use HasFactory;
    protected $table="licitaciones";

      public function Categoria(){
        return $this->belongsTo('App\Models\CategoriaLicitacion','categoria','id');
    }

}
