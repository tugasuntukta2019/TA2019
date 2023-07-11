<?php 
// untuk memulai sesi PHP, dapat menyimpan dan mengakses data pengguna yang login di berbagai halaman.
session_start();
$koneksi = new mysqli("localhost","root","","bengkel-virly-motor");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <style>
     .main{
      height: 100hv;
      margin-top: 100px;
     }
     .login{
      width: 500px;
      height: 200px;
      border: solid 1px;
     }
  </style>


  <body>
    <script>
    swal("Good job!", "You clicked the button!", "success");
    </script>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Bengkel Virly</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
              </li>
            </ul>
            
            <form action="cari.php" method="get" class="navbar-form navbar-right d-flex navbar-nav ">
              <button type="button" class="btn btn-outline-primary "><a class="nav-link px-2" aria-current="page" href="login.php">Login</a></button>
              <button type="button" class="btn btn-outline-primary"><a class="nav-link px-2" aria-current="page" href="register.php">Daftar</a></button>
            </form>
          </div>
        </div>
    </nav>
    <div class="main d-flex justify-content-center align-items-center">
      <div class="login-box">
        <form method="post">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" placeholder="Masukkan Username" name="username">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control"  placeholder="Masukkan Password" name="password">
          </div>
          <p>Belum Punya Akun? Daftar <a href="register.php">Disini</a></p>
          <button type="submit" class="btn btn-primary" name="button">Login</button><br><br> 
        </form>
        <?php   
        //Mengecek apakah tombol login ketika di klik sudah susuai dengan nama button tersebut adalah name="button".
        if (isset($_POST['button']) ) {
          //Membuat query SQL untuk memeriksa dan mencocokkan username dan password yang dimasukkan sesuai dengan pengguna di database pengguna.
          $sql = "SELECT * FROM user WHERE username='$_POST[username]' AND password = '$_POST[password]'";
          $hasil = mysqli_query ($koneksi,$sql);
          //Menjalankan query dan menghitung jumlah baris (jumlah hasil).
          $jumlah = mysqli_num_rows($hasil);

          //Jika jumlah hasil lebih dari 0, berarti login berhasil. Data pengguna yang ditemukan di database disimpan dalam variabel $_SESSION untuk digunakan di halaman lain.
          if ($jumlah>0) {
            $row = mysqli_fetch_assoc($hasil);
            $_SESSION["id"]=$row["id"];
            $_SESSION["username"]=$row["username"];
            $_SESSION["alamat"]=$row["alamat"];
            $_SESSION["email"]=$row["email"];
            $_SESSION["tipe"]=$row["tipe"];
            
            $_SESSION['user']=$row;
            //Jika pengguna memiliki tipe tipe=1 (customer), pengguna akan diarahkan ke halaman index.php.
            if ($_SESSION["tipe"]=$row["tipe"]==1){
              echo "<script>alert('Login Sukses')</script>";
              header("Location:index.php");
            }
            //Jika pengguna memiliki tipe tipe=2 (admin), pengguna akan diarahkan ke halaman kelolaaplikasi.php dibagian kelola aplikasi admin.
            else if ($_SESSION["tipe"]=$row["tipe"]==2){
              echo "<script>alert('Login Sebagai Admin Sukses')</script>";
              header("Location:admin/kelolaaplikasi.php");
            }
            //Jika pengguna memiliki tipe tipe=3 (superadmin), pengguna akan diarahkan ke halaman kelolaaplikasi.php dibagian kelola aplikasi superadmin.
            else if ($_SESSION["tipe"]=$row["tipe"]==3){
              echo "<script>alert('Login Sebagai SuperAdmin Sukses')</script>";
              header("Location:superadmin/kelolaaplikasi.php");
            }
          }
          //Jika login gagal (tidak ada kecocokan username dan password), pesan kesalahan akan ditampilkan.
          else {
            echo "<div class='alert alert-danger'>
            <strong>Error!</strong> Username dan password salah. 
            </div>";
          }
        } 
        ?>
      </div>
    </div>
    <script src="bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
