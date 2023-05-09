<?php 

require_once("config.php");
  $lapang = isset($_GET['lapang'])?$_GET['lapang']:'';
  $jam = isset($_GET['jam'])?$_GET['jam']:'';
  $tanggal = isset($_GET['tanggal'])?$_GET['tanggal']:'';
//memeriksa apakah form login telah di-submit
if(isset($_POST['login'])) {

    //menangkap nilai username dan password yang dimasukkan oleh pengguna
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
  
    //memperoleh nilai terenkripsi dari username yang ada di dalam database
    $query = "SELECT password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)==1) {
      $row = mysqli_fetch_assoc($result);
      $hashed_password = $row['password'];
    
      //memeriksa apakah nilai terenkripsi dari input pengguna sama dengan nilai terenkripsi yang tersimpan dalam database
      if(password_verify($password, $hashed_password)) {
    
        //menangkap nilai role dari pengguna yang berhasil login
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $row['id'];
    }

  
      //memeriksa role pengguna dan mengarahkan ke halaman dashboard yang sesuai
      if($role == 'admin') {
        header("Location: admin/index.php");
      } else {
        if($lapang){
          $link = "./booking.php?lapang=".$lapang."&jam=".$jam."&tanggal=".$tanggal;
          header('Location:'.$link);
        }else{
          header("Location: dashboard.php");
        }
      }
  
    } else {
      //jika username dan password tidak sesuai dengan informasi yang tersimpan dalam tabel users
      echo "Username atau password salah!";
    }
  
  }

?>

<?php require_once("./components/head.php");?>
<?php require_once("./components/nav.php");?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
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