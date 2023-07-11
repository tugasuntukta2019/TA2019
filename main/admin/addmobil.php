<?php
include '../koneksi.php';
include '../component.php';

// Get the maximum ID from the database and add 1 to it
// Mengambil ID maksimum dari tabel "mobil" di database dan menambahkannya dengan 1 untuk mendapatkan ID berikutnya yang akan digunakan untuk produk baru.
$query_max_id = "SELECT MAX(id) AS max_id FROM mobil";
$result_max_id = mysqli_query($koneksi, $query_max_id);
$row_max_id = mysqli_fetch_assoc($result_max_id);
$next_id = $row_max_id['max_id'] + 1;

// Menangani logika pemrosesan form. Jika tombol "Simpan" ditekan, data dari form akan diambil menggunakan metode $_POST. 
// Data tersebut akan dimasukkan ke dalam variabel yang sesuai. File foto juga akan diunggah ke direktori 
// "asets/mobil" menggunakan fungsi move_uploaded_file(). Setelah itu, dilakukan penambahan data mobil ke dalam 
// tabel "mobil" menggunakan pernyataan SQL INSERT INTO. Jika penambahan berhasil, maka akan ditampilkan pesan sukses dan 
// halaman akan di-refresh. Jika gagal, akan ditampilkan pesan error.
if (isset($_POST['save'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $merk = $_POST['merk'];
  $harga = $_POST['harga'];
  $cc = $_POST['cc'];
  $tipe_bbm = $_POST['tipe_bbm'];
  $tahun = $_POST['tahun'];
  $jarak_tempuh = $_POST['jarak_tempuh'];
  $kondisi = $_POST['kondisi'];
  $foto = $_FILES['foto']['name'];
  $lokasi = $_FILES['foto']['tmp_name'];
  $stok = $_POST['stok'];
  move_uploaded_file($lokasi, "../asets/mobil/".$foto);

  $query = "INSERT INTO mobil (id, nama, merk, harga, cc, tipe_bbm, tahun, jarak_tempuh, kondisi, foto, kategori, stok) VALUES ('$id', '$nama', '$merk', '$harga', '$cc', '$tipe_bbm', '$tahun', '$jarak_tempuh', '$kondisi', '$foto', '3', '$stok')";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    echo "<div class='alert alert-info'>Penambahan Produk Berhasil</div>";
    echo "<meta http-equiv='refresh' content='1;url=view.php?cari=3'>";
  } else {
    echo "<script>alert('Produk Gagal Ditambahkan ke Database Anda!');</script>";
  }

  mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
</head>
<body>
  <?php include 'headeradmin.php'; ?>
  <br><h2><center>Tambah Produk<center></h2><br><br>

  <div class="container">
    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Id</label>
        <input type="number" class="form-control" name="id" value="<?php echo $next_id; ?>" readonly>
      </div>
      <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama">
      </div>
      <div class="form-group">
        <label>Merk</label>
        <input type="text" class="form-control" name="merk">
      </div>
      <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" class="form-control" name="harga">
      </div>
      <div class="form-group">
        <label>CC</label>
        <input type="number" class="form-control" name="cc">
      </div>
      <div class="form-group">
        <label>Tipe BBM</label>
        <input type="text" class="form-control" name="tipe_bbm">
      </div>
	  <div class="form-group">
        <label>Tahun</label>
        <input type="number" class="form-control" name="tahun">
      </div>
      <div class="form-group">
        <label>Jarak Tempuh</label>
        <input type="number" class="form-control" name="jarak_tempuh">
      </div>
      <div class="form-group">
      <label>kondisi</label>
      <select class="form-control" name="kondisi">
        <option selected disabled>Kondisi</option>
        <option value="baru">Baru</option>
        <option value="bekas">Bekas</option>
      </select>
    </div>  
      <div class="form-group">
        <label>Stok</label>
        <input type="number" class="form-control" name="stok">
      </div>
      <br>
      <div class="form-group">
        <label>Foto</label>
        <input type="file" name="foto" class="form-control">
      </div><br>
      <button class="btn btn-primary" name="save">Simpan</button><br>
    </form>
  </div>
</body>
</html>
