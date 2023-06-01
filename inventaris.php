<?php
session_start();
if (!isset($_SESSION['username'])) header("location:index.php");
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

    <?php include "./component/navbar.php" ?>

    <div class="add_inventaris">
        <a href="./add_inventaris.php?op=tambah">+ Tambah</a>
    </div>

    <div class="table_inventaris">
        <table class="table">
            <thead>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                <?php
                $api_url = "https://project-akhir-g2wmaqjniq-uc.a.run.app/barang";
                $data = file_get_contents($api_url);
                $inventaris = json_decode($data, true);
                foreach ($inventaris as $no => $data) {
                ?>
                    <tr>
                        <td><?= $no + 1 ?></td>
                        <td><?= $data["kode"] ?></td>
                        <td><?= $data["nama"] ?></td>
                        <td><?= $data["jumlah"] ?></td>
                        <td><?= $data["satuan"] ?></td>
                        <td><?= $data["kategori"] ?></td>
                        <td><?= $data["status"] ?></td>
                        <td><?= "Rp. " . number_format($data["harga"], 0, ',', '.') . ",00" ?></td>
                        <td><?= "Rp. " . number_format(($data["harga"] * $data["jumlah"]), 0, ',', '.') . ",00" ?></td>
                        <td>
                            <a href="./add_inventaris.php?op=edit&id=<?= $data["id"] ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                            <a href="./hapus.php?kode_barang=<?= $data["kode"] ?>"><button type="button" class="btn btn-danger ms-1">Delete</button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <p class="total_inventaris"><?php
                                $api_url = "https://project-akhir-g2wmaqjniq-uc.a.run.app/barang";
                                $data = file_get_contents($api_url);
                                $inventaris = json_decode($data, true);
                                $total = 0;
                                foreach ($inventaris as $data) {
                                    $total += $data["harga"] * $data["jumlah"];
                                }
                                echo "Total inventaris = Rp. " . number_format($total, 0, ',', '.') . ",00";
                                ?></p>


    <?php include "./component/footer.php" ?>
</body>

</html>
