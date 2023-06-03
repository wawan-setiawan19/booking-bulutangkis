<?php
    if(isset($_SESSION['username'])){
        $isLogin = true;
    }

    $server_admin = $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/booking_bultang/admin';
$server_root = $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/booking_bultang';
?>
<div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="./" class="brand d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            Booking
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="<?=$server_admin?>" class="nav-link px-2 link-secondary">Home</a></li>
            <?php if(isset($isLogin)) : ?>
                <li><a href="<?=$server_admin?>/users/view.php" class="nav-link px-2 link-dark">Pengguna</a></li>
                <li><a href="<?=$server_admin?>/pesanan/view.php" class="nav-link px-2 link-dark">Pesanan</a></li>
                <li><a href="<?=$server_admin?>/pembayaran/view.php" class="nav-link px-2 link-dark">Pembayaran</a></li>
            <?php endif ?>
        </ul>

        <div class="col-md-3 text-end">
            <?php if(isset($isLogin)): ?>
                <span><?= $_SESSION['username']?></span>
                <a href="<?=$server_root?>/logout.php" class="btn btn-outline-danger me-2">Logout</a>
            <?php else : ?>
                <a href="<?=$server_root?>/login.php" class="btn btn-outline-primary me-2">Login</a>
                <a href="<?=$server_root?>/register.php" class="btn btn-primary">Sign-up</a>
            <?php endif ?>
        </div>
        </header>
    </div>
