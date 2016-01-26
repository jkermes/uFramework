<h1>Statuses</h1>

<form action="/statuses" method="POST">
    <input type="hidden" name="_method" value="POST">

    <label for="username">Username:</label>
    <input type="text" name="username">

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
