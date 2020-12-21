<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menjadi Premium | Belajar Ngeweb ID</title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/auth.css">
</head>
<body>

<?php
use App\Framework\Auth;
?>
    
<div class="container" style="top: 50px;">
    <form action="<?= route('get-premium/submit') ?>" class="rata-kiri mt-5" method="POST" enctype="multipart/form-data">
        <?php
        $name = explode(" ", $myData->name);
        ?>
        <h2>Pengen belajar tapi terhalang oleh suatu hal? Jadilah Premium! </h2>
        <p>
            Dengan menjadi member premium, kamu akan mendapatkan akses ke semua artikel dengan bebas.
        </p>
        <p>
            Kamu hanya perlu membayar <b>Rp 20.000</b> untuk 30 hari agar dapat membaca semua artikel yang kamu ingin pelajari. Bayar ke :
            <ul>
                <li>BTPN 90400062120 (Riyan Satria Adi Tama)</li>
                <li>OVO 0881036183076 (Riyan Satria Adi Tama)</li>
            </ul>
        </p>
        <?php if (Auth::check()) : ?>
            <p>
                Kemudian upload bukti transfer di sini dan tunggu admin mengaktifkan premium di akun kamu.
            </p>
            <input type="file" class="box" name="evidence" required>
            <button class="oren lebar-100 mt-3">Lanjutkan</button>
        <?php else : ?>
            <p>
                Tapi sebelum menjadi premium, pastikan kamu sudah <a href="<?= route('login') ?>?ref=get-premium">login</a> ya
            </p>
        <?php endif ?>
    </form>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>

</body>
</html>