<?php 
session_start();
include 'koneksi.php';
include 'component.php';
// Mendapatkan nilai parameter id dan id_user dari URL dan variabel session. Nilai tersebut digunakan untuk menentukan produk mana yang akan dihapus dari keranjang.
$mobil = $_GET["id"];
$user = $_SESSION["user"]['id'];
// Melakukan query untuk menghapus data produk dari tabel keranjang berdasarkan id_user dan id_mobil yang sesuai.
$koneksi->query("DELETE FROM keranjang WHERE id_user='$user' AND id_mobil='$mobil' ");
// Menampilkan pesan alert dengan menggunakan JavaScript bahwa produk berhasil dihapus.
echo "<script>alert('produk dihapus');</script>";
// Mengarahkan pengguna kembali ke halaman "keranjang.php"
echo "<script>location='keranjang.php'</script>";
 ?>
