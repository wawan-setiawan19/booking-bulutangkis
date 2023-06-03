<?php
require('../../config.php');
$id = $_GET['id'];

$query = "UPDATE pemesanan SET status='LUNAS' where id = '$id'";
$result = mysqli_query($conn, $query);
if($result){
    header("Location: view.php");
}else{
    echo "ERROR";
}
?>