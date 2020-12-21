<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments | <?= env('APP_NAME') ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/dashboard.css">
</head>
<body>

<?php
insert('../../Components/Admin/Header', [
    'title' => "Posts",
    'actionButton' => "<a href='".route('admin/post/create')."'><button class='bg-oren-transparan'>Add New</button></a>"
]);
?>
<?php insert('../../Components/Admin/Menu'); ?>

<div class="container">
    <h2>Comments on <?= $post->title ?></h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Comment</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comments as $comment) : ?>
                <tr>
                    <td><?= $comment->users[0]->name ?></td>
                    <td><?= $comment->body ?></td>
                    <td>
                        <a href="<?= route('comment/'.$comment->id.'/delete') ?>" class="teks-merah">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

</body>
</html>