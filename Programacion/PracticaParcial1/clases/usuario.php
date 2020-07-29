<?php
include_once 'file.php';
include_once 'auth.php';

class Usuario{

    public $id;
    public $nombre;
    public $dni;
    public $obraSocial;
    public $clave;
    public $tipo;


    public function __construct($nombre, $dni, $obraSocial, $clave, $tipo){
        $this->nombre = $nombre;
        $this->dni = $dni;
        $this->obraSocial = $obraSocial;
        $this->clave = $clave;
        $this->tipo = $tipo;
    }
    

    private function seEncuentra(){
        $usuarios = File::leer('usuarios.txt')??null;
        if($usuarios){
            foreach ($usuarios as $key) {
                if($key->dni === $this->dni){
                    return true;
                }
            }
        }
        $this->setId($usuarios);
        return false;
    }

    private function setId($usuarios){
        if($usuarios){
            $this->id = end($usuarios)->id +1;
        }
        else{
            $this->id = 1;
        }
    }

    public function signin(){
        if(!$this->seEncuentra($this->dni)){
            File::guardar('usuarios.txt', $this);
            return "Registrado correctamente.";
        }
        else{
            return "El dni ya se encuentra.";
        }
    }

    public static function login($dni, $clave){
        $usuarios = File::leer('usuarios.txt');
        if($usuarios){
            var_dump($usuarios);
            foreach($usuarios as $key){
                if($key->dni === $dni && $key->clave === $clave){
                    return Auth::generarToken($key->id, $key->tipo);
                }
            }
        }
        return false;
    }

    public static function findById($id){
        $usuarios = File::leer('usuarios.txt');
        if($usuarios){
            foreach($usuarios as $value){
                if($value->id == $id){
                    return $value;
                }
            }
        }
        return false;
    }

}
