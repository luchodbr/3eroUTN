<?php

require_once './datos.php';
require_once './Autenticar.php';

class Venta{

    public $tipo;
    public $sabor;
    public $cantidad;
    public $fecha;
    public $email;
    public $monto;
    public function __construct($tipo,$sabor,$cantidad)
    {
        $this->tipo = $tipo;
        $this->sabor = $sabor;
        $this->cantidad = $cantidad;
    }

    public function realizarVenta($token)
    {
        $respuesta = null;
        $pizzas = Datos::leer('pizza.xxx');
        $token = Autenticar::validarToken($token);
        if($token->tipo == 'cliente')
        {
            
                if(isset($pizzas))
                {
                   $respuesta = '';
                    foreach ($pizzas as $value) 
                    {
                        if(($value->sabor == $this->sabor) && ($value->tipo == $this->tipo) && $value->stock > $this->cantidad)
                        {
                            $monto = $this->cantidad * $value->precio;
                            $respuesta = "El monto a pagar es : ".$monto;
                            $value->stock = $value->stock - $this->cantidad;
                            $this->fecha=time();
                            $this->email=$token->email;
                            $this->monto =$monto;
                            Datos::actualizarTodo($pizzas,'pizza.xxx');
                            Datos::guardar('ventas.xxx',$this);
                            return $respuesta;
                        }
                       
                    }
                    
                }
            }else{$respuesta = "no sos cliente";}
            return $respuesta;
        }

        public function mostrarVentas($token){
            $retorno = '';
            $token = Autenticar::validarToken($token);
            $ventas =Datos::leer('ventas.xxx');
            $MontoTotal = 0;
            if($token->tipo =='cliente')
            {
                foreach ($ventas as $value) {
                    if($token->email === $value->email)
                    {
                        $retorno = $retorno.'Tipo: '.$value->tipo.PHP_EOL;
                        $retorno = $retorno.'Sabor: '.$value->sabor.PHP_EOL;
                        $retorno = $retorno.'Cantidad: '.$value->cantidad.PHP_EOL.PHP_EOL;
                        $retorno = $retorno.'fecha: '.$value->fecha.PHP_EOL.PHP_EOL;
                        $retorno = $retorno.'email: '.$value->email.PHP_EOL.PHP_EOL;
                        $retorno = $retorno.'monto: '.$value->monto.PHP_EOL.PHP_EOL;
                        $retorno = $retorno.'-----------------------'.PHP_EOL.PHP_EOL;
                    }
                }
            }
            else if($token->tipo == 'encargado')
            {
                foreach ($ventas as $value) {
                    $MontoTotal+=$value->monto;
                }
                $retorno =$retorno.'Cantidad total de ventas: '.Count($ventas).PHP_EOL;
                $retorno =$retorno.'Monto total de ventas: '.$MontoTotal.PHP_EOL;
            }
            return $retorno;
        }


   
 
    
}