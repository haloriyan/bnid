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
    
<div class="container">
    <form action="<?= route('get-premium/submit') ?>" class="rata-kiri mt-5" method="POST">
        <?php
        $name = explode(" ", $myData->name);
        ?>
        <h2>Terima kasih sudah menjadi bagian kami</h2>
        <p>
            Mohon tunggu beberapa waktu untuk admin menjadikan akun kamu jadi premium. Kalau dirasa terlalu lama, kamu bisa menjapri admin melalui <a href="https://wa.me/62881036183076">WhatsApp</a>
        </p>
        <a href="<?= route('/') ?>">
            <button type="button" class="oren mt-3 lebar-100">kembali ke Halaman Utama</button>
        </a>
    </form>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>

</body>
</html>