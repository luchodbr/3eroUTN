<?php
namespace App\Models;

class Mascota extends \Illuminate\Database\Eloquent\Model
{
    public function Usuario()
    {
        return $this->belongsTo('App\Models\Usuario','id_cliente');
    }

    public function Turno()
    {
        return $this->hasMany('App\Models\Turno','id');
    } 

}