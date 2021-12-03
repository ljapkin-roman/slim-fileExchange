<?php

namespace Summit\Models;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class CheckUserMiddleware
{
     public function __invoke(Request $request, RequestHandler $handler) :Response
     {
         $user_session = $_COOKIE['PHPSESSID'];
         $response = $handler->handle($request);
         $resent_address = 'http://' . $_SERVER['HTTP_HOST'] ;
         $existingContent = (string) $response->getBody();
         if($_SESSION['PHPSESSID'] !== $user_session || !isset($_COOKIE['PHPSESSID']))  {

             header("Location:  $resent_address");
             exit();
             //$response->getBody()->write($_COOKIE['PHPSESSID'] . " You haven't been login " . $existingContent);

         }
         else {
             $response = new Response();
             $response->getBody()->write($_COOKIE['PHPSESSID'] . " You have been login " . $existingContent);
         }
         return $response;
     }
}