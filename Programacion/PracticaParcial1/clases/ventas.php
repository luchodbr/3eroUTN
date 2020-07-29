<?php
include_once 'producto.php';

class Venta{

    public $id;
    public $idProducto;
    public $cantidadProducto;
    public $idUsuario;
    public $total;

    public function __construct($idProducto, $cantidadProducto, $idUsuario)
    {
        $this->idProducto = $idProducto;
        $this->cantidadProducto = $cantidadProducto;
        $this->idUsuario = $idUsuario;
        $this->id = 1;
    }

    public function realizarVenta($token){
        $token = Auth::validarToken($token);
        if($token && $token->tipo == 'user'){
            if(Usuario::findById($this->idUsuario)){
                $total = Producto::venderProcuto($this->idProducto, $this->cantidadProducto);
                if($total > 0){
                    $this->total = $total;
                    File::guardar('ventas.xxx', $this);
                    return 'Venta realizada.';
                }
                else if($total == -1){
                    return 'No se encuentra el producto';
                }
                else{
                    return 'No hay suficiente stock';
                }
            }
            else{
                return 'Usuario no encontrado.';
            }
        }
        else{
            return 'Usuario incorrecto';
        }
    }


    // public static function mostrarVentas($token){
    //     $token = Auth::validarToken($token);
    //     $ventas = File::leer('ventas.xxx');
    //     $retorno = array();
    //     if($token->tipo === 'admin'){
    //         $retorno = $ventas;
    //     }  
    //     else if($token->tipo === 'user'){
    //         foreach ($ventas as $key) {
    //             if($ventas->idUsuario == $token->id){
    //                 array_push($retorno, $key);
    //             }
    //         }
    //     }
    //     return $retorno;
    // }
    public static function mostrarVentas($token){
        $token = Auth::validarToken($token);
        $ventas = File::leer('ventas.xxx');
        $retorno = '';
        foreach ($ventas as $key) {
            if($token->tipo === 'admin' || $token->tipo === 'admin '){
                $retorno = $retorno.Venta::stringVentas($key);
            }  
            else if($token->tipo === 'user'){
                if($key->idUsuario == $token->id){
                    $retorno = $retorno.Venta::stringVentas($key);
                }
            }
        }


        return $retorno;
    }

    private static function stringVentas($venta){
        $retorno = '';
        $retorno = $retorno.'ID - Producto: '.$venta->idProducto.PHP_EOL;
        $retorno = $retorno.'Cantidad de Producto: '.$venta->cantidadProducto.PHP_EOL;
        $retorno = $retorno.'ID - Usuario: '.$venta->idUsuario.PHP_EOL;
        $retorno = $retorno.'Total: '.$venta->total.PHP_EOL.PHP_EOL;
        $retorno = $retorno.'-----------------------'.PHP_EOL.PHP_EOL;
        return $retorno;
    }

}