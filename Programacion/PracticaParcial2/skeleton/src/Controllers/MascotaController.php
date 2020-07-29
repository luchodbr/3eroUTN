<?php

namespace App\Controllers;

use App\Models\Mascota;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Utils\Autenticar; 

class MascotaController {

    public function getAll(Request $request, Response $response, $args)
    {
        $rta = json_encode(Mascota::all());

        // $response->getBody()->write("Controller");
        $response->getBody()->write($rta);

        return $response;
    }

    public function add(Request $request, Response $response, $args)
    {
        $mascota = new Mascota();

        $body = $request->getParsedBody();
        $mascota->nombre= $body['nombre'];
        $mascota->edad = $body['edad'];
        $mascota->usuario_id = $body['usuario_id'];

        
        $rta = json_encode(array("ok" => $mascota->save()));

        $response->getBody()->write($rta);

        return $response;
    }
}
