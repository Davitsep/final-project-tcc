<?php
$id = $_GET["id"];
$nama_barang = $_GET["nama_barang"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Inventaris Berbasis Web</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="form_add_inventaris">
        <div class="form_add_inventaris_title">
            <h3>Hapus Data Inventaris</h3>
        </div>
        <h4>Yakin Ingin Menghapus <?php echo $nama_barang ?> ?</h4>
        <br>
        <a href="./delete_inventaris.php?id=<?= $id ?>"><button type="button" class="btn btn-danger">Hapus</button></a>
        <a href="./inventaris.php?"><button type="button" class="btn btn-secondary ms-1">Batal</button></a>
    </div>

</body>

</html>