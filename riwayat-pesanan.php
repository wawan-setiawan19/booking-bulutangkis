<?php

require_once('config.php');
// query untuk menampilkan lapangan
session_start();
$id = $_SESSION['id'];

$query = "SELECT * FROM pemesanan WHERE id_user = '$id' AND NOT status='MENUNGGU PEMBAYARAN'";
$result = mysqli_query($conn, $query);

require_once('components/head.php');
require_once('components/nav.php');
?>

<div class="container">
    <?php if(mysqli_num_rows($result)==0) : ?>
        <h1>Tidak ada riwayat</h1>
    <?php endif?>
    <?php while($row = mysqli_fetch_assoc($result)) :?>
        <?php
            if($row['status'] == "MENUNGGU PEMBAYARAN"){
                $status = 'bg-primary';
            }else if($row['status'] == "LUNAS"){
                $status = 'bg-success';
            }else if($row['status'] == "MENUNGGU VALIDASI"){
                $status = 'bg-warning';
            }else{
                $status = 'bg-danger';
            }
        ?>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-9">
                        <h5 class="card-title">Pesanan</h5>
                    </div>
                    <div class="col-sm-3">
                        <span class="badge <?=$status?>"><?= $row['status'] ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    <table class="table table-responsive">
                    <tr>
                        <td>Nama Lapangan</td>
                        <td>:</td>
                        <td><?= $row['id_lapangan'] ?></td>
                    </tr>
                    <tr>
                        <td>Jam Mulai</td>
                        <td>:</td>
                        <td><?= $row['waktu']+8 ?>:00  WIB</td>
                    </tr>
                    <tr>
                        <td>Jam Selesai</td>
                        <td>:</td>
                        <td><?= $row['waktu']+9 ?>:00 WIB</td>
                    </tr>
                    <tr>
                        <td>Tanggal Main</td>
                        <td>:</td>
                        <td><?= $row['tanggal'] ?></td>
                    </tr>
                    <?php if($row['status']=="MENUNGGU PEMBAYARAN") : ?>
                        <tr>
                            <td>Batas Akhir Pembayaran</td>
                            <td>:</td>
                            <td><?= $row['expired'] ?></td>
                        </tr>
                    <?php endif ?>
                </table>
                    </div>
                </div>
                    <a id="hapusBtn" onclick="hapusRiwayat(<?= $row['id']?>)" class="btn btn-danger">Hapus Riwayat Pesanan</a>
                <div class="message"></div>
            </div>
        </div>
    <?php endwhile ?>
</div>

<script>
    const gantiBtn = document.querySelector("#gantiBtn")

    const hapusRiwayat = (id) =>{
        var xmlHttpReq = new XMLHttpRequest();
        xmlHttpReq.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
              window.location.href = './riwayat-pesanan.php'
            }
        }

        xmlHttpReq.open("GET", `hapus-riwayat.php?id=${id}`)
        xmlHttpReq.send()
    }
  </script>
