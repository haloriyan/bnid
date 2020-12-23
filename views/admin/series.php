<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Series | <?= env('APP_NAME') ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/dashboard.css">
</head>
<body>

<?php insert('../Components/Admin/Header', [
    'title' => "Series",
    'actionButton' => "<a href='".route('admin/series/create')."'><button class='bg-oren-transparan'>Add New</button></a>"
]); ?>
<?php insert('../Components/Admin/Menu'); ?>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Posts Count</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($series->get() as $series) : ?>
                <tr>
                    <td><?= $series->title ?></td>
                    <td><?= count($series->posts) ?></td>
                    <td>
                        <a href="<?= route('admin/series/'.$series->id.'/posts') ?>" class="teks-biru">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

</body>
</html>