<?php
session_start();
require_once 'database.php';
$db = (new Database())->connection();
if (!isset($_SESSION['Id_Pengguna'])) {
    die("⚠️ Silakan login terlebih dahulu.");
}


$id_pengguna = $_SESSION['Id_Pengguna'];

$stmtNama = $db->prepare("SELECT * FROM t_pengguna WHERE Id_Pengguna = ?");
$stmtNama->execute([$id_pengguna]);
$user = $stmtNama->fetch(PDO::FETCH_ASSOC);
$nama = $user ? $user['Nama_pengguna'] : "Pengguna tidak diketahui";
$alamat = $user ? $user['Alamat_Pengguna'] : "alamat tidak diketahui";
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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,
100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #e6f4ea;
      color: #000;
      height: 120vh;
    }

    .navbar-links a {
      margin: 0 15px;
      color: #000;
      text-decoration: none;
      font-weight: 500;
    }

    .navbar-extra {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .navbar-extra input {
      padding: 5px 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .hero {
      text-align: center;
      padding: 60px 20px 30px;
      background-image: url('https://via.placeholder.com/1600x300');
      background-size: cover;
      background-position: center;
      color: #27ae60;
      font-size: 48px;
      font-weight: 700;
      margin-top: 50px;
    }

    .container {
      max-width: 1000px;
      margin: 40px auto;
      padding: 0 20px;
    }

    .section {
      background-color: #fff;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .section h3 {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 20px;
      margin-bottom: 10px;
    }

    .section h3 .ubah a {
      color:#ffa726;
      font-size: 16px;
      cursor: pointer;
      text-decoration: none;
    }

    .payment-details {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      margin-bottom: 30px;
    }

    .payment-details div {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      font-size: 18px;
    }

    .payment-details .total {
      font-weight: 700;
      font-size: 20px;
      border-top: 2px solid #ccc;
      padding-top: 10px;
      margin-top: 10px;
    }

    .btn-pesan {
      width: 100%;
      padding: 15px;
      font-size: 20px;
      background-color: #ffa726;
      color: #fff;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-weight: bold;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .btn-pesan:hover {
      background-color: #fb8c00;
    }

    @media (max-width: 768px) {
      .navbar-links {
        margin-top: 10px;
      }

      .navbar-extra {
        margin-top: 10px;
        width: 100%;
        justify-content: flex-start;
      }
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
  </form>>
    </div>
</nav>

  <div class="hero">
    Pembayaran
  </div>

  <main class="container">
    <section class="section">
      <h3>Alamat Pengiriman <span class="ubah"><a href="editpembayaran.php?idPembayaran='.$data['idPembayaran'].'' ">ubah</a></span></h3>
      <p><?php echo htmlspecialchars($alamat);?></p>
    </section>

    <section class="section">
      <h3>Nama Pembeli <span class="ubah"><a href="editdosen.php?idDosen='.$data['idDosen'].'">ubah</a></span></h3>
      <p><?php echo htmlspecialchars($nama);?></p>
    </section>

    <section class="section">
      <h3>Metode Pembayaran <span style="color: #ff9800;">Cash On Delivery ➤</span></h3>
    </section>
<?php $total = 0; $layanan = 2000; $pengiriman = 10000;?>
<?php foreach ($items as $item):
$subtotal = $item['Harga_Produk'] * $item['Jumlah'];

$total  += $subtotal;
?>   
 <?php endforeach; ?>
 <?php $total_semua = $total + $layanan + $pengiriman; ?>
    <section class="payment-details">
      <div><span>Subtotal Produk</span><span><?= number_format($total,0,',','.')?></span></div>
      <div><span>Biaya Layanan</span><span>Rp.2.000</span></div>
      <div><span>Biaya Pengiriman</span><span>Rp.10.000</span></div>
      <div class="total"><span>Total Pembayaran</span><span><?= number_format($total_semua,0,',','.')?></span></div>
    </section>

<form action="proses_pembayaran.php" method="POST">
  <input type="hidden" name="Id_Pengguna" value="<?= $id_pengguna ?>">
  <input type="hidden" name="SubTotal_Produk" value="<?= $total?>">
  <input type="hidden" name="Total_Pembayaran" value="<?= $total_semua ?>">
  <button type="submit" class="btn-pesan">Buat Pesanan</button>
</form>

  </main>
  <footer style="background-color: #1EE16C;
    width: 100%; text-align:center; padding: 14px; margin-top: 30px; color:white; border-radius:6px; border:none;" > @copyright by SayurVerse</footer>

   <script src="https://kit.fontawesome.com/66b0a68b39.js" crossorigin="anonymous"></script>
</body>
</html>
 