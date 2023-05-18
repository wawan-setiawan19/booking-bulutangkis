<?php 
require_once('config.php');
    $lapangan = $_GET['lapangan'];
    $tanggal = $_GET['tgl'];
    $sql = "SELECT waktu FROM pemesanan WHERE id_lapangan=$lapangan AND tanggal=$tanggal";
    $result = mysqli_query($conn, $sql);

    $pesanan = array();
    if($result){
        foreach ($result as $pesan) {
            $pesanan[] = $pesan;
        }
    }
    echo json_encode($pesanan);
    return json_encode($pesanan);