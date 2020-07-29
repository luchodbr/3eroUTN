<?php

namespace App\Controllers;

use App\Models\Turno;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Utils\Autenticar;
use App\Models\Usuario;

class TurnoController {

    public function getAll(Request $request, Response $response, $args)
    {
        $rta = json_encode(Turno::all());

        // $response->getBody()->write("Controller");
        $response->getBody()->write($rta);

        return $response;
    }

    public function add(Request $request, Response $response, $args)
    {
        $turno = new Turno;

        $body = $request->getParsedBody();
        $turno->id_mascota= $body['id_mascota'];
        $turno->fecha = $body['fecha'];
        $turno->hora = date("H:i:s",strtotime($body['hora']));
         $turnosMismaHora = Turno::where('fecha',$turno->fecha)->where('hora',$turno->hora)->get();

         if(count($turnosMismaHora) == 2){
            $rta = json_encode(array("error" => "ya hay dos turnos para esa hora"));
        }else if(count($turnosMismaHora) == 1){
            $turnoExistente=$turnosMismaHora[0];
            $veterinario = Usuario::where('id','!=',$turnoExistente->id_veterinario)->where('tipo',"veterinario")->first();
            $turno->id_veterinario = $veterinario->id;
            $rta = json_encode(array("ok" => $turno->save()));
        }
        else{
            $veterinario = Usuario::where('tipo',"veterinario")->first();
            $turno->id_veterinario = $veterinario->id;
            $rta = json_encode(array("ok" => $turno->save()));
        }


        $response->getBody()->write($rta);

        return $response;
    }

    public function getId(Request $request, Response $response, $args)
    {
        $user = Usuario::findOrFail(['id_usuario']);
        $today = date("yy-m-d");
        
        if($user->tipo =="veterinario"){
            $turnos = Turno::where('id_veterinario',$user->id)->where('fecha',$today)->get();
            foreach ($turnos as $value) {
                $ultimoTurno = Turno::where('id_mascota',$value->mascota->id)->where('fecha','<',$today)->orderBy("fecha",'desc')->first();
                $json = [
                    "nombreMascota" => $value->mascota->nombre,
                    "hora" =>$value->hora,
                    "fecha" =>$ultimoTurno->fecha
                ];
                $response->getBody()->write(json_encode($json));
            }
        } else{
            foreach ($user->mascota as $element) {
                $turnoMascota = Turno::where('id_mascota', $element->id)->get();
                if(count($turnoMascota) > 0)
                {
                    foreach ($turnoMascota as $value)
                        {
                        $json = [
                            "FechaTurno" => $value['fecha'],
                            "HoraTurno" => $value['hora'],
                            "Nombre mascota"=> $element->nombre
                        ];
                        $response->getBody()->write(json_encode($json));
        
                        }
                    }
                }
            }
            return $response;
    }
}