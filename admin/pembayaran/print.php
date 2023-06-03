<?php
require('../../config.php');
$id = $_GET['id'];

$query = "SELECT * FROM pemesanan join users on pemesanan.id_user = users.id join bukti_pembayaran on pemesanan.id = bukti_pembayaran.id_pemesanan where pemesanan.id = '$id'";
$result = mysqli_query($conn, $query);
foreach ($result as $row) {
    # code...
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Bulutangkis - Pembayaran</title>
    <?php require('../../components/head.php') ?>
</head>
<body>
    <div class="container">
        <div class="px-4 py-5 my-5">
            <h1 class="display-5 fw-bold text-center">Bukti Pembayaran</h1>
            <div class="col-lg-6 mx-auto">
                <table class="table table-responsive">
                    <tr>
                        <td>Nama Pengguna</td>
                        <td>:</td>
                        <td><?= $row['username'] ?></td>
                    </tr>
                    <tr>
                        <td>Lapangan</td>
                        <td>:</td>
                        <td><?= $row['id_lapangan'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Main</td>
                        <td>:</td>
                        <td><?= $row['tanggal'] ?></td>
                    </tr>
                    <tr>
                        <td>Jam Main</td>
                        <td>:</td>
                        <td><?= $row['waktu'] + 8 ?>:00 - <?= $row['waktu'] + 9 ?></td>
                    </tr>
                </table>

                <div class="alert alert-success fw-bold text-center" role="alert">
                    STATUS PEMBAYARAN <?= $row['keperluan']?> TERKONFIRMASI
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = () =>{
            window.print()
        }
    </script>
</body>
</html>