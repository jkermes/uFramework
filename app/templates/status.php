<h1>Status #<?= $parameters['status']['id']?></h1>

<form action="/statuses/<?= $parameters['status']['id'] ?>" method="POST">
    <input type="hidden" name="_method" value="DELETE">
    <input type="submit" value="Delete">
</form>

<p><?= $parameters['status']['message']?></p>
<p><strong>@<?= $parameters['status']['user_name']?></strong></p>
<p>Posted at <?= $parameters['status']['publishDate']?></p>