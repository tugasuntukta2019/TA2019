<?php
include '../koneksi.php';
include '../component.php';

// untuk mengambil nilai maksimum dari kolom id pada tabel service di database dan menambahkan 1 ke nilai tersebut. 
// Nilai ini akan digunakan sebagai nilai awal untuk input field Id pada form. Hal ini dilakukan untuk memastikan 
// bahwa setiap service yang ditambahkan memiliki id yang unik.
$query_max_id = "SELECT MAX(id) AS max_id FROM services";
$result_max_id = mysqli_query($koneksi, $query_max_id);
$row_max_id = mysqli_fetch_assoc($result_max_id);
$next_id = $row_max_id['max_id'] + 1;

// Jika tombol "Simpan" (dengan atribut name="save") ditekan, maka nilai-nilai input form akan diambil menggunakan variabel $_POST.
if (isset($_POST['save'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $kategori_services = $_POST['kategori_services'];
  $harga = $_POST['harga'];
  $foto = $_FILES['foto']['name'];
  $lokasi = $_FILES['foto']['tmp_name'];
  move_uploaded_file($lokasi, "../asets/services/".$foto);
  
  // query INSERT INTO akan dieksekusi untuk memasukkan data services ke dalam tabel service di database.
  $mysqli = "INSERT INTO services (id, nama, kategori_services, harga, foto, kategori) VALUES ('$id', '$nama', '$kategori_services', '$harga', '$foto', '1')";
  $result = mysqli_query($koneksi, $mysqli);

  // Jika query berhasil, pesan sukses akan ditampilkan dan halaman akan diarahkan ke halaman "view.php?cari=1", yang akan ditampilkan service . Jika query gagal, maka akan muncul pesan kesalahan.
  if ($result) {
    echo "<div class='alert alert-info'>Penambahan Produk Berhasil</div>";
    echo "<meta http-equiv='refresh' content='1;url=view.php?cari=1'>";
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
  <?php include 'headersuperadmin.php'; ?>
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
		<label>Kategori Service</label>
		<select class="form-control" name="kategori_services">
			<option selected disabled>Kategori Service</option>
			<option value="service ringan">Service Ringan</option>
			<option value="service berat">Service Berat</option>
		</select>
	  </div>
      <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" class="form-control" name="harga">
      </div>
      <div class="form-grup">
        <label class="foto">Foto</label>
        <input type="file" name="foto" class="form-control">
      </div><br>
      <button class="btn btn-primary" name="save">Simpan</button><br>
    </form>
  </div>
</body>
</html>
