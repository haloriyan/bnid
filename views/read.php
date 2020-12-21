<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= substr(htmlspecialchars($post->body), 0, 200) ?>">
    <meta name="keyword" content="<?= env('APP_KEYWORD') ?>">
    <meta name="robots" content="index, follow">
    <meta property="og:url" content="<?= base_url() ?>/read/<?= $post->slug ?>">
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?= $post->title ?>">
    <meta property="og:description" content="<?= substr(htmlspecialchars($post->body), 0, 200) ?>">
    <meta property="og:image" content="<?= base_url() ?>/storage/featured_image/<?= $post->featured_image ?>">
    <title><?= $post->title ?> | <?= env("APP_NAME") ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.4.1/styles/default.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/read.css">
    <style>
        #postContent img {
            text-align: center;
        }
    </style>
</head>
<body>
    
<?php insert('./Components/Header'); ?>

<div class="featuredImage" bg-image="<?= base_url() ?>/storage/featured_image/<?= $post->featured_image ?>">
    <div class="content">
        <div>
            <h1><?= $post->title ?></h1>
            <div class="d-inline-block mr-1"><i class="fas fa-tags"></i> <?= implode(", ", explode(",", $post->categories)) ?></div>
        </div>
    </div>
</div>

<div class="container">
    <textarea class="d-none" name="body" id="body"><?= $post->body ?></textarea>
    <div class="content" id="postContent"></div>

    <?php insert("./Components/PostComment", ['comments' => $comments]) ?>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>
<script src="<?= base_url() ?>/js/masonry.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/remarkable/1.7.1/remarkable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.4.1/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<script>
    let masonElemen = select(".commentsArea");
    let msnry = new Masonry(masonElemen, {
        itemSelector: '.comment',
        columnWidth: 14,
        containerStyle: null
    })

    let md = new Remarkable();
    let content = select("#body").value;
    select("#postContent").innerHTML = md.render(content)
</script>

</body>
</html>