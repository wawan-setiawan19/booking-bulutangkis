<?php

require_once('config.php');
// query untuk menampilkan lapangan

$tanggal = $_GET['tanggal'];

$sql_lapangan = "SELECT * FROM lapangan";
$result_lapangan = mysqli_query($conn, $sql_lapangan);

$query = "SELECT * FROM pemesanan WHERE tanggal = '$tanggal'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row["id_lapangan"]][$row["waktu"]] = true;
    }
}else{
    $data = [];
}
?>
<table class="table table-bordered mt-3">
      <thead>
        <tr>
          <th rowspan="2">Jam</th>
          <th colspan="2">Nama Lapangan</th>
        </tr>
        <tr>
            <?php
                foreach($result_lapangan as $lapang){
                    echo "<th>".$lapang['nama_lapangan']."</th>";
                }
            ?>
        </tr>
      </thead>
      <tbody>
        <?php
            for ($i=1; $i < 16; $i++) : ?>
        <?php
                $jam_mulai = "". ($i+8) . ":00";
                $jam_selesai = "". ($i+9) .":00";
        ?>
        <tr>
            <td><?=$jam_mulai?> - <?=$jam_selesai?></td>
            <?php foreach ($result_lapangan as $lapangan) : ?>
                <?php if (isset($data[$lapangan['id']][$i])) {
                    $status = 'bg-danger';
                }else{
                    $status = 'bg-success';
                }
                ?>
                <td class=<?= $status ?> ></td>
            <?php endforeach ?>
        </tr>
        <?php endfor ?>
      </tbody>
    </table>
    <div class="mt-3 col-md-3">
        <h1>Keterangan</h1>
        <div class="bg-success text-white mt-2 p-2">Kosong</div>
        <div class="bg-danger text-white mt-2 p-2">Booking</div>
    </div>
