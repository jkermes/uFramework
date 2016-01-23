<?php

require __DIR__ . '/../autoload.php';

// Config
$debug = true;

$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

$finder = new \Model\InMemoryFinder();

/**
 * Index
 */
$app->get('/', function () use ($app, $finder) {
    return $app->render('index.php', $finder->findAll());
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
