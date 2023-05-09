<?php
require('config.php');
$id = $_GET['id'];

$query = "DELETE from pemesanan WHERE id = '$id'";
$result = mysqli_query($conn, $query);
if($result){
    return true;
}
?>