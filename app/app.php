<?php

require __DIR__ . '/../autoload.php';

// Config
$debug = true;

$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

$finder = new \Model\JsonFinder();

/**
 * Index
 */
$app->get('/', function () use ($app, $finder) {
    return $app->render('index.php', array('statuses' => $finder->findAll()));
});

$app->get('/(\d+)', function ($id) use ($app, $finder) {
    if (null === $status = $finder->findOneById($id)) {
        // Doesn't work as expected
        throw new HttpException(404, 'Oups! This status cannot be found :(');
    }
var_dump(json_encode($status));
    return $app->render('detail.php', array('status' => $status));
});

$app->post('/', function () use ($app) {
    return $app->render('index.php');
});

$app->put('/', function () use ($app) {
    return $app->render('index.php');
});

$app->delete('/', function () use ($app) {
    return $app->render('index.php');
});

// ...

return $app;
