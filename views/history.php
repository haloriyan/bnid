<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History | <?= env("APP_NAME") ?></title>
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
    <h2>History</h2>
    <?php foreach ($histories as $post) : ?>
        <div class="bagi bagi-4">
            <div class="wrap">
                <a href="<?= route('read/'.$post->posts[0]->slug) ?>">
                    <div class="item">
                        <div class="wrap">
                            <div class="tinggi-200 rounded" bg-image="<?= base_url() ?>/storage/featured_image/<?= $post->posts[0]->featured_image ?>"></div>
                            <h3><?= $post->posts[0]->title ?></h3>
                            <p class="teks-transparan"><?= $post->counter ?>x</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php endforeach ?>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>

</body>
</html>