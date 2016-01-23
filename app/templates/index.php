<h1>Statuses</h1>

<ol>
    <?php foreach ($parameters['statuses'] as $id => $status) : ?>
            <li class="tweet">
                <?= $status['message'] ?> <strong>@<?= $status['authorName'] ?></strong>
                <?= $status['date'] ?>
            </li>
    <?php endforeach; ?>
</ol>
