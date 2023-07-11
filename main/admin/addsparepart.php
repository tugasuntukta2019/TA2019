<?php
include '../koneksi.php';
include '../component.php';

// Get the maximum ID from the database and add 1 to it
// Mengambil nilai maksimum dari kolom id pada tabel sparepart untuk menentukan id berikutnya. Nilai maksimum 
// diambil menggunakan pernyataan SQL SELECT MAX(id) AS max_id FROM sparepart. Kemudian, nilai tersebut ditambah 1 untuk mendapatkan next_id.
$query_max_id = "SELECT MAX(id) AS max_id FROM sparepart";
$result_max_id = mysqli_query($koneksi, $query_max_id);
$row_max_id = mysqli_fetch_assoc($result_max_id);
$next_id = $row_max_id['max_id'] + 1;

// Jika tombol "Simpan" ditekan, data dari form akan diambil menggunakan metode $_POST. Data tersebut akan 
// dimasukkan ke dalam variabel yang sesuai. Gambar yang diunggah juga akan disimpan di folder ../asets/sparepart/. 
// Setelah itu, dilakukan penambahan data produk sparepart ke dalam tabel "sparepart" menggunakan pernyataan SQL INSERT INTO. 
// Jika penambahan berhasil, maka akan ditampilkan pesan sukses dan halaman akan di-refresh. Jika gagal, akan ditampilkan pesan error.

// untuk menambahkan data produk sparepart baru. Terdapat beberapa input seperti "Id" (dengan nilai next_id yang didapatkan sebelumnya)
//  "Nama", "Harga", "Stok", dan "Foto". Terdapat juga tombol "Simpan" untuk menyimpan data produk sparepart.
if (isset($_POST['save'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $foto = $_FILES['foto']['name'];
  $lokasi = $_FILES['foto']['tmp_name'];
  move_uploaded_file($lokasi, "../asets/sparepart/".$foto);
  $stok = $_POST['stok'];
  $mysqli = "INSERT INTO sparepart (id, nama, harga, foto, kategori, stok) VALUES ('$id', '$nama', '$harga', '$foto', '2', '$stok')";
  $result = mysqli_query($koneksi, $mysqli);

  if ($result) {
    echo "<div class='alert alert-info'>Penambahan Produk Berhasil</div>";
    echo "<meta http-equiv='refresh' content='1;url=view.php?cari=2'>";
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
        <label>Harga (Rp)</label>
        <input type="number" class="form-control" name="harga">
      </div>
	  
      <div class="form-group">
        <label>stok</label>
        <input type="number" class="form-control" name="stok">
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
