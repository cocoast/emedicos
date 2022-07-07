<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependence extends Model
{
    use HasFactory;
    protected $table='dependences';
    
    public function Dependencetable(){
        return $this->morphTo('dependencetable');
    }

      public function User(){
        return $this->belongsTo('App\Models\User','user','id');
    }
}
