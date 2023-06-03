<?php

require_once('config.php');
// query untuk menampilkan lapangan
session_start();
$id = $_SESSION['id'];

$query = "SELECT * FROM pemesanan WHERE id_user = '$id' AND status='MENUNGGU PEMBAYARAN'";
$result = mysqli_query($conn, $query);

require_once('components/head.php');
require_once('components/nav.php');
?>

<div class="container">
    <?php if(mysqli_num_rows($result) == 0) : ?> 
        <h1>Mohon maaf tidak ada pesanan</h1>
    <?php endif ?>
    <?php while($row = mysqli_fetch_assoc($result)) :?>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-9">
                        <h5 class="card-title">Pesanan</h5>
                    </div>
                    <div class="col-sm-3">
                        <span class="badge bg-primary"><?= $row['status'] ?></span>
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
                <?php if($row['status']=="MENUNGGU PEMBAYARAN") : ?>
                    <a id="bayarBtn" href="./bayar-pesanan.php?idp=<?=$row['id']?>" class="btn btn-success">Bayar Pesanan</a>
                    <a id="gantiBtn" href="./ganti-pesanan.php?idp=<?=$row['id']?>&tgl=<?= $row['tanggal']?>&lapangan=<?= $row['id_lapangan'] ?>" class="btn btn-primary">Ubah Pesanan</a>
                    <a id="hapusBtn" onclick="hapusPesanan(<?= $row['id']?>)" class="btn btn-danger">Hapus Pesanan</a>
                <?php endif ?>
                <div class="message"></div>
            </div>
        </div>
    <?php endwhile ?>
</div>

<script>
    const hapusPesanan = (id) =>{
        var xmlHttpReq = new XMLHttpRequest();
        xmlHttpReq.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
              window.location.href = './riwayat-pesanan.php'
            }
        }

        xmlHttpReq.open("GET", `hapus-pesanan.php?id=${id}`)
        xmlHttpReq.send()
    }
  </script>
