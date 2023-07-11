<!-- Tambahkan elemen <select> untuk memilih kategori_service -->
<select id="kategoriFilter">
  <option value="semua">Semua</option>
  <option value="ringan">Service Ringan</option>
  <option value="berat">Service Berat</option>
</select>

<!-- Tambahkan elemen <div> untuk menampilkan tabel service -->
<div id="tabelService">
  <table class="table table-bordered">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Kategori Service</th>
      <th>Harga</th>
      <th>Foto Service</th>
      <th>Action</th>
    </tr>
    <!-- variabel $nomor yang akan digunakan untuk menghitung nomor urut setiap service. -->
    <?php $nomor = 1; ?>
    <?php
    //  Mengambil data service dari database dengan melakukan query menggunakan objek $koneksi. Query ini mengambil data dari tabel "services" dengan kategori yang sama dengan 1 (service).
    $ambil = $koneksi->query("SELECT * FROM services");

    // perulangan dengan menggunakan while untuk menampilkan setiap baris data service yang telah diambil. 
    // Setiap atribut service ditampilkan dalam elemen <td> yang sesuai dalam tabel.
    while ($pecah = $ambil->fetch_assoc()) {
    ?>
      <tr class="<?php echo $pecah['kategori_services']; ?>">
        <td><?php echo $nomor; ?></td>
        <td><?php echo $pecah['nama']; ?></td>
        <td><?php echo $pecah['kategori_services']; ?></td>
        <td>Rp <?php echo number_format($pecah['harga']); ?></td>
        <td>
          <img src="../asets/services/<?php echo $pecah['foto'] ?>" width="100">
        </td>
        <td>
          <!-- tombol "Hapus" yang mengarahkan ke halaman "deleteservice.php" dengan mengirimkan parameter "id" service yang akan dihapus.  -->
          <a href="deleteservice.php?id=<?php echo $pecah['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus service ini?')" class="btn-danger btn">Hapus</a>

          <!-- tombol "Ubah" yang mengarahkan ke halaman "editservice.php" dengan mengirimkan parameter "id" service yang akan diubah. -->
          <a href="editservice.php?id=<?php echo $pecah['id'] ?>" class="btn btn-warning">Ubah</a>
        </td>
      </tr>
      <?php $nomor++; ?>
    <?php } ?>
  </table>
</div>

<!-- Tambahkan script JavaScript untuk mengatur filter kategori_service -->
<script>
	// 	event listener mengambil perubahan saat klik <select> (contoh: service ringan) dengan ID "kategoriFilter". -->
	// perubahan terjadi, fungsi yang ditentukan akan dijalankan.
	document.getElementById('kategoriFilter').addEventListener('change', function() {
	// menyimpan nilai pilihan yang dipilih dalam elemen <select>. Nilai ini akan digunakan untuk memfilter perbaris data tabel.
    var kategori = this.value;
	// mengambil semua elemen <tr> (baris) dalam tabel service dengan menggunakan metode querySelectorAll(). Metode ini mengembalikan daftar elemen yang sesuai dengan selector yang diberikan, dalam hal ini
    var rows = document.getElementById('tabelService').querySelectorAll('tr');

    // untuk melakukan iterasi pada setiap elemen <tr> dalam variabel rows. Dalam setiap iterasi, fungsi yang ditentukan akan dijalankan.
    rows.forEach(function(row) {
		
		if (kategori === 'semua' || row.classList.contains(kategori)) {
        row.style.display = 'table-row';
      } else {
        row.style.display = 'none';
      }
    });
  });
</script>
