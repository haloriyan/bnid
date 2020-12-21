<style>
    .category-item {
        display: inline-block;
        background-color: #ddd;
        padding: 15px 25px;
        border-radius: 909px;
        margin-right: 10px;
    }
    .category-item:hover {
        background-color: #f15b2d;
        color: #fff;
    }
</style>
<h2>atau jelajahi kategori</h2>
<?php foreach ($categories as $category) : ?>
    <a href="<?= route('category/'.strtolower($category->category)) ?>">
        <div class="category-item"><?= $category->category ?></div>
    </a>
<?php endforeach ?>