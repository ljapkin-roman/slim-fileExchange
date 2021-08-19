<?php
use \Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

return function (ContainerInterface $container) {
    $container->set('settings', function () {
        return [
             'displayErrorDetails' => true,
             'logErrors' => true,
             'logErrorDetails' => true
        ];
    });

    $container->set('settings', function() {
        return [
            'twig' => [
                'paths' => [ __DIR__ . '/../template'],
                'options' => [
                    'cache_enabled' => false,
                    'cache_path' => __DIR__ . '/../tmp/twig',
                ],
            ],

        ];
    });


};
