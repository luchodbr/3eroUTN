<?php
include_once 'auth.php';
include_once 'file.php';

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
        $token = Auth::validarToken($token);
        if($token){
            if($token->tipo == 'admin' || $token->tipo == 'admin ')
            {
                if($this->foto){
                    $this->guardarImagenProducto($this->foto['tmp_name'], $this->foto['name']);
                }
                $this->setId();
                File::guardarJSON($this);
                return 'Producto guardado';
            }
        }
        return 'token inválido';
    }

    private function setId(){
        $productos = File::leerJSON();
        if($productos){
            $this->id = end($productos)['id'] + 1;
        }
        else{
            $this->id = 1;
        }
    }

    public function guardarImagenProducto($path, $nombre){
        $folder = "imagenes/";
        return move_uploaded_file($path, $folder.time().'-'.$nombre);
    }

    public static function leerProductos($token){
        $token = Auth::validarToken($token);
        if($token && $token->tipo === 'admin'){
            if($token->tipo === "admin"){
                $productos = File::leerJSON();
                if($productos){
                    return Producto::stringProdcutos($productos);
                }
            }
        }
        return 'Token inválido';
    }

    private static function stringProdcutos($productos){
        $retorno = '';
        foreach ($productos as $key) {
            $retorno = $retorno.'Producto: '.$key['producto'].PHP_EOL;
            $retorno = $retorno.'Marca: '.$key['marca'].PHP_EOL;
            $retorno = $retorno.'Precio: '.$key['precio'].PHP_EOL;
            $retorno = $retorno.'Stock: '.$key['stock'].PHP_EOL.PHP_EOL;
            $retorno = $retorno.'-----------------------'.PHP_EOL.PHP_EOL;
        }
        return $retorno;
    }


    public static function venderProcuto($id, $cantidad){
        $retorno = -1;
        $productos = File::leerJSON();
        if($productos){
            for ($i=0; $i < count($productos) ; $i++) { 
                if($productos[$i]['id'] == $id){
                   if($productos[$i]['stock'] >= intval($cantidad)){
                        $productos[$i]['stock'] = $productos[$i]['stock'] - $cantidad;
                        $retorno = $cantidad * $productos[$i]['precio'];
                        File::guardarJSON($productos, true);
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