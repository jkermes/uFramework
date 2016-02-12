<!DOCTYPE html>
<html>
<head>
    <title>uFramework</title>
    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css" integrity="sha384-XXXXXXXX" crossorigin="anonymous">
    <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js" integrity="sha384-XXXXXXXX" crossorigin="anonymous"></script>
</head>
<body>
<h1>Statuses</h1>
    <form action="/statuses" method="POST">
        <input type="hidden" name="_method" value="POST">

        <label for="authorName">Username:</label>
        <input type="text" name="authorName">

        <label for="message">Message:</label>
        <textarea name="message"></textarea>

        <input type="submit" value="Tweet!">
    </form>
    <ol>
        <?php foreach ($parameters['statuses'] as $id => $status) : ?>
            <li class="tweet">
                <?= $status['message'] ?> <strong>@<?= $status['authorName'] ?></strong>
                <?= $status['date'] ?>
            </li>
        <?php endforeach; ?>
    </ol>
</body>
</html>


