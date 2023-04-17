<?php
session_start();
if(isset($_SESSION['username'])) {

//menampilkan nilai username

} else {

//jika variabel sesi username belum di-set, mengarahkan pengguna ke halaman login
header("Location: login.php");
exit;

}?>

<h1>SELAMAT DATANG, <?= $_SESSION['username'] ?> </h1>

<a href="./logout.php">Logout</a>