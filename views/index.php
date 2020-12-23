<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= env('APP_DESCRIPTION') ?>">
    <meta name="keyword" content="<?= env('APP_KEYWORD') ?>">
    <meta name="robots" content="index, follow">
    <title><?= env("APP_NAME") ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/index.css">
</head>
<body>
    
<?php insert('./Components/Header'); ?>

<div class="container">
    <div class="wrap">
        <?php
        use App\Framework\Auth;
        if (Auth::check()) {
            insert('./Components/Recommendation');
        }
        ?>
        <?php insert('./Components/LatestPost'); ?>
        <?php insert('./Components/PremiumPosts'); ?>
        <?php insert('./Components/Categories', ['categories' => $allCategories]); ?>
    </div>
    <?php insert('./Components/Footer'); ?>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>

</body>
</html>