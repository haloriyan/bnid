<?php
use App\Framework\Auth;
?>
<div class="comments mt-5">
    <h2>Diskusi tentang postingan ini</h2>
    <div class="commentsArea">
        <?php foreach ($comments as $comment) : ?>
            <div class="comment">
                <div class="wrap">
                    <div class="rounded bayangan-5 smallPadding">
                        <div class="wrap">
                            <h3><?= $comment->users[0]->name ?></h3>
                            <p><?= $comment->body ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <?php if (Auth::guard('user')->check()) : ?>
        <div class="rata-tengah mt-3">
            <form action="<?= route('comment/store') ?>" method="POST" class="lebar-80 d-inline-block rata-kiri">
                <h3>Berikan komentarmu...</h3>
                <input type="hidden" name="post_id" value="<?= $post->id ?>">
                <textarea name="body" rows="10" class="box"></textarea>
                <button class="ke-kanan oren mt-3">Submit</button>
            </form>
        </div>
    <?php else : ?>
        <h3>Kamu tidak bisa berkomentar karena belum <a href="<?= route('login') ?>">login</a></h3>
    <?php endif ?>
</div>