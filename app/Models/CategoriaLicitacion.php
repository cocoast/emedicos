<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaLicitacion extends Model
{
    use HasFactory;
    protected $table="categorias_licitaciones";

     public function Licitacion(){
        return  $this->hasMany('App\Models\Licitacion');
     }
}
