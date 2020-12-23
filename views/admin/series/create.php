<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Series | <?= env('APP_NAME') ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/dashboard.css">
</head>
<body>

<?php insert('../../Components/Admin/Header', ['title' => "Create Series"]); ?>
<?php insert('../../Components/Admin/Menu'); ?>

<div class="container">
    <form action="<?= route('admin/series/store') ?>" method="POST">
        <div class="mt-2">Title :</div>
        <input type="text" class="box" name="title" required>
        <div class="mt-2">Slug :</div>
        <input type="text" class="box" name="slug" required>
        <div class="mt-2">Description :</div>
        <textarea name="description" rows="10" class="box"></textarea>

        <button class="oren lebar-100 mt-3">Create</button>
    </form>
</div>

</body>
</html>