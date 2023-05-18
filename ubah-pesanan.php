<?php
require('config.php');
$id = $_POST['id_pemesanan'];
$tanggal = $_POST['tanggal'];
$lapangan = $_POST['lapangan'];
$jam = $_POST['jam'];

$query = "UPDATE pemesanan SET tanggal='$tanggal', id_lapangan='$lapangan', waktu='$jam' WHERE id = '$id'";
$result = mysqli_query($conn, $query);
if($result){
    header("Location: pesanan.php");
}else{
    echo "ERROR";
}
?>