<?php

require_once("config.php");
require_once("./components/head.php");
require_once("./components/nav.php");

if(isset($_POST['register'])) {

    //menangkap nilai username, password, dan role yang dimasukkan oleh pengguna
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
  
    //membuat hash password menggunakan fungsi password_hash()
    $hash = password_hash($password, PASSWORD_DEFAULT);
  
    //memeriksa apakah username telah digunakan oleh pengguna lain
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
  
    //jika username telah digunakan oleh pengguna lain
    if(mysqli_num_rows($result) > 0) {
      echo '<script>
          Swal.fire({
            icon: "error",
            title: "Username Sudah Ada",
            text: "Username telah digunakan oleh pengguna lain!",
          });
        </script>';
    } else {
  
      //menambahkan pengguna baru ke dalam tabel users
      $query = "INSERT INTO users (username, email, password, name) VALUES ('$username', '$email', '$hash', '$name')";
      $result = mysqli_query($conn, $query);
  
      //memeriksa apakah pengguna baru telah berhasil ditambahkan ke dalam tabel users
      if($result) {
        echo '<script>
          Swal.fire({
            icon: "success",
            title: "Registrasi Berhasil",
            text: "Registrasi anda sudah benar, silakan lanjutkan untuk login!",
          }).then(function() {
            window.location.href = "login.php";
          });
        </script>';
      } else {
        echo '<script>
          Swal.fire({
            icon: "error",
            title: "Registrasi Gagal",
            text: "Mohon maaf sepertinya anda belum bisa bergabung, silakan periksa apakah form sudah diisi dengan benar!",
          });
        </script>';
      }
  
    }
  
  }

?>
<body class="bg-light">
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <h4>Bergabunglah bersama ribuan orang lainnya...</h4>
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>

        <form action="" method="POST">

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input class="form-control mt-2" type="text" name="name" placeholder="Nama kamu" />
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control mt-2" type="text" name="username" placeholder="Username" />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control mt-2" type="email" name="email" placeholder="Alamat Email" />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control mt-2" type="password" name="password" placeholder="Password" />
            </div>

            <input type="submit" class="btn btn-success btn-block mt-3" name="register" value="Daftar" />

        </form>
            
        </div>
    </div>
</div>