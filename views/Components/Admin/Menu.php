<nav>
    <a href="<?= route('admin/dashboard') ?>">
        <li>
            <div class="icon"><i class="fas fa-home"></i></div> Dashboard
        </li>
    </a>
    <a href="<?= route('admin/post') ?>">
        <li>
            <div class="icon"><i class="fas fa-edit"></i></div> Posts
        </li>
    </a>
    <a href="<?= route('admin/series') ?>">
        <li>
            <div class="icon"><i class="fas fa-play"></i></div> Series
        </li>
    </a>
    <a href="<?= route('admin/category') ?>">
        <li>
            <div class="icon"><i class="fas fa-tags"></i></div> Category
        </li>
    </a>
    <a href="<?= route('admin/media') ?>">
        <li>
            <div class="icon"><i class="fas fa-images"></i></div> Medias
        </li>
    </a>
    <a href="<?= route('admin/user') ?>">
        <li>
            <div class="icon"><i class="fas fa-users"></i></div> Users
        </li>
    </a>
    <a href="<?= route('admin/logout') ?>">
        <li>
            <div class="icon"><i class="fas fa-sign-out-alt"></i></div> Logout
        </li>
    </a>
</nav>