<?php 
require_once('config.php');

    $sql_lapangan = "SELECT * FROM lapangan";
    $result_lapangan = mysqli_query($conn, $sql_lapangan);

    $lapangan = array();
    if($result_lapangan){
        foreach ($result_lapangan as $lapang) {
            $lapangan[] = $lapang;
        }
    }
    echo json_encode($lapangan);
    return json_encode($lapangan);