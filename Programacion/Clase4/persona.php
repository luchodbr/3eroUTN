<?php

class Persona{
    public $nombre;
    public function __contruct($nombre){
        $this->nombre = $nombre;
    }
    public function saludar(){
        return "hola" . $this->$nombre;
    }
}