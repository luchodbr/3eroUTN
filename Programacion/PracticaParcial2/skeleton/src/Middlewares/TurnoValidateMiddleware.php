<?php
namespace App\Middleware;

use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use App\Utils\Autenticar; 
class TurnoValidateMiddleware
{
    /**
     * Example middleware invokable class
     *
     * @param  ServerRequest  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $body = $request->getParsedBody();
        $horaString = $body['hora'];
        $hs = date("H:i:s",strtotime($horaString));
        $hsFrom = date("H:i:s",strtotime("09:00"));
        $hsTo = date("H:i:s",strtotime('17:00'));

        if($hs > $hsTo || $hs < $hsFrom)
        {
            $response = new Response();
            $response->getBody()->write('Fuera de horario');
        }
        else{
            $response = new Response();
            $resp = $handler->handle($request); //linea en la que salgo del mid y paso al controller
            $existingContent = (string) $resp->getBody();
            $response->getBody()->write($existingContent);
        }
        return $response;
    }
}