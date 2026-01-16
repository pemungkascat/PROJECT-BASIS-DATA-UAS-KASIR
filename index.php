<?php include "cek_login.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Kasir CCTV</title>
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
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            max-width: 1200px;
        }

        .dashboard-card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            text-decoration: none;
            color: inherit;
            transition: all 0.3s;
            border: 1px solid #e9ecef;
        }

        .dashboard-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .card-header {
            font-size: 16px;
            font-weight: 600;
            color: #1a1d29;
            margin-bottom: 8px;
        }

        .card-description {
            font-size: 13px;
            color: #6c757d;
            line-height: 1.5;
        }

        .card-action {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e9ecef;
            font-size: 13px;
            color: #4CAF50;
            font-weight: 500;
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
        <h2>Dashboard</h2>
        <div class="user-info">
            <span>Kasir: Admin</span>
            <span>|</span>
            <span id="datetime"></span>
        </div>
    </div>

    <div class="content-area">
        <div class="dashboard-grid">
            <a href="transaksi.php" class="dashboard-card">
                <div class="card-header">Transaksi Penjualan</div>
                <div class="card-description">Proses transaksi penjualan produk CCTV, tambah item, cetak struk</div>
                <div class="card-action">Buka Transaksi →</div>
            </a>

            <a href="laporan.php" class="dashboard-card">
                <div class="card-header">Laporan Penjualan</div>
                <div class="card-description">Lihat riwayat transaksi, laporan harian, bulanan, dan tahunan</div>
                <div class="card-action">Lihat Laporan →</div>
            </a>

            <a href="produk.php" class="dashboard-card">
                <div class="card-header">Manajemen Produk</div>
                <div class="card-description">Kelola data produk, stok barang, harga, dan kategori produk</div>
                <div class="card-action">Kelola Produk →</div>
            </a>
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