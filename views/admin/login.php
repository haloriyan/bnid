<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Belajar Ngeweb ID</title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/auth.css">
</head>
<body>
    
<div class="container">
    <img src="<?= base_url() ?>/image/logo.jpg" alt="Logo Belajar Ngeweb ID" class="logo">
    <form action="<?= route('admin/loginAction') ?>" class="rata-kiri mt-5" method="POST">
        <?php if (@$message != "") : ?>
            <div class="bg-merah-transparan p-2 rounded mb-3">
                <?= $message ?>
            </div>
        <?php endif ?>
        <div class="mt-2">Email :</div>
        <input type="email" class="box" name="email" required value="admin@gmail.com">
        <div class="mt-2">Password :</div>
        <input type="password" class="box" name="password" required value="inikatasandi">
        <button class="oren lebar-100 mt-3">Login</button>
    </form>
</div>

</body>
</html>