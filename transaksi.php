<?php include "config/koneksi.php"; 
include "cek_login.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Penjualan - Kasir CCTV</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: #f8f9fa;
            height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 280px;
            background: #1a1d29;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 25px 0;
        }

        .logo-section {
            padding: 0 25px 30px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo-section h1 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 5px;
            color: #fff;
        }

        .logo-section p {
            font-size: 12px;
            color: #8b92a8;
        }

        .menu-section {
            flex: 1;
            padding: 20px 0;
        }

        .menu-item {
            padding: 15px 25px;
            color: #8b92a8;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 15px;
            transition: all 0.2s;
            cursor: pointer;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.05);
            color: white;
        }

        .menu-item.active {
            background: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
            border-left-color: #4CAF50;
        }

        .menu-icon {
            width: 24px;
            height: 24px;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .topbar {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h2 {
            font-size: 24px;
            color: #1a1d29;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: #666;
        }

        .content-area {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
            background: #f8f9fa;
        }

        .content-wrapper {
            max-width: 1000px;
            margin: 0 auto;
        }

        .form-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            padding: 30px;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #1a1d29;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #4CAF50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #495057;
            font-weight: 500;
            font-size: 14px;
        }

        .optional {
            color: #adb5bd;
            font-size: 12px;
            font-weight: normal;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.2s;
            background: white;
        }

        input[type="text"]:focus,
        select:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }

        .table-container {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
            border: 1px solid #dee2e6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #f8f9fa;
            color: #495057;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            border-bottom: 2px solid #dee2e6;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
            font-size: 14px;
            color: #495057;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        table tr:hover {
            background-color: #f8f9fa;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #4CAF50;
        }

        input[type="number"] {
            width: 80px;
            padding: 6px 8px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="number"]:focus {
            outline: none;
            border-color: #4CAF50;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        button {
            flex: 1;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        button:hover {
            background-color: #45a049;
        }

        .btn-back {
            flex: 1;
            padding: 12px 24px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        .text-center {
            text-align: center;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .logo-section h1,
            .logo-section p,
            .menu-item span {
                display: none;
            }

            .menu-icon {
                margin-right: 0;
            }

            .menu-item {
                justify-content: center;
            }

            .content-area {
                padding: 15px;
            }

            .form-container {
                padding: 20px;
            }

            .button-group {
                flex-direction: column;
            }

            .table-container {
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo-section">
        <h1>KASIR CCTV</h1>
        <p>Point of Sale System</p>
    </div>

    <div class="menu-section">
        <a href="transaksi.php" class="menu-item active">
            <div class="menu-icon">💳</div>
            <span>Transaksi</span>
        </a>
        <a href="laporan.php" class="menu-item">
            <div class="menu-icon">📊</div>
            <span>Laporan</span>
        </a>
        <a href="produk.php" class="menu-item">
            <div class="menu-icon">📦</div>
            <span>Produk</span>
        </a>
    </div>
</div>

<div class="main-content">
    <div class="topbar">
        <h2>Transaksi Penjualan</h2>
        <div class="user-info">
            <span>Kasir: Admin</span>
            <span>|</span>
            <span id="datetime"></span>
        </div>
    </div>

    <div class="content-area">
        <div class="content-wrapper">
            <div class="form-container">
                <form method="POST" action="simpan_transaksi.php">
                    
                    <!-- DATA KASIR -->
                    <div class="form-section">
                        <h3 class="section-title">👤 Informasi Kasir</h3>
                        <div class="form-group">
                            <label for="kasir">Kasir</label>
                            <select name="kasir" id="kasir" required>
                                <option value="">-- Pilih Kasir --</option>
                                <?php
                                $kasir = mysqli_query($koneksi,"SELECT * FROM kasir");
                                while($k=mysqli_fetch_assoc($kasir)){
                                    echo "<option value='$k[id_kasir]'>$k[nama_kasir]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- DATA PELANGGAN -->
                    <div class="form-section">
                        <h3 class="section-title">🧑‍💼 Informasi Pelanggan</h3>
                        
                        <div class="form-group">
                            <label for="nama_pelanggan">Nama Pelanggan</label>
                            <input type="text" id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukkan nama pelanggan" required>
                        </div>

                        <div class="form-group">
                            <label for="telepon">Telepon <span class="optional">(opsional)</span></label>
                            <input type="text" id="telepon" name="telepon" placeholder="Contoh: 08123456789">
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat <span class="optional">(opsional)</span></label>
                            <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat">
                        </div>
                    </div>

                    <!-- DAFTAR PRODUK -->
                    <div class="form-section">
                        <h3 class="section-title">🛒 Pilih Produk</h3>
                        
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th width="60" class="text-center">Pilih</th>
                                        <th>Nama Produk</th>
                                        <th width="120">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $produk = mysqli_query($koneksi,"SELECT * FROM produk");
                                    while($p=mysqli_fetch_assoc($produk)){
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="produk[]" value="<?= $p['id_produk'] ?>">
                                        </td>
                                        <td><?= $p['nama_produk'] ?></td>
                                        <td>
                                            <input type="number" name="jumlah[<?= $p['id_produk'] ?>]" value="1" min="1">
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TOMBOL AKSI -->
                    <div class="button-group">
                        <button type="submit">
                            <span>💾</span>
                            <span>SIMPAN TRANSAKSI</span>
                        </button>
                        <a href="index.php" class="btn-back">
                            <span>🔙</span>
                            <span>KEMBALI</span>
                        </a>
                    </div>

                </form>
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