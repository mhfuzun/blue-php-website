<?php require_once "config/bootstrap.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?></title>
    
    <link rel="stylesheet" href="<?= common::getUrl() . Config::get('assets.css.bootstrap') ?>">
    <link rel="stylesheet" href="<?= common::getUrl() . Config::get('assets.css.custome') ?>">
    <script src="<?= common::getUrl() . Config::get('assets.js.bootstrap') ?>"></script>
</head>
<body>

<?php require 'navbar.php'; ?>

<main>
    <?php require __DIR__ . "/../$view.php"; ?>
</main>

<?php require 'footer.php'; ?>

</body>
</html>
