<?php
include "config/koneksi.php";

// TAMBAH PRODUK
if(isset($_POST['simpan'])){
    mysqli_query($koneksi,"
        INSERT INTO produk(nama_produk,merk,harga,stok)
        VALUES(
            '$_POST[nama_produk]',
            '$_POST[merk]',
            '$_POST[harga]',
            '$_POST[stok]'
        )
    ");
}

// UPDATE PRODUK
if(isset($_POST['update'])){
    mysqli_query($koneksi,"
        UPDATE produk SET
            nama_produk='$_POST[nama_produk]',
            merk='$_POST[merk]',
            harga='$_POST[harga]',
            stok='$_POST[stok]'
        WHERE id_produk='$_POST[id_produk]'
    ");
}

header("Location: produk.php");
