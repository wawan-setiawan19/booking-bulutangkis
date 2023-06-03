<?php
    require('config.php');
    $lapang = $_GET['lapang'];
    $jam = $_GET['jam'];
    $tanggal = $_GET['tanggal'];
    $hour = date('G');
    $minute = date('i');
    $second = date('s');
    $timestamp = $tanggal." ".$hour.":".$minute.":".$second;
    session_start();
    $id = $_SESSION['id'];

    $query = "SELECT * FROM pemesanan WHERE tanggal = '$tanggal' AND id_lapangan = '$lapang' AND waktu = '$jam'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        $status = false;
    }else{
        $status = true;
    }
    if($status) {
        $insert = "INSERT INTO `pemesanan` (`id_lapangan`, `id_user`, `tanggal`, `waktu`, `status`, `expired`) VALUES ('$lapang', '$id', '$tanggal', '$jam', 'MENUNGGU PEMBAYARAN', '$timestamp')";
        $exec = mysqli_query($conn, $insert);
        return true;
    }else{
        return false;
    }