<h2>Artikel Pilihan</h2>
<?php foreach ($premiumPosts as $post) : ?>
    <div class="bagi bagi-4">
        <div class="wrap">
            <a href="<?= route('read/'.$post->slug) ?>">
                <div class="cover-premium tinggi-200 rounded" bg-image="<?= base_url() ?>/storage/featured_image/<?= $post->featured_image ?>"></div>
                <div class="smallPadding">
                    <div class="wrap">
                        <h4><?= $post->title ?></h4>
                    </div>
                </div>
            </a>
        </div>
    </div>
<?php endforeach ?>