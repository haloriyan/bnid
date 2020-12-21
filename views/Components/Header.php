<?php
use App\Framework\Auth as Auth;
?>
<style>
    header {
        position: fixed;
        top: 0px;left: 0px;right: 0px;
        height: 70px;
        background-color: #fff;
        border-bottom: 1px solid #ddd;
        z-index: 2;
    }
    header a { color: #444 !important; }
    header .logo {
        float: left;
        margin-left: 5%;
        margin-top: 5px;
        width: 180px;
        height: 55px;
    }
    header nav {
        display: block !important;
        float: right;
        margin-right: 5%;
        margin-top: 22px;
    }
    header nav li {
        float: left;
        list-style: none;
        padding: 0px 25px;
        cursor: pointer;
        position: relative;
    }
    header nav li ul {
        background-color: #fff;
        border-radius: 6px;
        padding: 0px;
        position: absolute;
        right: 5%;top: 4px;
        width: 200px;
        border: 1px solid #ddd;
        display: none;
    }
    header nav li:hover ul { display: block; }
    header nav li ul li {
        float: none;
        line-height: 45px;
    }
    header nav li ul li:hover { background-color: #efefef; }
    header form {
        position: fixed;
        top: -370px;left: 20%;right: 20%;
        background-color: #fff;
        padding: 25px;
        box-sizing: border-box;
        border: 1px solid #ddd;
        border-bottom-left-radius: 6px;
        border-bottom-right-radius: 6px;
        border-top: none;
        transition: 0.4s;
    }
    header form .box {
        margin-top: 0px;
        width: 95%;
        padding: 0px 45px 0px 20px;
    }
    header form button {
        width: auto;
        background: none;
        padding: 0px;
    }
    header form #searchBtn { margin-left: -35px; }
    header form #xSearch { margin-left: 30px; }
    @media (max-width: 480px) {
        header nav li ul { top: 29px; }
        header form { left: 0px;right: 0px; }
        header form .box { width: 90%; }
    }
</style>
<header>
    <a href="<?= route('/') ?>">
        <div class="logo" bg-image="<?= base_url() ?>/image/logo.jpg"></div>
    </a>
    <nav>
        <li onclick="openSearchForm()">
            <i class="fas fa-search"></i>
        </li>
        <li>
            <i class="fas fa-user"></i>
            <?php if (Auth::guard('user')->check()) : ?>
                <ul>
                    <a href="<?= route('account') ?>">
                        <li>Account</li>
                    </a>
                    <a href="<?= route('history') ?>">
                        <li>History</li>
                    </a>
                    <a href="<?= route('logout') ?>">
                        <li>Logout</li>
                    </a>
                </ul>
            <?php else : ?>
                <ul>
                    <a href="<?= route('login') ?>">
                        <li>Login</li>
                    </a>
                </ul>
            <?php endif ?>
        </li>
    </nav>
    <form action="<?= route('search') ?>">
        <input type="text" class="box" name="q">
        <button id="searchBtn"><i class="fas fa-search"></i></button>
        <button type="button" onclick="closeSearchForm()" id="xSearch"><i class="fas fa-times"></i></button>
    </form>
</header>

<script>
    const openSearchForm = () => {
        select("header form").style.top = "70px"
    }
    const closeSearchForm = () => {
        select("header form").style.top = "-370px"
    }
</script>