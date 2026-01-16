<?php
include "config/koneksi.php";
include "cek_login.php";

$edit = false;
if(isset($_GET['edit'])){
    $edit = true;
    $id = $_GET['edit'];
    $data = mysqli_fetch_assoc(
        mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk=$id")
    );
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manajemen Produk - Kasir CCTV</title>

<style>
/* ===== GLOBAL (SAMA DENGAN TRANSAKSI) ===== */
*{margin:0;padding:0;box-sizing:border-box}
body{
    font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen,Ubuntu,sans-serif;
    background:#f8f9fa;
    height:100vh;
    display:flex;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:280px;
    background:#1a1d29;
    color:white;
    display:flex;
    flex-direction:column;
    padding:25px 0;
}
.logo-section{
    padding:0 25px 30px;
    border-bottom:1px solid rgba(255,255,255,.1);
}
.logo-section h1{font-size:20px;font-weight:700}
.logo-section p{font-size:12px;color:#8b92a8}

.menu-section{flex:1;padding:20px 0}
.menu-item{
    padding:15px 25px;
    color:#8b92a8;
    text-decoration:none;
    display:flex;
    align-items:center;
    font-size:15px;
    border-left:3px solid transparent;
}
.menu-item:hover{background:rgba(255,255,255,.05);color:white}
.menu-item.active{
    background:rgba(76,175,80,.1);
    color:#4CAF50;
    border-left-color:#4CAF50;
}
.menu-icon{width:24px;margin-right:15px;font-size:18px}

/* ===== MAIN ===== */
.main-content{flex:1;display:flex;flex-direction:column}
.topbar{
    background:white;
    padding:20px 30px;
    box-shadow:0 1px 3px rgba(0,0,0,.05);
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.topbar h2{font-size:24px;font-weight:600;color:#1a1d29}
.user-info{display:flex;gap:12px;font-size:14px;color:#666}

.content-area{
    flex:1;
    padding:30px;
    overflow-y:auto;
}
.content-wrapper{max-width:1000px;margin:0 auto}
.form-container{
    background:white;
    border-radius:8px;
    box-shadow:0 1px 3px rgba(0,0,0,.08);
    padding:30px;
}

/* ===== FORM & TABLE ===== */
.form-section{margin-bottom:30px}
.section-title{
    font-size:16px;
    font-weight:600;
    color:#1a1d29;
    margin-bottom:20px;
    padding-bottom:10px;
    border-bottom:2px solid #4CAF50;
}
.form-group{margin-bottom:20px}
label{display:block;margin-bottom:8px;font-size:14px;font-weight:500}

input{
    width:100%;
    padding:10px 12px;
    border:1px solid #dee2e6;
    border-radius:6px;
    font-size:14px;
}
input:focus{
    outline:none;
    border-color:#4CAF50;
    box-shadow:0 0 0 3px rgba(76,175,80,.1);
}

.table-container{
    border:1px solid #dee2e6;
    border-radius:8px;
    overflow:hidden;
}
table{width:100%;border-collapse:collapse}
th{
    background:#f8f9fa;
    padding:12px;
    font-size:13px;
    text-transform:uppercase;
    border-bottom:2px solid #dee2e6;
}
td{
    padding:12px;
    border-bottom:1px solid #dee2e6;
    font-size:14px;
}

.button-group{
    display:flex;
    gap:12px;
}
button,.btn-back{
    flex:1;
    padding:12px;
    border-radius:6px;
    border:none;
    font-weight:600;
    font-size:15px;
    cursor:pointer;
    display:flex;
    justify-content:center;
    gap:8px;
}
button{background:#4CAF50;color:white}
button:hover{background:#45a049}
.btn-back{
    background:#6c757d;
    color:white;
    text-decoration:none;
}
.btn-back:hover{background:#5a6268}

.btn-edit{color:#2196F3;font-weight:600;text-decoration:none}
.btn-delete{color:#f44336;font-weight:600;text-decoration:none}

.text-center{text-align:center}

/* RESPONSIVE */
@media(max-width:768px){
    .sidebar{width:70px}
    .logo-section h1,.logo-section p,.menu-item span{display:none}
    .menu-item{justify-content:center}
    .menu-icon{margin-right:0}
    .content-area{padding:15px}
    .form-container{padding:20px}
    .button-group{flex-direction:column}
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo-section">
        <h1>KASIR CCTV</h1>
        <p>Point of Sale System</p>
    </div>
    <div class="menu-section">
        <a href="transaksi.php" class="menu-item">
            <div class="menu-icon">💳</div><span>Transaksi</span>
        </a>
        <a href="laporan.php" class="menu-item">
            <div class="menu-icon">📊</div><span>Laporan</span>
        </a>
        <a href="produk.php" class="menu-item active">
            <div class="menu-icon">📦</div><span>Produk</span>
        </a>
    </div>
</div>

<!-- MAIN -->
<div class="main-content">
    <div class="topbar">
        <h2>Manajemen Produk</h2>
        <div class="user-info">
            <span>Kasir: Admin</span>
            <span>|</span>
            <span id="datetime"></span>
        </div>
    </div>

    <div class="content-area">
        <div class="content-wrapper">
            <div class="form-container">

                <!-- FORM PRODUK -->
                <div class="form-section">
                    <h3 class="section-title"><?= $edit ? '✏️ Edit Produk' : '➕ Tambah Produk' ?></h3>
                    <form method="POST" action="simpan_produk.php">
                        <input type="hidden" name="id_produk" value="<?= $edit ? $data['id_produk'] : '' ?>">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" name="nama_produk" required value="<?= $edit ? $data['nama_produk'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <label>Merk</label>
                            <input type="text" name="merk" value="<?= $edit ? $data['merk'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" name="harga" required value="<?= $edit ? $data['harga'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stok" required value="<?= $edit ? $data['stok'] : '' ?>">
                        </div>
                        <button name="<?= $edit ? 'update' : 'simpan' ?>">
                            <?= $edit ? 'UPDATE PRODUK' : 'SIMPAN PRODUK' ?>
                        </button>
                    </form>
                </div>

                <!-- TABEL -->
                <div class="form-section">
                    <h3 class="section-title">📋 Daftar Produk</h3>
                    <div class="table-container">
                        <table>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Merk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no=1;
                            $q=mysqli_query($koneksi,"SELECT * FROM produk");
                            while($p=mysqli_fetch_assoc($q)){
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $p['nama_produk'] ?></td>
                                <td><?= $p['merk'] ?></td>
                                <td>Rp <?= number_format($p['harga'],0,',','.') ?></td>
                                <td class="text-center"><?= $p['stok'] ?></td>
                                <td class="text-center">
                                    <a href="?edit=<?= $p['id_produk'] ?>" class="btn-edit">Edit</a> |
                                    <a href="hapus_produk.php?id=<?= $p['id_produk'] ?>" class="btn-delete"
                                       onclick="return confirm('Hapus produk ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>

                <div class="button-group">
                    <a href="index.php" class="btn-back">🔙 Kembali</a>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
function updateDateTime() {
    const now = new Date();
    const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    document.getElementById('datetime').textContent = now.toLocaleDateString('id-ID', options);
}

updateDateTime();
setInterval(updateDateTime, 1000);
</script>

</body>
</html>
