<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya di Belajar Ngeweb ID</title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/auth.css">
    <style>
        .profile {
            margin-top: 40px;
            display: inline-block;
            width: 120px;
            line-height: 120px;
            font-family: LivvicBold;
            font-size: 25px;
        }
        .container { padding-bottom: 80px; }
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

<?php insert("./Components/Header") ?>

<?php
use \Carbon\Carbon;
$name = explode(" ", $myData->name);
$initial = $name[0][0].$name[1][0];
$dateNow = date('Y-m-d');

$premiumUntil = $myData->premium_until;
$isPremium = $premiumUntil > $dateNow ? true : false;
if (!$isPremium) {
    $messagePremium = "<a href='".route('get-premium')."'>Upgrade</a> jadi member premium";
}else {
    $messagePremium = "premium sampai ".Carbon::parse($premiumUntil)->format('d M Y');
}

$myFavoriteCategories = explode(",", $myData->favorite_categories);
?>
    
<div class="container">
    <div class="profile bg-oren rounded-circle"><?= $initial ?></div>
    <br />
    <div class="mt-2"><?= $messagePremium ?></div>
    <form action="<?= route('account/update') ?>" class="rata-kiri mt-5" method="POST">
        <div class="mt-2">Nama :</div>
        <input type="text" class="box" name="name" value="<?= $myData->name ?>">
        <div class="mt-2">Email :</div>
        <input type="email" class="box" name="email" value="<?= $myData->email ?>" readonly>
        <div class="mt-2">Ubah Password :</div>
        <input type="password" class="box" name="password">
        <div class="mt-1 teks-transparan">(biarkan kosong jika tidak ingin mengganti password)</div>

        <div class="mt-2">Kategori favorit :</div>
        <input type="hidden" name="favorite_categories" id="categories" value="<?= $myData->favorite_categories ?>">
        <?php foreach ($categories as $category) : ?>
            <div class="cats pointer" onclick="chooseCat(this)"><?= $category->category ?></div>
        <?php endforeach ?>
        
        <button class="oren lebar-100 mt-3">Update</button>
    </form>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>
<script>
    let selectedCategories = select("#categories").value.split(",");
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
        select("#categories").value = selectedCategories.toString();
    }

    const renderCategories = () => {
        selectAll(".cats").forEach(category => {
            let cat = category.innerText;
            if (inArray(cat, selectedCategories)) {
                category.classList.add('active');
            }
        })
    }
    renderCategories();
</script>

</body>
</html>