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
        var xmlHttpReq = new XMLHttpRequest();
        xmlHttpReq.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                Swal.fire({
                    icon: "success",
                    title: "Berhasil Pesan",
                    text: "Pesanan anda berhasil terkonfirmasi!",
                }).then(function(){
                    window.location.href = './pesanan.php'
                })
            }else{
                Swal.fire({
                    icon: "error",
                    title: "Gagal Pesan",
                    text: "Silakan Ganti Pesanan",
                })
            }
        }

        xmlHttpReq.open("GET", `proses-booking.php?lapang=<?=$lapang?>&jam=<?=$jam?>&tanggal=<?=$tanggal?>`)
        xmlHttpReq.send()
    })
</script>