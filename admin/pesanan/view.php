<?php
require('../../config.php');
session_start();

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM pemesanan JOIN users ON pemesanan.id_user = users.id where tanggal = current_date()";
$result = $conn->query($sql);
$sql_semua = "SELECT * FROM pemesanan JOIN users ON pemesanan.id_user = users.id";
$result_semua = $conn->query($sql_semua);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Bulutangkis - Pengguna</title>
    <?php require('../../components/head.php') ?>
    <?php require('../../components/nav-admin.php') ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#todayTabel').DataTable();
            $('#semuaTabel').DataTable();
        });
    </script>
</head>
<body>
    <div class="container">
        <h2>Data Booking Hari Ini</h2>
        <table id="todayTabel" class="table table-resposive table-striped">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Lapangan</th>
                    <th>Jam Main</th>
                    <th>Tanggal Main</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result as $row) :?>
                    <tr>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['id_lapangan'] ?></td>
                        <td><?= $row['waktu']+8 ?>:00 - <?= $row['waktu']+9?>:00</td>
                        <td><?= $row['tanggal'] ?></td>
                        <td><?= $row['status'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <h2>Data Booking</h2>
        <table id="semuaTabel" class="table table-resposive table-striped">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Lapangan</th>
                    <th>Jam Main</th>
                    <th>Tanggal Main</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result_semua as $row) :?>
                    <tr>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['id_lapangan'] ?></td>
                        <td><?= $row['waktu']+8 ?>:00 - <?= $row['waktu']+9?>:00</td>
                        <td><?= $row['tanggal'] ?></td>
                        <td>
                            <div class="">
                                <a href="./edit.php?id=<?=$row['id']?>" class="btn btn-primary ms-3">Edit</a>
                                <a href="./hapus.php?id=<?=$row['id']?>" class="btn btn-danger ms-3">Hapus</a>
                            </div>
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
