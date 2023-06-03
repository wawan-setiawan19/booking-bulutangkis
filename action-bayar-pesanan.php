<?php

require('config.php');

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

function createDirectory($dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pemesanan = $_POST['id_pemesanan'];
    $keperluan = $_POST['keperluan'];
    $targetDir = "uploads/"; // Folder tempat menyimpan file yang diunggah
    createDirectory($targetDir);
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Cek apakah file merupakan gambar
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File adalah gambar - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }
    }

    // Cek apakah file sudah ada di server
    if (file_exists($targetFile)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    // Batasan ukuran file
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Maaf, ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Batasan format file
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Cek jika $uploadOk bernilai 0
    if ($uploadOk == 0) {
        echo "Maaf, file tidak dapat diunggah.";
    // Jika semuanya baik-baik saja, coba unggah file dan simpan informasi ke database
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            $fileName = basename($_FILES["fileToUpload"]["name"]);

            // Menyimpan informasi file ke database
            $sql = "INSERT INTO bukti_pembayaran (screenshot, id_pemesanan, keperluan) VALUES ('$fileName', '$id_pemesanan', '$keperluan')";
            if ($conn->query($sql) === TRUE) {
                echo "File ". $fileName. " berhasil diunggah dan informasi tersimpan di database.";
                $sql = "UPDATE pemesanan SET status = 'MENUNGGU VALIDASI' WHERE id='$id_pemesanan'";
                $conn->query($sql);
                header("Location: riwayat-pesanan.php");
            } else {
                echo "Maaf, terjadi kesalahan saat menyimpan informasi ke database.";
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    }
}

// Menutup koneksi ke database
$conn->close();