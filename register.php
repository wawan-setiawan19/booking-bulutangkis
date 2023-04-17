<?php

require_once("config.php");

if(isset($_POST['register'])) {

    //menangkap nilai username, password, dan role yang dimasukkan oleh pengguna
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $nama = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
  
    //membuat hash password menggunakan fungsi password_hash()
    $hash = password_hash($password, PASSWORD_DEFAULT);
  
    //memeriksa apakah username telah digunakan oleh pengguna lain
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
  
    //jika username telah digunakan oleh pengguna lain
    if(mysqli_num_rows($result) > 0) {
      echo "Username telah digunakan oleh pengguna lain!";
    } else {
  
      //menambahkan pengguna baru ke dalam tabel users
      $query = "INSERT INTO users (username, email, password, name) VALUES ('$username', '$email', '$hash', '$name')";
      $result = mysqli_query($conn, $query);
  
      //memeriksa apakah pengguna baru telah berhasil ditambahkan ke dalam tabel users
      if($result) {
        echo "Registrasi berhasil! Silahkan login.";
        header("Location: login.php");
      } else {
        echo "Registrasi gagal!";
      }
  
    }
  
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body class="bg-light">
<?php require_once("./components/nav.php");?>
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

</body>
</html>