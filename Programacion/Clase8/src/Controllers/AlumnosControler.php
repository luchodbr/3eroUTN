<?php
namespace App\Controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AlumnosControler{

    public function getAll(Request $request, Response $response, $args){
        $response->getBody()->write("archivo routes.php");
        return $response;
    }
    }
}