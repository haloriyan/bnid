<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories | <?= env('APP_NAME') ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/dashboard.css">
</head>
<body>

<?php
insert('../Components/Admin/Header', [
    'title' => "Categories",
    'actionButton' => "<a href='".route('admin/category/add')."'><button class='bg-oren-transparan'>Add New</button></a>"
]);
?>
<?php insert('../Components/Admin/Menu'); ?>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th>Post count</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories->get() as $cat) : ?>
                <tr>
                    <td><?= $cat->category ?></td>
                    <td><?= $cat->counter ?></td>
                    <td>
                        <a href="#" class="teks-merah"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?= $categories->links() ?>
</div>

</body>
</html>