<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= env('APP_DESCRIPTION') ?>">
    <meta name="keyword" content="<?= env('APP_KEYWORD') ?>">
    <meta name="robots" content="index, follow">
    <title><?= $series->title ?> | <?= env("APP_NAME") ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/index.css">
    <style>
        .item .bagi-4:nth-child(1),
        .item .bagi-4:nth-child(6) {
            width: 50%;
        }
        .item .bagi-4:nth-child(1) .wrap,
        .item .bagi-4:nth-child(6) .wrap {
            margin: 2.5% 5%;
        }
    </style>
</head>
<body>
    
<?php insert('./Components/Header'); ?>

<div class="container">
    <div class="wrap">
        <h2>Seri <?= $series->title ?></h2>
        <p><?= $series->description ?></p>

        <div class="item">
            <?php foreach ($contents as $post) : ?>
                <?php
                $star = $post->posts[0]->is_premium == 1 ? "<i class='fas fa-star teks-emas'></i>" : "";
                ?>
                <div class="bagi bagi-4">
                    <div class="wrap">
                        <a href="<?= route('read/'.$post->posts[0]->slug.'?series_id='.$series->id) ?>">
                            <div class="post">
                                <div class="tinggi-200 rounded featuredImage" bg-image="<?= base_url() ?>/storage/featured_image/<?= $post->posts[0]->featured_image ?>"></div>
                                <h3><?= $post->posts[0]->title ?> <?= $star ?></h3>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <?php insert('./Components/Footer'); ?>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>

</body>
</html>