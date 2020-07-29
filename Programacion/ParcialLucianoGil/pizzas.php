<?php

require_once './datos.php';
require_once './Autenticar.php';
 class Pizza{

    public $tipo;
    public $precio;
    public $stock;
    public $sabor;
    public $foto;

    public function __construct($tipo,$precio,$stock,$sabor,$foto){
        $this->precio=$precio;
        $this->stock=$stock;
        $this->tipo=$tipo;
        $this->sabor=$sabor;
        $this->foto=$foto;
    }

    public function guardarPizza($token){
        $token = Autenticar::validarToken($token);
        if($token){
            if($token->tipo == 'encargado')
            {
               
                $pizzas = Datos::leer('pizza.xxx');
                if(isset($pizzas))
                {

                    foreach ($pizzas as $value) 
                    {
                        if(($value->sabor === $this->sabor) && ($value->tipo === $this->tipo))
                        {
                           
                            return "Ya esta registrado esta combinacion";
                        }
                    }
                }
                if($this->foto){
                    $this->guardarImagenPizza($this->foto['tmp_name'], $this->foto['name']);
                }
                Datos::guardar('pizza.xxx',$this);
                return 'Pizza guardada';
            }
            else{
                return 'Solo puede guardar un encargado';
            }
        }
        return 'token inválido';
    }

   
    public function guardarImagenPizza($path, $nombre)
    {
        $folder = "imagenes/";
        $pathImg = $folder . time() . '-' . $nombre;
        
        return Pizza::addImageWatermark($path, 'imagenes/marcadeagua.png', $pathImg, 15);
    }

    function addImageWatermark($SourceFile, $WaterMark, $DestinationFile = NULL, $opacity)
    {
        $main_img = $SourceFile;
        $watermark_img = $WaterMark;
        $padding = 5;
        $opacity = $opacity;
        $watermark = imagecreatefrompng($watermark_img);
        $image = imagecreatefrompng($main_img);
        if (!$image || !$watermark) return "Error:no se pudo cargar la marca de agua!";
        $watermark_size = getimagesize($watermark_img);
        $watermark_width = $watermark_size[0];
        $watermark_height = $watermark_size[1];
        $image_size = getimagesize($main_img);
        $dest_x = $image_size[0] - $watermark_width - $padding;
        $dest_y = $image_size[1] - $watermark_height - $padding;
        imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, $opacity);
        if ($DestinationFile <> '') {
            imagejpeg($image, $DestinationFile, 100);
        } else {
            header('Content-Type: image/jpeg');
            imagejpeg($image);
        }
        imagedestroy($image);
        imagedestroy($watermark);
        return "Se guardo correctamente";
    }






    public static function leerPizzas($token){
        $token = Autenticar::validarToken($token);
        if($token){
            if($token->tipo == 'encargado')
            {
                $pizzas = Datos::leer('pizza.xxx');
                return Pizza::stringPizzas($pizzas,"todo");
            }
            else
                $pizzas = Datos::leer('pizza.xxx');
                return Pizza::stringPizzas($pizzas,"sinStock");
            }
        
    }

    private static function stringPizzas($pizzas,$filtro){
        $retorno = '';
        foreach ($pizzas as $key) {
            if($filtro == "todo")
            {
                $retorno = $retorno.'Stock: '.$key->stock.PHP_EOL;
            }
            $retorno = $retorno.'Tipo: '.$key->tipo.PHP_EOL;
            $retorno = $retorno.'Precio: '.$key->precio.PHP_EOL;
            $retorno = $retorno.'Sabor: '.$key->sabor.PHP_EOL.PHP_EOL;
            $retorno = $retorno.'-----------------------'.PHP_EOL.PHP_EOL;
        }
        return $retorno;
    }

}
