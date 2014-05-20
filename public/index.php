<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Slim;
use Slim\Views\Twig;

$app = new Slim([
    'view' => new Twig,
    'templates.path' => __DIR__ . '/views',
]);

$app->get('/', function () use ($app) {
    $app->render('list.html.twig'); 
});

$app->get('/new', function () use ($app) {
    $app->render('new.html.twig');
});

$app->run();
