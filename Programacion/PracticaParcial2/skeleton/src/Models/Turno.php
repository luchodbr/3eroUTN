<?php
namespace App\Models;

class Turno extends \Illuminate\Database\Eloquent\Model
{
    public function Mascota()
    {
        return $this->belongsTo('App\Models\Mascota','id_mascota');
    }

}