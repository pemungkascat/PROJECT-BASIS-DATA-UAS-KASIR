<?php
session_start();
include "config/koneksi.php";

$nama_kasir = $_POST['nama_kasir'];
$telepon    = $_POST['telepon'];

$query = mysqli_query($koneksi,
    "SELECT * FROM kasir 
     WHERE nama_kasir='$nama_kasir' 
     AND telepon='$telepon'"
);

$data = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query) > 0){
    $_SESSION['login'] = true;
    $_SESSION['id_kasir'] = $data['id_kasir'];
    $_SESSION['nama_kasir'] = $data['nama_kasir'];
    header("Location: index.php");
}else{
    $_SESSION['error'] = "Nama kasir atau nomor telepon salah!";
    header("Location: login.php");
}
