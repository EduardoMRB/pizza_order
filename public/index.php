<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Slim;
use Slim\Views\Twig;
use Pizza\Entity\Sabor;
use Pizza\DataMapper\SaborDataMapper;
use Pizza\Factory\FromUserInput;

date_default_timezone_set('America/Cuiaba');

$app = new Slim([
    'view' => new Twig,
    'templates.path' => __DIR__ . '/views',
]);

$app->pdo = function () {
    return new PDO(
        'mysql:host=localhost;dbname=pizza_order',
        'root',
        ''
    );
};

$app->saborMapper = function () use ($app) {
    return new SaborDataMapper($app->pdo);
};

$app->get('/', function () use ($app) {
    $app->render('list.html.twig', [
        'pizzas' => $app->saborMapper->findAll(),
    ]); 
});

$app->get('/new', function () use ($app) {
    $app->render('new.html.twig');
});

$app->post('/create', function () use ($app) {
    $sabor = FromUserInput::build($app->request);
    $app->saborMapper->insert($sabor);
    $app->flash('success', 'Sabor inserido com sucesso');

    $app->redirect('/');
});

$app->get('/edit/:id', function ($id) use ($app) {
    $app->render('edit.html.twig', [
        'sabor' => $app->saborMapper->findById($id),
    ]);
});

$app->put('/update', function () use ($app) {
    $sabor = FromUserInput::build($app->request);
    $app->saborMapper->update($sabor);
    $app->flash('success', 'Alterado com sucesso');

    $app->redirect('/');
});

$app->get('/delete/:id', function ($id) use ($app) {
    $app->render('delete.html.twig', [
        'id' => $id,
    ]);
});

$app->delete('/destroy/:id', function ($id) use ($app) {
    $app->saborMapper->delete($id);
    $app->flash('success', 'Sabor removido com sucesso');

    $app->redirect('/');
});

$app->run();
