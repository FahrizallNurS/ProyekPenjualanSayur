<?php
require_once "database.php";
require_once "Query/Pengguna.php";

$db = (new Database())->connection();
$Pengguna = new Pengguna($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Pengguna->Nama_Pengguna = $_POST['Nama_Pengguna'];
    $Pengguna->Email_Pengguna = $_POST['Email_Pengguna'];
    $Pengguna->NoTelp_Pengguna = $_POST['NoTelp_Pengguna'];
    $Pengguna->Alamat_Pengguna = $_POST['Alamat_Pengguna'];
    $Pengguna->JenisKelamin = $_POST['JenisKelamin'];

    $email = $_POST['Email_Pengguna'];

 $stmt = $db->prepare("SELECT COUNT(*) FROM pengguna WHERE Email_Pengguna = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $jumlah = $stmt->fetchColumn();

    if($jumlah > 0){
        echo "<script>alert('email sudah ada'); window.location.href='daftar.php';</script>";
        exit();
    }
    
    $hashedPassword = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $Pengguna->Password = $hashedPassword;

    if ($Pengguna->memasukan()) {
        echo "<alert>alert('Pendaftaran berhasil!'); window.location.href='index.php';</alert>";
    } else {
        echo "<script>alert('Gagal!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,
100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<style>
   
    label{
        display: block;
        margin-bottom: 8px;
    }
    button{
        display: block;
        width: 100%;
        height: 30px;
        background: #67e839;
        color: white;
        border: none;
        cursor: pointer;
        margin-top: 20px;
        border-radius: 20px;
    }
    form input,textarea,select{
        width: 100%;
        padding: 8px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    button:hover{
        background-color: #2cd920;
    }

    body{
        height: auto;
    }
   </style>
</head>
<body>
    <!-- navbar -->

    <!-- navbar -end -->
     <!-- main  -->
    <article class="main">
        <form method="post">
            <h1 style="margin-bottom: 10px;">Selamat Datang</h1>
            <label for="Nama_Pengguna"> Nama</label>
            <input type="text" name="Nama_Pengguna" >
            <label for="Email_Pengguna"> Email</label>
            <input type="email" name="Email_Pengguna">
            <label for="NoTelp_Pengguna">No HP</label>
            <input type="number" name="NoTelp_Pengguna">
            <label for="Alamat_Pengguna">Alamat</label>
            <textarea name="Alamat_Pengguna"></textarea>
            <label for="JenisKelamin">Jenis Kelamin</label>
            <select name="JenisKelamin" id="JK">
                <option value="pilih disini">pilih disini</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <label for="Password">Password</label>
            <input type="password" name="Password" id="Password">
            <div class="button">
            <button type="submit">DAFTAR</button>  
            </div>
              <a href="index.php">Sudah punya akun? Login di sini</a>
          </form>     
        
    </article>
    </div>
        <!-- font awesome icon start-->
    <script src="https://kit.fontawesome.com/66b0a68b39.js" crossorigin="anonymous"></script>
    <!-- icon end -->
</body>
</html>