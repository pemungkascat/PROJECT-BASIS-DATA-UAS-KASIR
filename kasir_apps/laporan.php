<?php include "config/koneksi.php"; 
include "cek_login.php";?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi - Kasir CCTV</title>
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
            max-width: 1400px;
            margin: 0 auto;
        }

        .info-box {
            background: white;
            border-left: 4px solid #4CAF50;
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .info-box p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }

        .table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .table-header {
            background: #4CAF50;
            color: white;
            padding: 15px 20px;
            font-size: 16px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #f8f9fa;
            color: #1a1d29;
            padding: 12px 15px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
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

        .btn-action {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 12px;
            display: inline-block;
            background-color: #2196F3;
            color: white;
            transition: background 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-action:hover {
            background-color: #1976D2;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .no-data {
            text-align: center;
            padding: 60px 20px;
            color: #adb5bd;
            font-size: 14px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #5a6268;
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
        <a href="transaksi.php" class="menu-item">
            <div class="menu-icon">💳</div>
            <span>Transaksi</span>
        </a>
        <a href="laporan.php" class="menu-item active">
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
        <h2>Laporan Transaksi</h2>
        <div class="user-info">
            <span>Kasir: Admin</span>
            <span>|</span>
            <span id="datetime"></span>
        </div>
    </div>

    <div class="content-area">
        <div class="content-wrapper">
            <div class="info-box">
                <p>📌 Daftar semua transaksi penjualan yang telah dilakukan</p>
            </div>

            <div class="table-container">
                <div class="table-header">
                    📋 Data Transaksi
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th width="50" class="text-center">No</th>
                            <th width="150">Tanggal</th>
                            <th>Kasir</th>
                            <th>Pelanggan</th>
                            <th width="180" class="text-right">Total</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $q = mysqli_query($koneksi,"
                        SELECT 
                            t.id_transaksi,
                            t.tanggal_transaksi,
                            k.nama_kasir,
                            p.nama_pelanggan,
                            t.total_bayar
                        FROM transaksi t
                        JOIN kasir k ON t.id_kasir = k.id_kasir
                        JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
                        ORDER BY t.id_transaksi DESC
                        ");

                        if(mysqli_num_rows($q) > 0){
                            while($d = mysqli_fetch_assoc($q)){
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($d['tanggal_transaksi'])) ?></td>
                            <td><?= $d['nama_kasir'] ?></td>
                            <td><?= $d['nama_pelanggan'] ?></td>
                            <td class="text-right">Rp <?= number_format($d['total_bayar'], 0, ',', '.') ?></td>
                            <td class="text-center">
                                <a href="struk.php?id=<?= $d['id_transaksi'] ?>" target="_blank" class="btn-action">
                                    🖨️ Cetak Struk
                                </a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="6" class="no-data">
                                📭 Belum ada data transaksi
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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