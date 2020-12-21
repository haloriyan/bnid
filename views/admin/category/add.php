<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category | <?= env('APP_NAME') ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/dashboard.css">
</head>
<body>

<?php insert('../../Components/Admin/Header', ['title' => "Add Category"]); ?>
<?php insert('../../Components/Admin/Menu'); ?>

<div class="container">
    <form action="<?= route('admin/category/store') ?>" method="POST">
        <div class="mt-2">Name :</div>
        <input type="text" class="box" name="name">
        <button class="lebar-100 oren mt-3">Submit</button>
    </form>
</div>

</body>
</html>