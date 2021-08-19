<?php
use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use Slim\Views\TwigMiddleware;

return function (App $app) {
    $app->addBodyParsingMiddleware();

    $app->add(TwigMiddleware::class); // <--- here

    $app->addRoutingMiddleware();
    $app->add(ErrorMiddleware::class);
};