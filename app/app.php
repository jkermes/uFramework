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
    $connection = new Connection('mysql:host=localhost:32769;dbname=uframework', 'uframework', 'p4ssw0rd');
} catch (PDOException $e) {
     if (true === $debug) {
         echo $e->getMessage();
     }
}

$statusFinder = new StatusFinder($connection);
$statusDM = new StatusDataMapper($connection);

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
    if (!is_null($request->getParameter('where'))) {
        $criteria['where'] = $request->getParameter('where');
    }

    if (!is_null($request->getParameter('orderBy'))) {
        $criteria['orderBy'] = $request->getParameter('orderBy');
    }

    if (!is_null($request->getParameter('limit'))) {
        $criteria['limit'] = $request->getParameter('limit');
    }

    $data = array('statuses' => $statusFinder->findAll($criteria));

    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($data);
    }

    return $app->render('index.php', $data);
});

/**
 * Get a status
 */
$app->get('/statuses/(\d+)', function (Request $request, $id) use ($app, $statusFinder) {
    if (is_null($status = $statusFinder->findOneById($id))) {
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
$app->post('/statuses', function (Request $request) use ($app, $statusFinder, $statusDM) {
    $status = new Status(
        null,
        $request->getParameter('message'),
        $request->getParameter('authorName'),
        new DateTime(),
        $request->getUserAgent()
    );

    $statusDM->persist($status);

    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse("statuses/" . count($statusFinder->findAll()), 201);
    }

    $app->redirect('/statuses');
});

/**
 * Delete a status
 */
$app->delete('/statuses/(\d+)', function (Request $request, $id) use ($app, $statusFinder, $statusDM) {
    if (is_null($status = $statusFinder->findOneById($id))) {
        throw new HttpException(404, 'Oups! This status cannot be found :(');
    }

    $statusDM->remove($status);

    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse(null, 204);
    }

    $app->redirect('/statuses');
});

return $app;
