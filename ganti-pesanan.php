<?php

require_once('config.php');
// query untuk menampilkan lapangan
session_start();
$id = $_SESSION['id'];

require_once('components/head.php');
require_once('components/nav.php');
$tanggal = $_GET['tgl'];
?>

<div class="container">
    <form action="ubah-pesanan.php" method="POST">
        <div class="form-group mt-2">
            <label for="id_pemesanan">ID Pemesanan</label>
            <input class="form-control mt-2" type="text" name="id_pemesanan" placeholder="Nama kamu" value="<?= $_GET['idp'] ?>" readonly/>
        </div>
        <div class="form-group mt-2">
            <label for="tanggal">Tanggal Main</label>
            <input class="form-control mt-2" type="date" onchange="gantiTanggal()" name="tanggal" placeholder="Username" value="<?= $_GET['tgl'] ?>"/>
        </div>
        <div class="form-group mt-2">
            <label for="lapangan">Lapangan</label>
            <select class="form-select" name="lapangan" id="lapangan"></select>
        </div>
        <div class="form-group mt-2">
            <label for="jam">Jam Main</label>
            <select class="form-select" name="jam" id="jam"></select>
        </div>
        <div>
            <input type="submit" class="btn btn-success btn-block mt-3" name="register" value="Ubah Data" />
            <a href="./pesanan.php" class="btn btn-danger btn-block mt-3">Batal</a>
        </div>
    </form>
</div>

<script>
    const jamSelector = document.querySelector("#jam");
    const lapanganSelector = document.querySelector("#lapangan");
    let tanggal = `<?= $_GET['tgl'] ?>`;
    let lapangan = <?= $_GET['lapangan'] ?>;

    const gantiTanggal = () =>{
        tanggal = event.target.value
        getJam()
    }

    lapanganSelector.addEventListener('change',()=>{
        lapangan = event.target.value
        getJam()
    })

    const getLapangan = () =>{
        lapanganSelector.innerHTML = ''
        fetch('./api-get-lapang.php')
        .then(response => response.json())
        .then(lapang=>{
            lapang.forEach(element => {
                lapanganSelector.innerHTML += `
                    <option ${lapangan == element.id?'selected':''} value="${element.id}">${element.nama_lapangan}</option>
                `
            });
        })
    }

    const getJam = () =>{
        jamSelector.innerHTML = ''
        fetch(`./api-get-pesanan.php?lapangan=${lapangan}&tgl='${tanggal}'`)
        .then(response => response.json())
        .then(item=>{
            if(item==[]){
                for (let index = 1; index < 16; index++) {
                    jamSelector.innerHTML += `
                    <option value="${index}">${index+8}.00-${index+9}.00</option>
                    `
                }
            }else{
                for (let index = 1; index < 16; index++) {
                    let status = '';
                    item.forEach(element => {
                        element.waktu == index ? status='disabled':''
                    })
                    jamSelector.innerHTML += `
                        <option value="${index}" ${status}>${index+8}.00-${index+9}.00</option>
                    `
                }
            }
        })
    }

    getJam()
    getLapangan()
</script>