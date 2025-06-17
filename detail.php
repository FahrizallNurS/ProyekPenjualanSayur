<?php
require_once 'database.php';
$db = (new Database())->connection();

$id = $_GET['id'] ?? null;

if (!$id) {
    die("⚠️ Pembayaran tidak ditemukan.");
}

// Ambil data pembayaran
$stmtBayar = $db->prepare("SELECT * FROM pembayaran p JOIN t_pengguna u ON p.Id_Pengguna = u.Id_Pengguna WHERE Id_Pembayaran = ?");
$stmtBayar->execute([$id]);
$data = $stmtBayar->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die("⚠️ Data pembayaran tidak ditemukan.");
}

// Ambil item produk yang termasuk dalam transaksi ini
$stmtItem = $db->prepare("
    SELECT p.Nama_Produk, p.Harga_Produk, t.Jumlah
    FROM transaksi t
    JOIN produk p ON t.Id_Produk = p.Id_Produk
    WHERE t.Id_Pembayaran = ?
");
$stmtItem->execute([$id]);
$items = $stmtItem->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pembayaran</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,
100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <style>
        body { font-family: Poppins, sans-serif; background: #eef2f3; padding: 20px; }
   .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
        
            margin: 80px auto;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 10px;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #ffa726;
            color: white;
        }

        h3.total {
            text-align: right;
            margin-top: 25px;
            font-size: 20px;
        }

        .info {
            margin-bottom: 10px;
        }

        .info strong {
            display: inline-block;
            width: 120px;
        }
        .search-form button {
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-left: none;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
  font-size: 16px;
  background-color: transparent;
  border: none;

}

/* Hover efek */
.search-form button:hover {
  background-color: #1EE16C;
}

/* Container form */
.search-form {
  display: flex;
  align-items: center;
  margin-left: auto; /* agar di kanan */
}
    </style>
</head>
<body>
    
  <nav class="navbar">
    <div class="navbar-logo"><span>Sayur</span>Verse</div>
    <a href="produk.php">Produk</a>
    <a href="beranda.php">Beranda</a>
    <a href="profil.php">Profil</a>
    <a href="keranjang.php">Keranjang</a>
    <div class="navbar-extra">
         <form action="produk.php" method="GET" class="search-form">
    <input 
      type="text" 
      name="search" 
      placeholder="Cari Sayuran…" 
      required 
    />
    <button type="submit" aria-label="Cari">
      <i class="fa-solid fa-magnifying-glass"></i>
    </button>
  </form>
    </div>
</nav>
    <div class="card">
        <h2>Detail Pembayaran #<?= htmlspecialchars($id) ?></h2>
        <p><strong>Nama:</strong> <?= htmlspecialchars($data['Nama_pengguna']) ?></p>
        <p><strong>Alamat:</strong> <?= htmlspecialchars($data['Alamat_Pengguna']) ?></p>
        <p><strong>Tanggal:</strong> <?= date('d-m-Y H:i', strtotime($data['Waktu_Pembayaran'] ?? 'now')) ?></p>

        <table>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Biaya Lain</th>
            </tr>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['Nama_Produk']) ?></td>
                    <td>Rp<?= number_format($item['Harga_Produk'], 0, ',', '.') ?></td>
                    <td><?= $item['Jumlah'] ?></td>
                    <td>Rp<?= number_format($item['Harga_Produk'] * $item['Jumlah'], 0, ',', '.') ?></td>
                    <td>Rp 12.000</td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h3 style="text-align: right; margin-top: 20px;">
            Total: Rp<?= number_format($data['Total_Pembayaran'], 0, ',', '.') ?>
        </h3>
    </div>
    <footer style="background-color: #1EE16C;
    width: 100%; text-align:center; padding: 14px; margin-top: 30px; color:white;" > @copyright by SayurVerse</footer>
</body>
</html>
