<?php
session_start();
if (!isset($_SESSION["Email_Pengguna"])) {
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,
100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<style>
    *{
        margin: 0;
    }

/* Tombol submit */
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
.sayuran{
    width: 330px;
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
    <article class="main">
        <div class="beranda">
            <div class="card">
                  <p>Produk oganik asli 100%</p>
            <h1><span>Organik</span> & Menyehatkan <br> Untuk <span>Kebutuhan</span> Harian Anda</h1>
            <button class="belanja">Belanja</button>
            </div>
          

            <div class="produkkami">
                <h1>Produk Kami</h1>
                <div class="menu-card">
                    <img src="gambar/qortell 1.png" alt="Wortel">
                </div>
                <div class="menu-card">
                    <img src="gambar/sawiHijau 1.png" alt="Wortel">
                </div>
                <div class="menu-card">
                    <img src="gambar/rawitmer 1.png" alt="Wortel">
                </div>
                <div class="panah">
                    <a href="produk.html"><i class="fa-solid fa-arrow-right"></i></a>
                    <p>Selengkapnya</p>
                </div>
            </div>
        </div>
        <div class="shape"><img src="gambar/peoplewithvgtbl 1.png" alt="petani"></div>

    </article>
    <div class="container-why">
        <h1>Mengapa Belanja di <span class="Hijau">Sayur</span><span class="verse">Verse?</span></h1>
        <div class="why">
        <div class="rectangle">
            <img src="gambar/icon.png" alt="icon1">
            <h3>Pembayaran cepat <br> dan aman</h3>
        </div>
        <div class="rectangle">
            <img src="gambar/icon2.png" alt="icon2">
            <h3>Sayuran segar <br> dan organik</h3>
        </div>
        <div class="rectangle">
            <img src="gambar/icon3.png" alt="icon3">
            <h3>Pengiriman cepat <br>dan tepat waktu</h3>
        </div>
        <div class="rectangle">
            <img src="gambar/icon4.png" alt="icon4">
            <h3>Praktis dan Cepat</h3>
        </div>
    </div>
    </div>
    <div class="rowww">
        <h1 style="margin-top:100px; margin-bottom: -200px;">Pilihan Favorit</h1>
             <div class="favorit">
            <div class="sayuran">
                <img src="gambar/Kol.png" width="222px" height="222px" alt="Sawi Hijau">
                <h2>Kol putih <br>1kg <br><span>Rp.10.000</span></h2>
            </div>
          
            <div class="sayuran">
                <img src="gambar/SawiHijau1.png" width="222px" height="222px" alt="Sawi Hijau">
                <h2>Sawi Hijau <br>1kg <br><span>Rp.10.000</span></h2>
            </div>
           <div class="sayuran">
                 <img src="gambar/rawitmer 1.png" width="222px" height="222px" alt="Sawi Hijau">
                 <h2>Rawit Merah <br>1kg <br><span>Rp.60.000</span></h2>
             </div>
           <div class="sayuran">
                 <img src="gambar/bawangmerah.png" width="222px" height="222px" alt="bawangmerah">
                 <h2>Bawang Merah <br>1kg <br><span>Rp.40.000</span></h2>
             </div>

    </div>
</div>
<footer style="background-color: #1EE16C;
    width: 100%; text-align:center; padding: 14px; margin-top: 30px; color:white;" > @copyright by SayurVerse</footer>
    <!-- font awesome icon start-->
    <script src="https://kit.fontawesome.com/66b0a68b39.js" crossorigin="anonymous"></script>
    <!-- icon end -->
</body>

</html>