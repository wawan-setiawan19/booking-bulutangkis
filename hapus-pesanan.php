<?php
require('config.php');
$id = $_GET['id'];

$query = "UPDATE pemesanan SET status = 'PESANAN DIBATALKAN' WHERE id = '$id'";
$result = mysqli_query($conn, $query);
if($result){
    return true;
}
?>