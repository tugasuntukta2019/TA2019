<?php 
// digunakan untuk memulai sesi pengguna. sesi pengguna harus dimulai agar sesi yang aktif dapat keluar.
session_start();

// digunakan untuk keluar semua data yang terkait dengan sesi pengguna yang sedang aktif. fungsi ini digunakan untuk menghapus semua data sesi pengguna yang telah disimpan.
session_destroy();
echo "<script>alert('anda telah logout')</script>";
echo "<script>location='index.php'</script>";
 ?>