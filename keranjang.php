<?php
session_start();
require_once 'database.php';
$db = (new Database())->connection();
if (!isset($_SESSION['Id_Pengguna'])) {
    die("⚠️ Silakan login terlebih dahulu.");
}

$id_pengguna = $_SESSION['Id_Pengguna'];
$stmt = $db->prepare("
    SELECT t.Id_Produk, t.Jumlah, p.Nama_Produk, p.Harga_Produk, p.gambar
    FROM transaksi t
    JOIN produk p ON t.Id_Produk = p.Id_Produk
    WHERE t.Id_Pengguna = ? AND t.Id_Pembayaran IS NULL
");
$stmt->execute([$id_pengguna]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,
100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<style>
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
    <div class="Keranjang">
        <div class="header-kranjang">
            <img src="gambar/keranjang.png"alt="gambartengah" style="margin-top: 68px; opacity: 5%;">
            <h1>KERANJANG BELANJA</h1>
        </div>
    </div>
    
    <div class="container-keranjang">
        <div class="navbar-keranjang">
            <p>Produk</p>
            <p>Harga</p>
            <p>Jumlah</p>
            <p>Sub total</p>
        </div>
      <div class="keranjang-belanja" id="keranjangContainer">
<?php $total = 0; ?>
<?php if (!empty($items)): ?>
    <?php foreach ($items as $item): 
        $subtotal = $item['Harga_Produk'] * $item['Jumlah'];
        $total += $subtotal;
    ?> 
   <div class="item-keranjang" style="display: flex; justify-content: space-between; align-items: center;">
    <div style="display: flex; justify-content: space-between; align-items: center; flex: 1; gap: 30px;">
        <img style="margin-left: 100px;" src="gambar/<?= htmlspecialchars($item['gambar']) ?>" width="70" height="70">
        <p style="margin-right: 58px;">Rp<?= number_format($item['Harga_Produk'], 0, ',', '.') ?></p>
        <p style="margin-right: 65px;"><?= $item['Jumlah'] ?></p>
        <p>Rp<?= number_format($subtotal, 0, ',', '.') ?></p>
    </div>
    <form method="POST" action="keranjang_hapus.php" style="margin-left: 20px;">
        <input type="hidden" name="Id_Produk" value="<?= $item['Id_Produk'] ?>">
        <input type="hidden" name="aksi" value="hapus">
        <button class="hapus" type="submit">Hapus</button>
    </form>
</div>

    <?php endforeach; ?>
    <hr>
   <div style="text-align: right; margin-top: 20px;">
    <div style="font-weight: bold; margin-bottom: 10px;">
        Total: Rp<?= number_format($total, 0, ',', '.') ?>
    </div>
   <form method="POST" action="pembayaran1.php">
    <input type="hidden" name="subtotal" value="<?= $total ?>">
    <input type="hidden" name="total" value="<?= $total + 2000 + 10000 ?>">
    <button type="submit" class="btn-pesan" style="background-color: #1EE16C; padding:5px; border-radius:5px;">Buat Pesanan</button>
</form>

</div>

  
<?php else: ?>
    <p>Keranjang kosong 😢</p>
<?php endif; ?>
</div>

</div>
<footer style="background-color: #1EE16C;
    width: 100%; text-align:center; padding: 14px; margin-top: 30px; color:white;" > @copyright by SayurVerse</footer>
</body>   <script src="https://kit.fontawesome.com/66b0a68b39.js" crossorigin="anonymous"></script>
</html>

<?php

