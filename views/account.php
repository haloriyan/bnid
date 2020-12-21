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
        <div class="mt-2">Change Password :</div>
        <input type="password" class="box" name="password">
        <div class="mt-1 teks-transparan">(biarkan kosong jika tidak ingin mengganti password)</div>
        <button class="oren lebar-100 mt-3">Update</button>
    </form>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>

</body>
</html>