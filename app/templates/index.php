<h1>Statuses</h1>

<ol>
    <form action="" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="submit">
    </form>
    <?php foreach ($parameters['statuses'] as $id => $status) : ?>
            <li class="tweet">
                <?= $status['message'] ?> <strong>@<?= $status['authorName'] ?></strong>
                <?= $status['date'] ?>
            </li>
    <?php endforeach; ?>
</ol>
