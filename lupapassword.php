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
         .mainn{
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        fieldset {
            border: none;
        }
        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #00ff04c0;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #00b336;
        }
   </style>
</head>
<body>
    <!-- navbar -->
    <!-- navbar -end -->
     <!-- main  -->
      <div class="mainn">
        <form method="post" >
            <fieldset>
                <h2>Lupa Password</h2>
                <label for="Email_Pengguna">Masukkan Email Anda:</label><br>
                <input type="email" id="Email_Pengguna" name="Email_Pengguna" required autocomplete="email"><br>
                <input type="submit" name="tombol" value="Kirim Reset Password">
            </fieldset>
        </form>
      </div>
       
        <!-- font awesome icon start-->
    <script src="https://kit.fontawesome.com/66b0a68b39.js" crossorigin="anonymous"></script>
    <!-- icon end -->
</body>
</html>

<?php
require_once "database.php";

$db = (new Database())->connection();
if(isset($_SESSION['Email_Pengguna']) != ''){
    header("location:index.php");
    exit();
}

$error = "";
$sukses = "";
$email = "";

if(isset($_POST['tombol'])){
    $email = $_POST['Email_Pengguna'];
    if($email == ''){
        $error = "Silakan masukan email";
    }else{
        $sql1 = "SELECT * FROM pengguna WHERE Email_Pengguna = '$email'";
        $qi = mysqli_query($db,$sql1);
        $n1 = mysqli_num_rows($q1);

        if($n1 < 1){
            $err = "Email: <br> $email </b> tidak ditemukan";
        }
    }

    if(empty($error)){
        $token = md5(rand(0,500));
        $judul_email = "Ganti Password";
        $isi_email = "Ada orang meminta mengubah password klik dibawah ini <br>";
        $isi_email .= url_dasar(). "/ganti_password.php?Email_Pengguna=$email&token_ganti=$token";
        kirim_email($email,$email,$judul_email,$isi_email);

        $sql1 = "UPDATE pengguna set token_ganti = '$token' WHERE Email_Pengguna = ''$email' ";
        mysqli_query($db,$sql1);
        $sukses = "Link ganti sudah dikirim";
    }
}
?>
<?php if($err){
    echo "Error $err";
}
?>
<?php if($sukses){
    echo "$sukses";
}
?>