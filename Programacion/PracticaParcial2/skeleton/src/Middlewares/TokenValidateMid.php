<?php
namespace App\Middleware;

use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use App\Utils\Autenticar; 
class TokenValidateMid
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
        $response = new Response();
        /**
         * VALIDAR JWT
         * getHeader('mi_token)
         */
         $token =$request->getHeader('token')[0];
        if (!Autenticar::ValidarToken($token)) {
            $response = new Response();
            throw new \Slim\Exception\HttpForbiddenException($request);
            return $response->withStatus(403);
        } else {
            $response = $handler->handle($request);
            $existingContent=(string)$response->getBody();
            $resp = new Response();
            $resp->getBody()->write($existingContent);
            return $resp;
        }
        
        

        return $response;
    }
}