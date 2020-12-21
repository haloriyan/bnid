<style>
    .recommendation .bagi-4:nth-child(1),
    .recommendation .bagi-4:nth-child(6) {
        width: 50%;
    }
    .recommendation .bagi-4:nth-child(1) .wrap,
    .recommendation .bagi-4:nth-child(6) .wrap {
        margin: 2.5% 5%;
    }
</style>
<h2>Mungkin Kamu Suka</h2>
<div class="recommendation">
    <?php foreach ($recommendedPosts as $post) : ?>
        <?php
        $star = $post->is_premium == 1 ? "<i class='fas fa-star teks-emas'></i>" : "";
        ?>
        <div class="bagi bagi-4">
            <div class="wrap">
                <a href="<?= route('read/'.$post->slug) ?>">
                    <div class="post">
                        <div class="tinggi-200 rounded featuredImage" bg-image="<?= base_url() ?>/storage/featured_image/<?= $post->featured_image ?>"></div>
                        <h3><?= $post->title ?> <?= $star ?></h3>
                    </div>
                </a>
            </div>
        </div>
    <?php endforeach ?>
</div>