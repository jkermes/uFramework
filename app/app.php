 <?php

require __DIR__ . '/../vendor/autoload.php';

use \Exception\HttpException;
use \Http\Request;
use Http\JsonResponse;

// Config
$debug = true;

$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

$finder = new \Model\JsonFinder();

$app->get('/', function () use ($app) {
    $app->redirect('/statuses');
});
/**
 * Index
 */
$app->get('/statuses', function (Request $request) use ($app, $finder) {
    $data = array('statuses' => $finder->findAll());

    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($data);
    }

    return $app->render('index.php', $data);
});

$app->get('/statuses/(\d+)', function (Request $request, $id) use ($app, $finder) {
    if (null === $status = $finder->findOneById($id)) {
        throw new HttpException(404, 'Oups! This status cannot be found :(');
    }

    $data = array('status' => $status);

    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($data);
    }

    return $app->render('status.php', $data);
});

$app->post('/statuses', function (Request $request) use ($app, $finder) {
    $finder->add(
        array(
                'id' => count($finder->findAll()) + 1,
                'message' => $request->getParameter('message'),
                'date' => (new \DateTime('now'))->format('Y-m-d H:i:s'),
                'authorName' => $request->getParameter('authorName'),
                'client' => $request->getParameter('client')

        )
    );
    $finder->persist();

    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse("statuses/" . count($finder->findAll()), 201);
    }

    $app->redirect('/statuses');

    // Note: a REST API should return a 201 status code which stands for Created. It will be useful for the next practical.
    // By now, you can live without that. It also adds a Location header with the URI of the resource that has just been created.
});

$app->delete('/statuses/(\d+)', function (Request $request, $id) use ($app, $finder) {
    if (null === $status = $finder->findOneById($id)) {
        throw new HttpException(404, 'Oups! This status cannot be found :(');
    }

    $finder->remove($id);
    $finder->persist();

    $app->redirect('/statuses');

    // Note: Should return a 204 http status
});

// ...

return $app;
