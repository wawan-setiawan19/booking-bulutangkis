<?php

require_once('config.php');
// query untuk menampilkan lapangan
session_start();
$id = $_SESSION['id'];

require_once('components/head.php');
require_once('components/nav.php');
?>

<div class="container">
    <div class="card">
    <div class="card-header bg-warning">
        PENTING !!!
    </div>
    <div class="card-body">
        <h5 class="card-title">Cara Pembayaran</h5>
        <ol type="1">
            <li>Pastikan ID pembayaran sudah sesuai</li>
            <li>Lakukan pembayaran ke rekening 444444 a.n John Doe (Bank Cyber)</li>
            <li>Screenshoot atau Foto Bukti Pembayaran</li>
            <li>Kirim Bukti Pembayaran pada form di bawah ini</li>
        </ol>
    </div>
    </div>
    <form action="action-bayar-pesanan.php" method="POST" enctype="multipart/form-data">
        <div class="form-group mt-2">
            <label for="id_pemesanan">ID Pemesanan</label>
            <input class="form-control mt-2" type="text" name="id_pemesanan" placeholder="Nama kamu" value="<?= $_GET['idp'] ?>" readonly/>
        </div>
        <div class="form-group mt-2">
            <label for="keperluan">Keperluan</label>
            <select class="form-select" name="keperluan" id="keperluan">
                <option value="DP">Down Payment</option>
                <option value="LUNAS">Bayar Lunas</option>
            </select>
        </div>
        <div class="form-group mt-2">
            <label for="fileToUpload">Screenshoot/Foto Bukti Pembayaran</label>
            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
        </div>
        <div>
            <input type="submit" class="btn btn-success btn-block mt-3" name="register" value="Bayar Pesanan" />
            <a href="./pesanan.php" class="btn btn-danger btn-block mt-3">Batal</a>
        </div>
    </form>
</div>