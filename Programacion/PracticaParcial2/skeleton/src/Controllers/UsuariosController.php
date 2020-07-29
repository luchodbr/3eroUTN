<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Usuario;
use App\Utils\Autenticar; 

class UsuariosController {

    public function getAll(Request $request, Response $response, $args)
    {
        $rta = json_encode(Usuario::all());

        // $response->getBody()->write("Controller");
        $response->getBody()->write($rta);

        return $response;
    }

    public function add(Request $request, Response $response, $args)
    {
        $body = $request->getParsedBody();
        $email= $body['email'];
        $tipo = $body['tipo'];
        $password = password_hash($body['password'],PASSWORD_DEFAULT);

        // $rta = json_encode(array("ok" => $usuario->save()));
        $user =Usuario::firstOrNew(
            ['email' => $email],
            ['tipo' => $tipo, 'password' => $password]
        );
        if(isset($user->id))
        {
           $response->getBody()->write("Email en uso");
        }else{
           
           $response->getBody()->write(json_encode( $user->save()));  
        }
        return $response;
    }
    public function login(Request $request, Response $response, $args)
    {
      $body =$request->getParsedBody();
      $email = $body['email'];
      $password = $body['password'];
      $user = Usuario::where('email',$email)->firstOrFail();

      if(!password_verify($password,$user->password)){
        $rta = json_encode('Error verifique los parametros');
      }else{
          $rta=json_encode(Autenticar::GenerarToken($user->id));
      }
      $response->getBody()->write($rta);
      return $response;
      
    }
}