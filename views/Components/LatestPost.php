<style>
    a { color: #444; }
</style>
<h2>Post Terbaru</h2>
<div class="posts">
    <?php foreach ($latestPosts as $post) : ?>
        <?php
        $star = $post->is_premium == 1 ? "<i class='fas fa-star teks-emas'></i>" : "";
        ?>
        <div class="bagi bagi-4">
            <div class="wrap">
                <a href="<?= route('read/'.$post->slug) ?>">
                    <div class="post">
                        <div class="tinggi-200 rounded" bg-image="<?= base_url() ?>/storage/featured_image/<?= $post->featured_image ?>"></div>
                        <h3><?= $post->title ?> <?= $star ?></h3>
                    </div>
                </a>
            </div>
        </div>
    <?php endforeach ?>

    <br />
    <a href="<?= route('latest') ?>">
        <button class="bg-oren-transparan p-1 pl-2 pr-2 tinggi-40">Eksplor lainnya</button>
    </a>
</div>