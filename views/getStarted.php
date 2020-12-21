<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Getting started... | Belajar Ngeweb ID</title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/auth.css">
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
    
<div class="container">
    <form action="<?= route('get-started/submit') ?>" class="rata-kiri mt-5" method="POST">
        <?php
        $name = explode(" ", $myData->name);
        ?>
        <h2>Halo, <?= $name[0] ?></h2>
        <p>
            Terima kasih telah bergabung dengan komunitas pembelajar pemrograman website paling keren ini.
        </p>
        <p>
            Tapi sebelum kamu mulai belajar sesuatu, mungkin kamu bisa mengatur preferensi tentang apa yang kamu sukai sehingga kami bisa memberikan artikel yang cocok untuk kamu
        </p>
        <input type="hidden" id="favoriteCategory" required name="categories">
        <?php foreach ($categories as $cat) : ?>
            <div class="cats <?= $active ?> pointer" onclick="chooseCat(this)"><?= $cat->category ?></div>
        <?php endforeach ?>
        <button class="oren lebar-100 mt-3">Lanjutkan</button>
    </form>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>
<script>
    let selectedCategories = [];
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
        select("#favoriteCategory").value = selectedCategories.toString()
    }
</script>

</body>
</html>