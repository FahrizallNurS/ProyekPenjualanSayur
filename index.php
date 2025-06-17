<?php
session_start();
require_once "database.php";

$db = (new Database())->connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['Email_Pengguna'];
    $password = $_POST['Password'];


    // Cek ADMIN
    $stmtAdmin = $db->prepare("SELECT * FROM t_admin WHERE Email_Admin = :email");
    $stmtAdmin->bindParam(':email', $email);
    $stmtAdmin->execute();
    $admin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['Password'])) {
        $_SESSION["Email_Admin" 
        ] = $email;
        $_SESSION["Id_Admin"] = $admin['Id_Admin']; // jika butuh
        header("Location:dashboard.php");
        exit();
    }

    $stmtUser = $db->prepare("SELECT * FROM t_pengguna WHERE Email_Pengguna = :email");
    $stmtUser->bindParam(':email', $email);
    $stmtUser->execute();
    $user = $stmtUser->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION["Email_Pengguna"] = $email;
        $_SESSION["Id_Pengguna"] = $user['Id_Pengguna'];
        header("Location:beranda.php");
        exit();
    }

    echo "<script>alert('Login gagal! Email atau Password salah.');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,
100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<style>
    body{
        height: auto;
    }
        .mainn{
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: center;
        }
        .login-container input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-container input[type="submit"] {
            background: #67e839;
            color: white;
            border: none;
            cursor: pointer;
        }
        .login-container input[type="submit"]:hover {
            background: #57c02b;
        }
        .login-container a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }
        .login-container a:hover {
            text-decoration: underline;
        }
   </style>
</head>
<body>
     <!-- main  -->
      <div class="mainn">
         <div class="login-container">
            <form method="post" action="index.php">
                <h2>Login</h2>
                <label for="Email_Pengguna">Masukkan E-mail:</label>
                <input type="email" id="Email_Pengguna" name="Email_Pengguna" required>
    
                <label for="Password">Masukkan Password:</label>
                <input type="password" id="Password" name="Password" required autocomplete="off">
    
                <input type="submit" name="tombol" value="Login">
            </form>
            
            <a href="daftar.php">Belum punya akun? Daftar di sini</a><br>
            <a href="lupapassword.php">Lupa Password?</a>
        </div>
    </div>
      </div>

      <footer>
        @copyrigt by Sayur Verse
      </footer>
       
        <!-- font awesome icon start-->
    <script src="https://kit.fontawesome.com/66b0a68b39.js" crossorigin="anonymous"></script>
    <!-- icon end -->
</body>
</html>