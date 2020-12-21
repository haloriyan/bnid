<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post | <?= env('APP_NAME') ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/dashboard.css">
    <style>
        .cats {
            background-color: #eee;
            display: inline-block;
            padding: 13px 25px;
            border-radius: 900px;
            margin-top: 13px;
            margin-right: 10px;
        }
        .cats.active {
            background-color: #2ecc71;
            color: #fff;
        }
    </style>
</head>
<body>

<?php insert('../../Components/Admin/Header', ['title' => "Create Post"]); ?>

<div class="container" style="left: 5%">
    <form action="<?= route('admin/post/store') ?>" method="POST" enctype="multipart/form-data">
        <div class="mt-2">Categories :</div>
        <input type="hidden" name="categories" id="categories">
        <?php foreach ($categories as $cat) : ?>
            <div class="cats pointer" onclick="chooseCat(this)"><?= $cat->category ?></div>
        <?php endforeach ?>
        <div class="mt-2">Title :</div>
        <input type="text" class="box" name="title" required>
        <div class="mt-2">Slug :</div>
        <input type="text" class="box" name="slug" required>
        <div class="mt-2">Featured Image :</div>
        <input type="file" class="box" name="featured_image" required>

        <div class="bagi bagi-2">
            <div class="wrap">
                <div class="mt-2">Body :</div>
                <textarea name="body" oninput="preview(this.value)" class="box" style="height: 500px;"></textarea>
            </div>
        </div>
        <div class="bagi bagi-2">
            <div class="wrap">
                <div class="mt-2">Preview :</div>
                <div id="preview" style="height: 500px;overflow: auto;"></div>
            </div>
        </div>

        <div class="mt-3">
            <input type="checkbox" name="is_premium" id="isPremium" />
            <label for="isPremium">
                ini adalah artikel premium
            </label>
        </div>

        <button class="oren lebar-100 mt-3">Post!</button>
    </form>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>
<script src="https://cdn.jsdelivr.net/remarkable/1.7.1/remarkable.min.js"></script>
<script>
    let md = new Remarkable();
    const preview = val => {
        select("#preview").innerHTML = md.render(val);
        select("#preview").scrollTop = select("#preview").scrollHeight;
    }

    let selectedCategories = []
    const chooseCat = dom => {
        let isSelected = dom.classList.contains('active');
        let cat = dom.innerText;
        if (isSelected) {
            dom.classList.remove('active');
            removeArray(selectedCategories, cat);
        }else {
            dom.classList.add('active');
            selectedCategories.push(cat);
        }
        select("#categories").value = selectedCategories.toString()
    }
</script>

</body>
</html>