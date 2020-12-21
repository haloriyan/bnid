<h2>Setelah belajar <?= $post->title ?>, mungkin kamu juga suka ini</h2>
<style>
    .relatedPost .cover {
        border-top-left-radius: 6px;
        border-bottom-left-radius: 6px;
    }
    @media (max-width: 480px) {
        .relatedPost .cover {
            border-radius: 0px;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
            height: 200px;
        }
    }
</style>
<?php foreach ($relatedPosts as $relatedPost) : ?>
    <?php
    $starRelated = $relatedPost->is_premium == 1 ? "<i class='fas fa-star teks-emas'></i>" : "";
    ?>
    <div class="bagi bagi-2">
        <div class="wrap">
            <a href="<?= route('read/'.$relatedPost->slug) ?>">
                <div class="bg-putih rounded bayangan-5 relatedPost">
                    <div 
                        class="bagi lebar-40 tinggi-100 cover" 
                        bg-image="<?= base_url() ?>/storage/featured_image/<?= $relatedPost->featured_image ?>">
                    </div>
                    <div class="bagi lebar-60 smallPadding">
                        <div class="wrap" style="margin: 10%;">
                            <h4><?= $relatedPost->title ?> &nbsp; <?= $starRelated ?></h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
<?php endforeach ?>