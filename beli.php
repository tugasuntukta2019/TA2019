<?php
// digunakan untuk mengimpor file koneksi.php dan component.php, yang berfungsi untuk menghubungkan halaman dengan database dan mungkin juga memuat komponen atau fungsi yang digunakan dalam halaman ini. Selain itu, fungsi session_start() digunakan untuk memulai sesi pengguna.
include 'koneksi.php';
include 'component.php';
session_start();
// mengambil nilai dari parameter $_SESSION["user"]['id'] dan $_GET['id']. Nilai ini digunakan untuk mengidentifikasi pengguna dan data mobil didatabase yang akan ditambahkan ke keranjang.
$user=$_SESSION["user"]['id'];
$mobil = $_GET ['id'];
// melakukan query ke database untuk memeriksa apakah sudah ada mobil yang sama dalam keranjang pengguna. Query ini menggunakan kondisi id_user='$user' dan id_mobil='$mobil'. Jika ada, maka dilakukan pengambilan data jumlah produk dalam keranjang.
$ambil=$koneksi->query("SELECT * FROM keranjang WHERE id_user='$user' AND id_mobil='$mobil'");
while($keranjang=$ambil->fetch_assoc()){
    echo "<pre>";
	echo "</pre>";
    //Jumlah produk ditambahkan dengan 1.
    $tambah= $keranjang["jumlah"]+1;
}
// melakukan pengecekan apakah mobil yang akan ditambahkan sudah ada dalam keranjang pengguna atau belum. Hal ini dilakukan dengan menggunakan fungsi mysqli_num_rows() yang menghitung jumlah baris hasil query. 
$cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM keranjang WHERE id_user='$user' AND id_mobil='$mobil'"));
// Jika data mobil sudah ada dalam keranjang, maka dilakukan update pada jumlah produk dengan menggunakan query UPDATE. 
if ($cek > 0){
    $koneksi->query("UPDATE keranjang SET jumlah='$tambah'  WHERE id_user='$user' ANd id_mobil='$mobil' ");
    echo "<script>alert('Data di masukkan ke keranjang');</script>";
    echo "<script>window.location=history.go(-1);</script>";
// Jika data mobil belum ada dalam keranjang, maka dilakukan penambahan data baru ke tabel keranjang dengan menggunakan query INSERT INTO.
}else{
    $mysqli  = "INSERT INTO keranjang (id_user,id_mobil,jumlah) VALUES ('$user','$mobil','1')";
    $result  = mysqli_query($koneksi, $mysqli);
    
    // Setelah proses penambahan ke keranjang selesai, ditampilkan pesan menggunakan echo "<script>alert('Data di masukkan ke keranjang');</script>". 
    // Kemudian, pengguna akan diarahkan kembali ke halaman sebelumnya menggunakan echo "<script>window.location=history.go(-1);</script>". 
    // digunakan untuk memberikan umpan balik kepada pengguna bahwa proses penambahan ke keranjang berhasil dilakukan.
    if ($result) {
        echo "<script>alert('Data di masukkan ke keranjang')</script>";
        echo "<script>window.location=history.go(-1);</script>";
    }
}
?>