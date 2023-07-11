<?php
session_start();
$koneksi = new mysqli("localhost","root","","bengkel-virly-motor")
 ?>
<!DOCTYPE html>
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
    <div class="container">
        <div class="row">
            <div class="col"><br>
                <form method="post">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Username</label>
                      <input type="text" class="form-control" placeholder="Masukkan Username" name="username">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Email</label>
                      <input type="email" class="form-control" placeholder="Masukkan Email" name="email">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" class="form-control" placeholder="Minimal 8 Karakter" name="onepass">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Konfirmasi Password</label>
                      <input type="password" class="form-control" placeholder="Minimal 8 Karakter" name="secpass">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">No Telepon</label>
                      <input type="number" class="form-control" placeholder="Masukkan Nomor Telepon" name="tlp">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Alamat</label>
                      <textarea class="form-control" type="text" name="alamat" placeholder="Masukkan Alamat Lengkap"></textarea>
                    </div>
                    <p>Sudah Punya Akun? Silakan <a href="login.php">Login</a></p>
                    <button type="submit" class="btn btn-primary" name="register">Submit</button><br><br>
                  </form>
                  <?php
                        //Mengecek apakah tombol register ketika di klik sudah susuai dengan nama button tersebut adalah name="register".
                        if (isset($_POST['register'])) 
                        {
                          //Mengambil data yang dikirimkan oleh formulir pendaftaran menggunakan metode POST.
                            $username  = $_POST['username'];
                            $email  = $_POST['email'];
                            $onepass = $_POST['onepass'];
                            $secpass = $_POST['secpass'];
                            $panjang    =strlen($_POST['onepass']);
                            $tlp = $_POST['tlp'];
                            $alamat = $_POST['alamat'];
                          
                          //Memeriksa apakah alamat email yang diinputkan sudah digunakan sebelumnya.
                            $cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM user WHERE email='$email'"));
                          //Jika email sudah digunakan, maka akan ditampilkan pesan kesalahan.
                            if ($cek > 0){
                                echo "<div class='alert alert-danger'>Email Telah Digunakan</div>";
                                echo "<meta http-equiv='refresh' content='1;url=register.php'>";
                            }else{
                              //Memeriksa apakah password yang diinputkan dua kali (onepass dan secpass) sesuai.
                                if($onepass!=$secpass){
                                echo "<div class='alert alert-danger'>Kombinasi Password Berbeda</div>";
                                echo "<meta http-equiv='refresh' content='1;url=register.php'>";
                                }
                                //Jika password tidak sesuai, maka akan ditampilkan pesan kesalahan.
                                else{
                                    if($panjang<8){
                                      //Jika password memiliki panjang kurang dari 8 karakter, maka akan ditampilkan pesan kesalahan.
                                        echo "<div class='alert alert-danger'>Password Kurang Dari 8 Karakter</div>";
                                        echo "<meta http-equiv='refresh' content='1;url=register.php'>";
                                    //Jika semua validasi berhasil, data pengguna baru akan disimpan dalam database dan pesan sukses ditampilkan.
                                    }else{
                                        $mysqli  = "INSERT INTO user (username,email,password,tipe,alamat,telepon) VALUES ('$username','$email','$onepass','1','$alamat','$tlp')";
                                        $result  = mysqli_query($koneksi, $mysqli);
                                        if ($result) {
                                            echo "<script>alert('Pembuatan Akun Berhasil')</script>";
                                            echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                                        }
                                        else {
                                            echo "<script>alert('Registrasi Gagal Di Tambah Ke Database Anda !');</script>";
                                                 }
                                         mysqli_close($koneksi);
                                    }
                                }
                            }
                      
                        }
                        ?>
            </div>
            <div class="col"><br>
                <center><h1>Daftar Akun</h1></center>
                <h>Agar anda dapat menggunakan fasilitas Bengkel Virly anda harus daftar terlebih dahulu untuk mendapatkan akun. Isi form pendaftaran dengan lengkap dan tepat untuk tujuan  mempermudah saat anda melakukan pembelian.</p>
                <img src="asets/tpbgregist.png" width="500" height="400">
            </div>
        </div>
    </div>
</body>
</html>