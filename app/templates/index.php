<!DOCTYPE html>
<html  lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>uFramework</title>
</head>
<body>
    <nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
      <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2">
        &#9776;
    </button>
    <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
        <a class="navbar-brand" href="">uFramework</a>
        <ul class="nav navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Profile</a>
        </li>
    </ul>
</div>
</nav>
<div class="container">
    <div class="row" id="main-content">
        <div class="col-sm-4">
           <form action="/statuses" method="POST">
            <input type="hidden" name="_method" class="form-control" value="POST">
            <fieldset class="form-group">
                <label for="authorName">Username:</label>
                <input type="text" class="form-control" name="authorName">
            </fieldset>
            <fieldset class="form-group">
                <label for="message">Message:</label>
                <textarea name="message" class="form-control"></textarea>
            </fieldset>
            <input type="submit"  class="btn btn-primary-outline" value="Tweet!">
        </form>
    </div>
    <div class="col-sm-8">
        <?php foreach ($parameters['statuses'] as $status) : ?>
            <div class="tweet card card-block">
                <p class="card-title">@<?= $status->getUserName() ?> - <?= $status->getPublishDate()->format('Y-m-d H:i') ?></p>
                <p class="card-text"><?= $status->getMessage() ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
</body>
</html>


