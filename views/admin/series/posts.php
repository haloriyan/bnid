<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $series->title ?>'s posts | <?= env('APP_NAME') ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/dashboard.css">
</head>
<body>

<?php insert('../../Components/Admin/Header', [
    'title' => $series->title."'s posts",
    'actionButton' => "<button onclick='addPost()' class='bg-oren-transparan'>Add Post</button>"
]); ?>
<?php insert('../../Components/Admin/Menu'); ?>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Post Title</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $alreadySelected = [];
            ?>
            <?php foreach($datas as $post) : ?>
                <?php
                array_push($alreadySelected, $post->id);
                ?>
                <tr>
                    <td><?= $post->posts[0]->title ?></td>
                    <td>
                        <a href="<?= route('admin/series/'.$series->id.'/posts/remove/'.$post->posts[0]->id) ?>"><i class="fas fa-times teks-merah"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <input type="hidden" id="alreadySelected" value="<?= implode(',', $alreadySelected) ?>">
</div>

<div class="bg"></div>
<div class="popupWrapper" id="addPost">
    <div class="popup">
        <div class="wrap">
            <h3>Add post to this series
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#addPost')"></i>
            </h3>
            <form action="<?= route('admin/series/'.$series->id.'/posts/add') ?>" method="POST">
                <input type="hidden" name="posts" id="posts">
                <div id="renderArea"></div>

                <div class="mt-2">Search post :</div>
                <input type="text" class="box" oninput="search(this.value)">

                <div class="mt-2">Search Result :</div>
                <table>
                    <thead>
                        <tr>
                            <th>Post Title</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="loadPosts"></tbody>
                </table>

                <button class="oren lebar-100 mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>
<script>
    let selectedPosts = [];
    let searchResults = [];
    let selectedPostsFullData = [];
    let alreadySelected = select("#alreadySelected").value.split(",");

    const addPost = () => {
        munculPopup("#addPost");
    }
    const search = q => {
        if (q.length < 3) {
            return false;
        }
        let req = post("<?= route('admin/series/searchPost') ?>", {
            q: q
        })
        .then(result => {
            searchResults = result;
            renderSearchResults();
        });
    }
    const renderSearchResults = () => {
        select("#loadPosts").innerHTML = "";
        searchResults.forEach(res => {
            if (!inArray(res.id, selectedPosts) && !inArray(res.id, alreadySelected)) {
                createElement({
                    el: 'tr',
                    html: "<td>" + res.title + "</td><td><i class='fas fa-check teks-hijau pointer' onclick='choosePost(`" + res.id +"`, `" + JSON.stringify(res) +"`)'></i>",
                    createTo: '#loadPosts'
                });
            }
        });
    }
    const renderSelected = () => {
        select("#renderArea").innerHTML = "";
        selectedPosts.forEach(id => {
            selectedPostsFullData.forEach(post => {
                if (id == post.id) {
                    createElement({
                        el: 'div',
                        attributes: [
                            ['class', 'item bg-hijau p-1 mt-1 pl-2 pr-2 mr-1 rounded-circle d-inline-block']
                        ],
                        html: `${post.title} <i class="fas fa-times ml-1 pointer" onclick="removePost(${post.id})"></i>`,
                        createTo: "#renderArea"
                    });
                }
            });
        });
    }
    const choosePost = (id, data) => {
        data = JSON.parse(data);
        selectedPosts.push(id);
        selectedPostsFullData.push(data);
        select("#posts").value = selectedPosts.join(',');
        renderSearchResults();
        renderSelected();
    }
    const removePost = id => {
        removeArray(selectedPosts, id);
        renderSearchResults();
        renderSelected();
        select("#posts").value = selectedPosts.join(',');
    }
</script>

</body>
</html>