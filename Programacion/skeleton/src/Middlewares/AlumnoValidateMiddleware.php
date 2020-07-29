<?php
namespace App\Middleware;

use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AlumnoValidateMiddleware
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
      

        /**
         * VALIDAR JWT
         * getHeader('mi_token)
         */
        if (true) {
            $response = new Response();
            $resp = $handler->handle($request);
            $existingContent = (string) $resp->getBody();
            $response->getBody()->write($existingContent);
        } else {
            $response = new Response();
            $response->getBody()->write('NO autorizado ');
        }

        // $response->getBody()->write('BEFORE ' . $existingContent);

        return $response;
    }
}
