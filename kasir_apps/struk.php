<?php
include "config/koneksi.php";
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .struk-container {
            max-width: 350px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .struk {
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header h2 {
            font-size: 20px;
            margin-bottom: 5px;
            letter-spacing: 2px;
        }

        .header p {
            font-size: 12px;
            margin: 3px 0;
            color: #555;
        }

        hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 12px 0;
        }

        .info-row {
            display: flex;
            font-size: 13px;
            margin: 5px 0;
        }

        .info-label {
            width: 90px;
            font-weight: bold;
        }

        .info-value {
            flex: 1;
        }

        .item {
            margin: 10px 0;
            font-size: 13px;
        }

        .item-name {
            font-weight: bold;
            margin-bottom: 3px;
        }

        .item-detail {
            color: #555;
            padding-left: 10px;
        }

        .total-section {
            margin: 15px 0;
            text-align: right;
        }

        .total-label {
            font-size: 14px;
            font-weight: bold;
        }

        .total-value {
            font-size: 18px;
            font-weight: bold;
            margin-top: 5px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 15px;
            color: #555;
        }

        .footer p {
            margin: 3px 0;
        }

        .thank-you {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-print {
            padding: 10px 30px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-print:hover {
            background-color: #45a049;
        }

        .btn-close {
            padding: 10px 30px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            font-weight: bold;
            margin-left: 10px;
        }

        .btn-close:hover {
            background-color: #da190b;
        }

        @media print {
            body {
                background-color: white;
                padding: 0;
            }

            .struk-container {
                max-width: 300px;
                box-shadow: none;
                border-radius: 0;
                padding: 10px;
            }

            .button-container {
                display: none;
            }

            hr {
                border-top: 1px dashed #000;
            }
        }
    </style>
</head>
<body>

<div class="struk-container">
    <div class="struk">

        <?php
        // HEADER
        $header = mysqli_fetch_assoc(mysqli_query($koneksi,"
        SELECT 
            t.id_transaksi,
            t.tanggal_transaksi,
            k.nama_kasir,
            p.nama_pelanggan,
            t.total_bayar
        FROM transaksi t
        JOIN kasir k ON t.id_kasir = k.id_kasir
        JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
        WHERE t.id_transaksi = $id
        "));
        ?>

        <div class="header">
            <h2>TOKO CCTV</h2>
            <p>Jl. Contoh No. 123</p>
            <p>Telp: 08123456789</p>
        </div>

        <hr>

        <div class="info-row">
            <div class="info-label">No Struk</div>
            <div class="info-value">: <?= str_pad($header['id_transaksi'], 5, '0', STR_PAD_LEFT) ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal</div>
            <div class="info-value">: <?= date('d/m/Y H:i', strtotime($header['tanggal_transaksi'])) ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Kasir</div>
            <div class="info-value">: <?= $header['nama_kasir'] ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Pelanggan</div>
            <div class="info-value">: <?= $header['nama_pelanggan'] ?></div>
        </div>

        <hr>

        <?php
        // DETAIL PRODUK
        $detail = mysqli_query($koneksi,"
        SELECT 
            pr.nama_produk,
            dt.jumlah,
            dt.subtotal
        FROM detail_transaksi dt
        JOIN produk pr ON dt.id_produk = pr.id_produk
        WHERE dt.id_transaksi = $id
        ");

        while($d = mysqli_fetch_assoc($detail)){
            $harga_satuan = $d['subtotal'] / $d['jumlah'];
        ?>
        <div class="item">
            <div class="item-name"><?= $d['nama_produk'] ?></div>
            <div class="item-detail">
                <?= $d['jumlah'] ?> x Rp <?= number_format($harga_satuan, 0, ',', '.') ?>
                = Rp <?= number_format($d['subtotal'], 0, ',', '.') ?>
            </div>
        </div>
        <?php } ?>

        <hr>

        <div class="total-section">
            <div class="total-label">TOTAL</div>
            <div class="total-value">Rp <?= number_format($header['total_bayar'], 0, ',', '.') ?></div>
        </div>

        <hr>

        <div class="footer">
            <p class="thank-you">Terima Kasih</p>
            <p>Mendapatkan Garansi Dari Toko Kami i</p>
            <p>Selama 3 Hari</p>
            <p>Jika Klaim Garansi Mohon Membawa Struk Ini</p>
        </div>

        <div class="button-container">
            <button class="btn-print" onclick="window.print()">🖨️ Cetak Struk</button>
            <button class="btn-close" onclick="window.close()">❌ Tutup</button>
        </div>

    </div>
</div>

</body>
</html>