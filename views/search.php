<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searching <?= $q ?>... | <?= env("APP_NAME") ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/index.css">
</head>
<body>
    
<?php insert('./Components/Header'); ?>

<div class="container">
    <div class="wrap">
        <?php insert('./Components/SearchPost', ['q' => $q]); ?>
    </div>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>

</body>
</html>