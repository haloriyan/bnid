<style>
    .SeriesInfo {
        position: absolute;
        top: 520px;right: 2.5%;left: 72.5%;
        background-color: #fff;
    }
    .SeriesInfo .content {
        height: 250px;
        overflow: auto;
    }
    .SeriesInfo li {
        list-style: none;
        border-bottom: 1px solid #ddd;
        padding: 12px 0px;
    }
    .SeriesInfo li.active {
        background-color: #f15b2d;
        color: #fff;
        padding: 12px 15px;
        border-radius: 6px;
    }
</style>
<div class="SeriesInfo bayangan-5 rounded">
    <div class="wrap">
        <h3>Seri <?= $series->title ?></h3>
        <div class="content">
            <?php foreach ($contents as $content) : ?>
                <?php
                $active = $content->posts[0]->id == $post->id ? "class='active'" : "";
                ?>
                <a href="<?= route('read/'.$content->posts[0]->slug.'?series_id='.$series->id) ?>">
                    <li <?= $active ?>><?= $content->posts[0]->title ?></li>
                </a>
            <?php endforeach ?>
        </div>
    </div>
</div>