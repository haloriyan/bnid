<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media | <?= env('APP_NAME') ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/dashboard.css">
    <style>
        .uploadArea {
            border: 2px dotted #ddd;
            height: 90px;
            padding: 30px 0px 0px 0px;
            width: 100%;
            display: inline-block;
        }
        input.uploadArea {
            margin-top: -300px;
            position: relative;
            top: -100px;
            height: 95px;
            opacity: 0.01;
        }
        #loadedMedia { margin-top: -80px; }
    </style>
</head>
<body>

<?php
insert('../Components/Admin/Header', [
    'title' => "Media",
    'actionButton' => "<a href='".route('admin/post/create')."'><button class='bg-oren-transparan'>Add New</button></a>"
]);
?>
<?php insert('../Components/Admin/Menu'); ?>

<div class="container">
    <div class="rata-tengah rounded uploadArea">
        <h3>Upload File Here</h3>
    </div>
    <input type="file" name="file" onchange="uploadFile(this)" class="uploadArea">
    <div id="loadedMedia"></div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="popupDetail">
    <div class="popup">
        <div class="wrap">
            <h3>Detail Media
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#popupDetail')"></i>
            </h3>
            <img class="lebar-100" />
            <div class="mt-2">Filename : <div id="fileName"></div></div>
            <div class="mt-2">URL :</div>
            <input type="text" class="box" id="url">
        </div>
    </div>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>
<script>
    const load = () => {
        let req = fetch("<?= route('admin/media/load') ?>")
        .then(res => res.json())
        .then(result => {
            select("#loadedMedia").innerHTML = ""
            result.forEach(res => {
                createElement({
                    el: 'div',
                    attributes: [
                        ['class', 'bagi bagi-4'],
                        ['onclick', `detail(${JSON.stringify(res)})`]
                    ],
                    html: `<div class="wrap">
        <div class="tinggi-200 pointer" bg-image="<?= base_url() ?>/storage/media/${res.filename}"></div>
    </div>`,
                    createTo: '#loadedMedia'
                });
                bindDivWithImage();
            })
        })
    }
    load()
    const uploadFile = (input) => {
        let file = input.files[0];
        let data = new FormData();
        data.append('file', file);

        let req = fetch("<?= route('admin/media/upload') ?>", {
            method: 'POST',
            body: data
        })
        .then(res => res.json())
        .then(res => {
            load()
        })
    }
    const detail = data => {
        munculPopup("#popupDetail")
        select("#popupDetail #url").value = `<?= base_url() ?>/storage/media/${data.filename}`;
        select("#popupDetail #fileName").innerText = data.filename;
        select("#popupDetail img").setAttribute('src', `<?= base_url() ?>/storage/media/${data.filename}`)
    }
</script>

</body>
</html>