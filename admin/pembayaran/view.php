<?php
require('../../config.php');
session_start();

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM bukti_pembayaran join pemesanan on bukti_pembayaran.id_pemesanan = pemesanan.id join users on pemesanan.id_user = users.id where tanggal >= current_date() AND NOT status = 'DONE'";
$result = $conn->query($sql);
$sql_semua = "SELECT * FROM bukti_pembayaran join pemesanan on bukti_pembayaran.id_pemesanan = pemesanan.id join users on pemesanan.id_user = users.id";
$result_semua = $conn->query($sql_semua);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Bulutangkis - Pembayaran</title>
    <?php require('../../components/head.php') ?>
    <?php require('../../components/nav-admin.php') ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cekBayar').DataTable();
            $('#semuaBayar').DataTable();
        });
    </script>
</head>
<body>
    <div class="container">
        <h2>Cek Pembayaran</h2>
        <table id="cekBayar" class="table table-resposive table-striped">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Lapangan</th>
                    <th>Tanggal Main</th>
                    <th>Jam Main</th>
                    <th>Bukti Pembayaran</th>
                    <th>Validasi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result as $row) :?>
                    <tr>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['id_lapangan'] ?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td><?= $row['waktu']+8 ?></td>
                        <td>
                            <a href="<?=$server_root?>/uploads/<?= $row['screenshot'] ?>" target="_blank">
                                <img height="200" src="<?=$server_root?>/uploads/<?= $row['screenshot'] ?>" alt="<?= $row['screenshot'] ?>" srcset="">
                            </a>
                        </td>
                        <td>
                            <div class="">
                                <?php if($row['status']=='LUNAS') : ?>
                                    <a target="_blank" href="./print.php?id=<?=$row['id_pemesanan']?>" class="btn btn-success ms-3">CETAK KWITANSI</a>
                                <?php else : ?>
                                    <a href="./validasi.php?id=<?=$row['id_pemesanan']?>" class="btn btn-primary ms-3">VALIDASI</a>
                                <?php endif ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <h2>Semua Pembayaran</h2>
        <table id="semuaBayar" class="table table-resposive table-striped">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Lapangan</th>
                    <th>Tanggal Main</th>
                    <th>Jam Main</th>
                    <th>Bukti Pembayaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result_semua as $row) :?>
                    <tr>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['id_lapangan'] ?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td><?= $row['waktu']+8 ?></td>
                        <td>
                            <a href="<?=$server_root?>/uploads/<?= $row['screenshot'] ?>" target="_blank">
                                <img height="200" src="<?=$server_root?>/uploads/<?= $row['screenshot'] ?>" alt="<?= $row['screenshot'] ?>" srcset="">
                            </a>
                        </td>
                        <td>
                            <?php if($row['status']=='LUNAS') : ?>
                                <a target="_blank" href="./print.php?id=<?=$row['id_pemesanan']?>" class="btn btn-success ms-3">CETAK KWITANSI</a>
                            <?php else : ?>
                                <?=$row['status']?>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Menutup koneksi ke database
$conn->close();
?>
