<?php
    if(isset($_SESSION['username'])){
        $isLogin = true;
    }
?>
<div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="./" class="brand d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            Booking
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="./" class="nav-link px-2 link-secondary">Home</a></li>
            <li><a href="./cek-lapang.php" class="nav-link px-2 link-dark">Cek Kesediaan Lapang</a></li>
            <?php if(isset($isLogin)) : ?>
                <li><a href="./pesanan.php" class="nav-link px-2 link-dark">Pesanan</a></li>
                <li><a href="./riwayat-pesanan.php" class="nav-link px-2 link-dark">Riwayat Pesanan</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
            <?php endif ?>
        </ul>

        <div class="col-md-3 text-end">
            <?php if(isset($isLogin)): ?>
                <span><?= $_SESSION['username']?></span>
                <a href="logout.php" class="btn btn-outline-danger me-2">Logout</a>
            <?php else : ?>
                <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
                <a href="register.php" class="btn btn-primary">Sign-up</a>
            <?php endif ?>
        </div>
        </header>
    </div>