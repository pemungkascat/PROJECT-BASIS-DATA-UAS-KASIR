<?php
include "config/koneksi.php";

$id_kasir = $_POST['kasir'];

// =======================
// SIMPAN PELANGGAN
// =======================
$nama_pelanggan = $_POST['nama_pelanggan'];
$telepon = $_POST['telepon'];
$alamat  = $_POST['alamat'];

mysqli_query($koneksi,"
INSERT INTO pelanggan(nama_pelanggan,telepon,alamat)
VALUES('$nama_pelanggan','$telepon','$alamat')
");

$id_pelanggan = mysqli_insert_id($koneksi);

// =======================
// PRODUK & JUMLAH
// =======================
$produk_pilih = $_POST['produk'];
$jumlah       = $_POST['jumlah'];

$total = 0;

// HITUNG TOTAL
foreach($produk_pilih as $id_produk){
    $p = mysqli_fetch_assoc(
        mysqli_query($koneksi,"SELECT harga,stok FROM produk WHERE id_produk=$id_produk")
    );

    $qty = $jumlah[$id_produk];

    if($qty > $p['stok']){
        echo "Stok tidak cukup untuk produk ID $id_produk";
        exit;
    }

    $subtotal = $p['harga'] * $qty;
    $total += $subtotal;
}

// =======================
// SIMPAN TRANSAKSI
// =======================
mysqli_query($koneksi,"
INSERT INTO transaksi(id_kasir,id_pelanggan,total_bayar)
VALUES($id_kasir,$id_pelanggan,$total)
");

$id_transaksi = mysqli_insert_id($koneksi);

// =======================
// DETAIL + KURANGI STOK
// =======================
foreach($produk_pilih as $id_produk){

    $p = mysqli_fetch_assoc(
        mysqli_query($koneksi,"SELECT harga FROM produk WHERE id_produk=$id_produk")
    );

    $qty = $jumlah[$id_produk];
    $subtotal = $p['harga'] * $qty;

    mysqli_query($koneksi,"
    INSERT INTO detail_transaksi(id_transaksi,id_produk,jumlah,subtotal)
    VALUES($id_transaksi,$id_produk,$qty,$subtotal)
    ");

    mysqli_query($koneksi,"
    UPDATE produk SET stok = stok - $qty
    WHERE id_produk = $id_produk
    ");
}

// =======================
// PEMBAYARAN
// =======================
mysqli_query($koneksi,"
INSERT INTO pembayaran(id_transaksi,metode_pembayaran,jumlah_uang_diterima,kembalian)
VALUES($id_transaksi,'Tunai',$total,0)
");

header("Location: laporan.php");
