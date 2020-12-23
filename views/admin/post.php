<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts | <?= env('APP_NAME') ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/dashboard.css">
    <style>
        table a { color: #444;text-decoration: underline; }
    </style>
</head>
<body>

<?php
insert('../Components/Admin/Header', [
    'title' => "Posts",
    'actionButton' => "<a href='".route('admin/post/create')."'><button class='bg-oren-transparan'>Add New</button></a>"
]);
?>
<?php insert('../Components/Admin/Menu'); ?>

<div class="container">
    <form action="<?= route('admin/post') ?>" class="mb-4">
        <div class="mt-2">Search :</div>
        <input type="text" class="box" name="q" value="<?= $q ?>">
    </form>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Comments</th>
                <th class="lebar-20"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts->get() as $post) : ?>
                <tr>
                    <td>
                        <a href="<?= route('read/'.$post->slug) ?>" target="_blank">
                            <?= $post->title ?>
                        </a>
                    </td>
                    <td><?= count($post->comments) ?></td>
                    <td>
                        <a href="<?= route('admin/post/'.$post->id.'/edit') ?>" class="teks-biru"><i class="fas fa-edit"></i></a>
                        &nbsp; &nbsp;
                        <a href="<?= route('admin/post/'.$post->id.'/comments') ?>" class="teks-hijau"><i class="fas fa-comments"></i></a>
                        &nbsp; &nbsp;
                        <a href="<?= route('admin/post/'.$post->id.'/delete') ?>" class="teks-merah"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?= $posts->links() ?>
</div>

</body>
</html>