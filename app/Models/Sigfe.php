<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sigfe extends Model
{
    use HasFactory;
    protected $table="sigfes";

    public function ConveniosMinsal()
    {
        return $this->hasMany('App\Models\ConvenioMinsal');
    }

}
