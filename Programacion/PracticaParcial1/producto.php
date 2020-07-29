<?php
include_once 'Autenticar.php';
include_once 'datos.php';

class Producto{
    public $id;
    public $producto;
    public $marca;
    public $precio;
    public $stock;
    public $foto;


    function __construct($producto, $marca, $precio, $stock, $foto){
        $this->producto = $producto;
        $this->marca = $marca;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->foto = $foto;
    }

    public function guardarProducto($token){
        $token = Autenticar::ValidarToken($token);
        if($token != null && $token != ""){
            if($token->tipo == 'admin' || $token->tipo == 'admin ')
            {
                if($this->foto){
                    $this->guardarImagen($this->foto['tmp_name'], $this->foto['name']);
                }
                $this->setId();
                Datos::guardarJSON($this);
                return 'se guardo';
            }
        }
        return 'token no valido';
    }

    private function setId(){
        $productos = Datos::leerJSON();
        if($productos){
            $this->id = end($productos)['id'] + 1;
        }
        else{
            $this->id = 1;
        }
    }

    private function guardarImagen($path, $nombre){
        $folder = "imagenes/";
        return move_uploaded_file($path, $folder.time().'-'.$nombre);
    }

    public static function leerProductos($token){
        $token = Autenticar::validarToken($token);
        if($token && $token->tipo === 'admin'){
            if($token->tipo === "admin"){
                $productos = Datos::leerJSON();
                if($productos){
                        $retorno = '';
                        foreach ($productos as $value) {
                            $retorno = $retorno.'Producto: '.$value['producto'].PHP_EOL;
                            $retorno = $retorno.'Marca: '.$value['marca'].PHP_EOL;
                            $retorno = $retorno.'Precio: '.$value['precio'].PHP_EOL;
                            $retorno = $retorno.'Stock: '.$value['stock'].PHP_EOL.PHP_EOL;
                            $retorno = $retorno.'-----------------------'.PHP_EOL.PHP_EOL;
                        }
                        return $retorno;
                }
            }
        }
        return 'token no valido';
    }


    public static function venderProcuto($id, $cantidad){
        $retorno = -1;
        $productos = Datos::leerJSON();
        if($productos){
            for ($i=0; $i < count($productos) ; $i++) { 
                if($productos[$i]['id'] == $id){
                   if($productos[$i]['stock'] >= intval($cantidad)){
                        $productos[$i]['stock'] = $productos[$i]['stock'] - $cantidad;
                        $retorno = $cantidad * $productos[$i]['precio'];
                        Datos::guardarJSON($productos, true);
                    }
                    else{
                        $retorno = 0;
                    }
                }
            }
        }
        return $retorno;
    }
}