<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users | <?= env('APP_NAME') ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/dashboard.css">
    <link rel="stylesheet" href="<?= base_url() ?>/js/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/js/flatpickr/dist/themes/material_blue.css">
</head>
<body>

<?php insert('../Components/Admin/Header', ['title' => "Users"]); ?>
<?php insert('../Components/Admin/Menu'); ?>

<div class="container">
    <form action="<?= route('admin/user') ?>">
        <div class="mt-2">Cari user :</div>
        <input type="text" class="box" name="q" value="<?= $q ?>">
    </form>
    <table class="mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Premium sampai</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users->get() as $user) : ?>
                <tr>
                    <td><?= $user->name ?></td>
                    <td><?= $user->premium_until ?></td>
                    <td>
                        <a class="teks-biru pointer" onclick='edit(<?= json_encode($user) ?>)'>
                            <i class="fas fa-edit"></i>
                        </a>
                        &nbsp;
                        <a href="#" class="teks-merah">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <?= $users->links() ?>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="editForm">
    <div class="popup">
        <div class="wrap">
            <h3>Edit Data
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#editForm')"></i>
            </h3>
            <form action="<?= route('admin/user/update') ?>" method="POST">
                <input type="hidden" name="user_id" id="user_id">
                <div class="mt-2">Nama :</div>
                <input type="text" class="box" name="name" id="name">
                <div class="mt-2">Premium sampai :</div>
                <input type="text" class="box" id="premiumUntil" name="premium_until">

                <button class="lebar-100 oren mt-3">Update</button>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>
<script src="<?= base_url() ?>/js/flatpickr/dist/flatpickr.min.js"></script>
<script>
    const edit = data => {
        munculPopup("#editForm");
        select("#editForm #name").value = data.name;
        select("#editForm #user_id").value = data.id;
        select("#editForm #premiumUntil").value = data.premium_until;
    }
    flatpickr("#premiumUntil", {
        dateFormat: 'Y-m-d',
        minDate: "<?= date('Y-m-d') ?>"
    })
</script>

</body>
</html>