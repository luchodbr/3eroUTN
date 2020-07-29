<?php

class Datos{

    public $archivo;


    public static function guardar($archivo,$objeto){
        //leemos
        $arrayVacio = array();
        $arrayJSON = Datos::leer($archivo)??$arrayVacio;
        foreach ($arrayJSON as $value) {
            if($value->email == $objeto->email)
            {
                return "Ya existe el email";
            }
        }
        array_push($arrayJSON,$objeto);
        //escribimos
        $file=fopen($archivo,'w+');
        $rta = fwrite($file,serialize($arrayJSON));
        fclose($file);
        return $rta;
    }

    public static function leerTodo($archivo){
        $file =fopen($archivo,'r');
        $lista = array();
        while(!feof($file)){
            
            $linea = fgets($file);
           
            $explode = explode('@',$linea);
            
            if(count($explode)>0){
                array_push($lista,$explode);
            }
        }
       // $rta = fread($file,filesize($archivo));
        fclose($file);
        return $lista;
    }

    public static function leer($archivo){
        if(filesize($archivo)> 0)
        {    
            $file =fopen($archivo,'r');
            $arrayString = fread($file,filesize($archivo));
            $arrayJSON = unserialize($arrayString);
            fclose($file);
            return $arrayJSON;
        }
        return null;
    }
}