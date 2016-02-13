<h1>Status #<?= $status->getId() ?></h1>

<form action="/statuses/<?= $status->getId() ?>" method="POST">
    <input type="hidden" name="_method" value="DELETE">
    <input type="submit" value="Delete">
</form>

<p><?= $status->getMessage() ?></p>
<p><strong>@<?= $status->getUserName()?></strong></p>
<p>Posted at <?= $status->getPublishDate()->format('Y-m-d H:i') ?></p>