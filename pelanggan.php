<?php include "config/koneksi.php"; ?>

<h3>Input Pelanggan</h3>

<form method="POST">
Nama Pelanggan <br>
<input type="text" name="nama" required><br><br>

Telepon <br>
<input type="text" name="telepon"><br><br>

Alamat <br>
<input type="text" name="alamat"><br><br>

<button name="simpan">Simpan</button>
</form>

<?php
if(isset($_POST['simpan'])){
    mysqli_query($koneksi,"
        INSERT INTO pelanggan(nama_pelanggan,telepon,alamat)
        VALUES('$_POST[nama]','$_POST[telepon]','$_POST[alamat]')
    ");
    echo "<p>Data berhasil disimpan</p>";
}
?>

<a href="index.php">Kembali</a>
