<?php
    require('config.php');
    $lapang = $_GET['lapang'];
    $jam = $_GET['jam'];
    $tanggal = $_GET['tanggal'];
    $hour = date('G');
    $minute = date('i');
    $second = date('s');
    $timestamp = $tanggal." ".$hour.":".$minute.":".$second;
    session_start();
    if(!$_SESSION['username']){
        $link = "./login.php?lapang=".$lapang."&jam=".$jam."&tanggal=".$tanggal;
        header('Location:'.$link);
    }
    include('components/head.php');
    include('components/nav.php');
?>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Konfirmasi Pesanan</h5>
            <p class="card-text">Anda memesan Lapangan <?= $lapang ?> dari jam <?= $jam+8 ?>.00 WIB sampai jam <?= $jam+9 ?>.00 WIB pada tanggal <?= $tanggal ?></p>
            <a id="bookingBtn" class="btn btn-primary">Iya Booking</a>
            <div class="message"></div>
        </div>
    </div>
</div>

<script>
    const btnBooking = document.querySelector("#bookingBtn");
    const msgText = document.querySelector(".message");
    btnBooking.addEventListener("click",()=>{
        <?php

            $id = $_SESSION['id'];
            $query = "SELECT * FROM pemesanan WHERE tanggal = '$tanggal' AND id_lapangan = '$lapang' AND waktu = '$jam'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0){
                $status = false;
            }else{
                $status = true;
            }
        ?>
        <?php if($status) :?>
            <?php
                $insert = "INSERT INTO `pemesanan` (`id_lapangan`, `id_user`, `tanggal`, `waktu`, `status`, `expired`) VALUES ('$lapang', '$id', '$tanggal', '$jam', 'MENUNGGU PEMBAYARAN', '$timestamp')";
                $exec = mysqli_query($conn, $insert);
            ?>
            msgText.innerHTML = `
                Pesanan anda berhasil terkonfirmasi!!
                <?= $timestamp ?>
                <a href="./pesanan.php" class="btn btn-primary">Cek Status Pesanan</a>
            `
        <?php else : ?>
            msgText.innerHTML = `
            <div class="p-2">
                silakan ganti pesanan
                <a href="./cek-lapang.php" class="btn btn-primary">Ganti Pesanan</a>
            </div>
            `
        <?php endif ?>
    })
</script>