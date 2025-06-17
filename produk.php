<?php

require_once "database.php";
 
$db = (new Database())->connection();

$sql = "SELECT * FROM produk";
$stmt = $db->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama = isset($_POST['Nama_Produk']) ? $_POST['Nama_Produk'] : null;
    $harga = isset($_POST['Harga_Produk']) ? $_POST['Harga_Produk'] : null;
    $gambar = isset($_FILES['gambar']['name']) ? $_FILES['gambar']['name'] : null;
    $tmp = isset($_FILES['gambar']['tmp_name']) ? $_FILES['gambar']['tmp_name'] : null;

    $folder = "gambar/";
    move_uploaded_file($tmp, $folder . $gambar);


    $stmt = $db->prepare("INSERT INTO produk (Nama_Produk, Harga_Produk, gambar) VALUES (?, ?, ?)");
    $stmt->bindParam('sss', $nama, $harga, $gambar);
    $stmt->execute([$nama, $harga, $gambar]);


    echo "Produk berhasil ditambahkan!";
}
$search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '%';

$stmt = $db->prepare("SELECT * FROM produk WHERE LOWER(Nama_Produk) LIKE LOWER(?)");
$stmt->execute([$search]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,
100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<style>
    *{
        margin: 0;
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
    <!-- navbar -->
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


    <!-- navbar -end -->
    <!-- main  -->
    <div class="main">
        <div class="header-produk">
            <img src="gambar/kiri.png" alt="kiri" style="float: left;">
            <img src="gambar/kanan.png" alt="kanan" style="float: right;">
            <h1>Sayuran Segar, Sehat, dan Organik untuk Keluarga Anda</h1>
            <img src="gambar/buahtengah.png" width="400px" height="360px" alt="gambartengah" style="margin-top: -45px;">
        </div>
    </div>
    <section class="produk">
        <div class="Sayur">
            <h2>Produk Kami</h2>
        </div>
        <div class="row" style="display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;">
            <?php foreach ($result as $row): ?>
                <div class="produk-card">
                    <div class="sayuran">
                        <img src="gambar/<?= htmlspecialchars($row['gambar']) ?>" width="222px" height="222px" alt="<?= htmlspecialchars($row['Nama_Produk']) ?> ">
                        <h2><?= htmlspecialchars($row['Nama_Produk']) ?><br>
                            1 kg<br>
                            <span>Rp.<?= number_format($row['Harga_Produk'], 0, ',', '.') ?></span>
                        </h2>
                        <form action="tambah_keranjang.php" method="POST">
                            <input type="hidden" name="Id_Produk" value="<?= $row['Id_Produk'] ?>">
                            <button type="submit">  <i class="fa-solid fa-cart-shopping"></i> Tambah ke Keranjang</button>
                        </form>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<footer style="background-color: #1EE16C;
    width: 100%; text-align:center; padding: 14px; margin-top: 30px; color:white;" > @copyright by SayurVerse</footer>
    <!-- font awesome icon start-->
    <script src="https://kit.fontawesome.com/66b0a68b39.js" crossorigin="anonymous"></script>
    <!-- icon end -->
</body>

</html>