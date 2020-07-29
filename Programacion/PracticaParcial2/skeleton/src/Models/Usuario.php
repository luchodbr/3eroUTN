<?php
namespace App\Models;

class Usuario extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['email','tipo','password'];
    public function Mascota()
    {
        return $this->hasMany('App\Models\Usuario','id');
    }


}