<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
    exit;
}

$id = "";
$kode_barang = "";
$nama_barang = "";
$jumlah = "";
$satuan = "";
$kategori = "";
$status = "";
$harga = "";

if (isset($_GET["op"])) {
    if ($_GET["op"] == "edit") {
        $judul = "Ubah Data Inventaris";
        $button = "Ubah";
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $url = "https://project-akhir-g2wmaqjniq-uc.a.run.app/barang";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$data = json_decode($response, true);
curl_close($ch);

if ($data) {
    // Ambil data pertama dari array
    $firstData = $data[$id-1];
    $kode_barang = $firstData["kode"];
    $nama_barang = $firstData["nama"];
    $jumlah = $firstData["jumlah"];
    $satuan = $firstData["satuan"];
    $kategori = $firstData["kategori"];
    $status = $firstData["status"];
    $harga = $firstData["harga"];
} else {
    echo "Gagal mengambil data dari API.";
}            
        } else {
            echo "ID tidak ditemukan dalam parameter URL.";
        }
    } else {
        $button = "Simpan";
        $judul = "Tambah Data Inventaris";
    }
}
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

    <form action="./database/input_process.php?op=<?= $_GET["op"] ?? "" ?>&id=<?= $id ?>" method="POST" enctype="multipart/form-data" class="form_add_inventaris">
        <div class="form_add_inventaris_title">
            <h3><?= $judul ?></h3>
        </div>
        <div class=" mb-3 row">
            <label for="kode_barang" class="col-sm-2 col-form-label">Kode Barang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Kode Barang" value="<?= $kode_barang ?>">
            </div>
        </div>
        <div class=" mb-3 row">
            <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" value="<?= $nama_barang ?>">
            </div>
        </div>
        <div class=" mb-3 row">
            <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah" value="<?= $jumlah ?>">
            </div>
        </div>
        <div class=" mb-3 row">
            <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan" value="<?= $satuan ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-6">
                <select class="form-select" id="kategori" name="kategori">
                    <option value="Bangunan" <?php if ($kategori == "Bangunan") echo "selected" ?>>Bangunan</option>
                    <option value="Kendaraan" <?php if ($kategori == "Kendaraan") echo "selected" ?>>Kendaraan</option>
                    <option value="Alat Tulis Kantor" <?php if ($kategori == "Alat Tulis Kantor") echo "selected" ?>>Alat Tulis Kantor</option>
                    <option value="Elektronik" <?php if ($kategori == "Elektronik") echo "selected" ?>>Elektronik</option>
                </select>
            </div>
        </div>
        <div class=" mb-3 row">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="baik" value="baik" <?php if ($status == "baik") echo "checked" ?>>
                    <label class="form-check-label" for="baik">Baik</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="perawatan" value="perawatan" <?php if ($status == "perawatan") echo "checked" ?>>
                    <label class="form-check-label" for="perawatan">Perawatan</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="rusak" value="rusak" <?php if ($status == "rusak") echo "checked" ?>>
                    <label class="form-check-label" for="rusak">Rusak</label>
                </div>
            </div>
        </div>
        <div class=" mb-3 row">
            <label for="harga" class="col-sm-2 col-form-label">Harga Satuan</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Satuan" value="<?= $harga ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <span class="col-sm-2"></span>
            <div class="col-sm-10">
                <input type="submit" name="simpan" value="<?= $button ?>" class="btn btn-primary">
                <a href="./inventaris.php" class="btn btn-danger ms-1">Batal</a>
            </div>
        </div>
    </form>
</body>

</html>
