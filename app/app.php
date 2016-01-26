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
$app->get('/statuses', function (\Http\Request $request) use ($app, $finder) {
    return $app->render('index.php', array('statuses' => $finder->findAll()));
});

$app->get('/statuses/(\d+)', function (\Http\Request $request, $id) use ($app, $finder) {
    if (null === $status = $finder->findOneById($id)) {
        // Doesn't work as expected
        throw new HttpException(404, 'Oups! This status cannot be found :(');
    }

    return $app->render('detail.php', array('status' => $status));
});

$app->post('/statuses', function (\Http\Request $request) use ($app, $finder) {
    $finder->add(
        array(

                'id' => count($finder->findAll()),
                'message' => $request->getParameter('message'),
                'date' => (new \DateTime('now'))->format('Y-m-d H:i:s'),
                'authorName' => $request->getParameter('username'),
                'client' => 'Android 5.0'

        )
    );
    $finder->persist();

    $app->redirect('/statuses');

    // Note: a REST API should return a 201 status code which stands for Created. It will be useful for the next practical.
    // By now, you can live without that. It also adds a Location header with the URI of the resource that has just been created.
});

$app->put('/statuses/(\d+)', function (\Http\Request $request, $id) use ($app, $finder) {
    return $app->render('index.php');
});

$app->delete('/statuses/(\d+)', function (\Http\Request $request, $id) use ($app, $finder) {
    return $app->render('index.php');
});

// ...

return $app;
