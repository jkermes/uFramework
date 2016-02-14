<?php

require __DIR__ . '/../vendor/autoload.php';

use Exception\HttpException;
use Http\Request;
use Http\JsonResponse;
use View\TemplateEngine;
use Model\Connection;
use Model\StatusFinder;
use Model\DataMapper\StatusDataMapper;
use Model\Entity\Status;

// Config
$debug = true;

$app = new App(new TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

try {
    $connection = new Connection('mysql:host=localhost:32768;dbname=uframework', 'uframework', 'p4ssw0rd');
} catch (PDOException $e) {
     if (true === $debug) {
         echo $e->getMessage();
     }
}

$statusFinder = new StatusFinder($connection);

/**
 * Redirect '/' to '/statuses'
 */
$app->get('/', function () use ($app) {
    $app->redirect('/statuses');
});

/**
 * Statuses list
 */
$app->get('/statuses', function (Request $request) use ($app, $statusFinder) {
    $data = array('statuses' => $statusFinder->findAll());

    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($data);
    }

    return $app->render('index.php', $data);
});

/**
 * Get a status
 */
$app->get('/statuses/(\d+)', function (Request $request, $id) use ($app, $statusFinder) {
    if (null === $status = $statusFinder->findOneById($id)) {
        throw new HttpException(404, 'Oups! This status cannot be found :(');
    }

    $data = array('status' => $status);

    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($data);
    }

    return $app->render('status.php', $data);
});

/**
 * Add a status
 */
$app->post('/statuses', function (Request $request) use ($app, $statusFinder) {
    $statusFinder->add(
        array(
                'id' => count($statusFinder->findAll()) + 1,
                'message' => $request->getParameter('message'),
                'date' => (new \DateTime('now'))->format('Y-m-d H:i:s'),
                'authorName' => $request->getParameter('authorName'),
                'client' => $request->getParameter('client')

        )
    );
    $statusFinder->persist();

    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse("statuses/" . count($statusFinder->findAll()), 201);
    }

    $app->redirect('/statuses');

    // Note: a REST API should return a 201 status code which stands for Created. It will be useful for the next practical.
    // By now, you can live without that. It also adds a Location header with the URI of the resource that has just been created.
});

/**
 * Delete a status
 */
$app->delete('/statuses/(\d+)', function (Request $request, $id) use ($app, $statusFinder) {
    if (null === $status = $statusFinder->findOneById($id)) {
        throw new HttpException(404, 'Oups! This status cannot be found :(');
    }

    $statusFinder->remove($id);
    $statusFinder->persist();

    $app->redirect('/statuses');

    // Note: Should return a 204 http status
});

// ...

return $app;
