<?php 

require_once("config.php");

//memeriksa apakah form login telah di-submit
if(isset($_POST['login'])) {

    //menangkap nilai username dan password yang dimasukkan oleh pengguna
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
  
    //memperoleh nilai terenkripsi dari username yang ada di dalam database
    $query = "SELECT password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row['password'];
  
    //memeriksa apakah nilai terenkripsi dari input pengguna sama dengan nilai terenkripsi yang tersimpan dalam database
    if(password_verify($password, $hashed_password)) {
  
      //menangkap nilai role dari pengguna yang berhasil login
      $query = "SELECT role FROM users WHERE username = '$username'";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      $role = $row['role'];

      session_start();
      $_SESSION['username'] = $username;
  
      //memeriksa role pengguna dan mengarahkan ke halaman dashboard yang sesuai
      if($role == 'admin') {
        header("Location: admin/index.php");
      } else {
        header("Location: dashboard.php");
      }
  
    } else {
      //jika username dan password tidak sesuai dengan informasi yang tersimpan dalam tabel users
      echo "Username atau password salah!";
    }
  
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body class="bg-light">
<?php require_once("./components/nav.php");?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <h4>Masuk untuk Booking</h4>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>

        <form action="" method="POST">

            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" placeholder="Username atau email" />
            </div>


            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" placeholder="Password" />
            </div>

            <input type="submit" class="btn btn-success btn-block mt-3" name="login" value="Masuk" />

        </form>
            
        </div>

    </div>
</div>
    
</body>
</html>