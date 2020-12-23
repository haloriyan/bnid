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
    <style>
        a { color: #444; }
    </style>
</head>
<body>
    
<?php insert('./Components/Header'); ?>

<div class="container">
    <div class="wrap">
        <h2>Artikel terbaru</h2>
        <?php foreach ($posts->get() as $post) : ?>
            <?php
            $star = $post->is_premium == 1 ? "<i class='fas fa-star teks-emas'></i>" : "";
            ?>
            <div class="bagi bagi-4">
                <div class="wrap">
                    <a href="<?= route('read/'.$post->slug) ?>">
                        <div class="post">
                            <div class="tinggi-200 rounded" bg-image="<?= base_url() ?>/storage/featured_image/<?= $post->featured_image ?>"></div>
                            <h3><?= $post->title ?> <?= $star ?></h3>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach ?>

        <div class="mt-1"></div>
        <?= $posts->links() ?>
    </div>
    <?php insert('./Components/Footer'); ?>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>

</body>
</html>