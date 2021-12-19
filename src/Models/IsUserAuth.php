<?php

namespace Summit\Models;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class IsUserAuth
{
    public function __invoke(Request $request, RequestHandler $handler) :Response
    {
        print_r($_COOKIE);
        $response = $response->withHeader('Vagon', 'Dobra');
        return $response;

    }
}