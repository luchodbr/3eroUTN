<?php
include_once 'datos.php';
class Persona{
    public $nombre;
    public $apellido;
    public $legajo;

    public function __construct($nombre,$apellido,$legajo){
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->legajo=$legajo;
    }
    
    public function save(){
        return Datos::guardarJSON('datos.json',$this);
    }
    public function toFile(){
        return $this->nombre . '@' .$this->apellido .'@'.$this->legajo .PHP_EOL;
    }
    static public function find($id=0){
        $lista =Datos::leerJSON('datos.json');
        $personaEncontrada;
        if($id == 0)
        {
            return $lista;
        }
        else{
            foreach ($lista as $value) {
                if($value->legajo == $id)
                $personaEncontrada = $value;
            break;
            }
        }
       return $personaEncontrada;
    }
    public function toJSON(){
        return json_encode($this);
    }
}