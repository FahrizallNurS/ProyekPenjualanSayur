<?php


require_once 'database.php';

$db = new Database();

if (isset($_GET['idPembayaran'])){

    $id = ($_GET["idPembayaran"]);

    "SELECT * FROM t_pembayaran WHERE idPembayaran=?";
$db->prepare($query);
    $statement->bind_param("i",$id);
    $statement->execute();

    $result = $statement->get_result();

    if($data = $result->fetch_assoc()){
        $idPembayaran = $data["idPembayaran"];
        $namaLengkap = $data["namaLengkap"];
        $alamat = $data["alamat"];
    }else{
        header("location:pembayaran1.hp");
    }

}else{
    header("location:pembayaran1.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <h1>Edit Data</h1>
    <div class="container">
        <form action="proses_editpembayaran.php" id="form_edit" method="post">
            <fieldset>
                <legend>Ubah Alamat</legend>
                <p>
                    <label for="namaLengkap">Nama lengkap : </label>
                    <input type="text" name="namaLengkap" id="namaLengkap" value="<?php echo $namaLengkap?>">
                </p>
                <p>
                    <label for="alamat"> Alamat: </label>
                    <input type="text" name="alamat" id="alamat" value="<?php echo $alamat?>">
                </p>
                <p>
                    <label for="JAM"> JAM: </label>
                    <input type="text" name="JAM" id="JAM" value="<?php echo $JAM?>">
                </p>
            </fieldset>
            <p>
                <input type="submit" name="edit" value="Update data">
            </p>
        </form>
    </div>
</body>
</html>