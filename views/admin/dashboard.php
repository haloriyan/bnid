<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | <?= env('APP_NAME') ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/dashboard.css">
    <style>
        .card .bg-putih .wrap {
            margin: 10%;
        }
        .card h2 {
            font-size: 35px;
            margin: 0px;
        }
        .card p {
            font-size: 15px;
        }
    </style>
</head>
<body>

<?php insert('../Components/Admin/Header', ['title' => "Dashboard"]); ?>
<?php insert('../Components/Admin/Menu'); ?>

<div class="container">
    <a href="<?= route('admin/user') ?>">
        <div class="bagi bagi-3 card">
            <div class="wrap">
                <div class="bg-putih bayangan-5 rounded smallPadding">
                    <div class="wrap">
                        <h2><?= $users ?></h2>
                        <p>users</p>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <a href="<?= route('admin/post') ?>">
        <div class="bagi bagi-3 card">
            <div class="wrap">
                <div class="bg-putih bayangan-5 rounded smallPadding">
                    <div class="wrap">
                        <h2><?= $posts ?></h2>
                        <p>posts</p>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <div class="mt-2 lebar-100">
        <div class="wrap">
            <div class="bg-putih smallPadding rounded bayangan-5">
                <div class="wrap">
                    <h2>Premium Requests</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Bukti</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($premiumRequests as $request) : ?>
                                <tr>
                                    <td><?= $request->users[0]->name ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>/storage/transfer_evidence/<?= $request->evidence ?>" target="_blank">
                                            Lihat gambar
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= route('admin/acceptPremium/'.$request->users[0]->id) ?>" class="teks-hijau">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>