<?php
require('../../config.php');
session_start();

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM users where NOT role='admin'";
$result = $conn->query($sql);

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
            $('#fileTable').DataTable();
        });
    </script>
</head>
<body>
    <div class="container">
        <h2>Data Pengguna</h2>
        <table id="fileTable" class="table table-resposive table-striped">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result as $row) :?>
                    <tr>
                        <td><?= $row['username'] ?></td>
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
