<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
    exit;
}

$kode_barang = $_POST["kode_barang"];
$nama_barang = $_POST["nama_barang"];
$jumlah = $_POST["jumlah"];
$satuan = $_POST["satuan"];
$kategori = $_POST["kategori"];
$status = $_POST["status"];
$harga = $_POST["harga"];

if ($_GET["op"] == "tambah") {
    $data = array(
        "kode" => $kode_barang,
        "nama" => $nama_barang,
        "jumlah" => $jumlah,
        "satuan" => $satuan,
        "kategori" => $kategori,
        "status" => $status,
        "harga" => $harga
    );

    $url = "https://project-akhir-g2wmaqjniq-uc.a.run.app/barang";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    curl_close($ch);
} elseif ($_GET["op"] == "edit") {
    $id = $_GET["id"];
    $data = array(
        "kode" => $kode_barang,
        "nama" => $nama_barang,
        "jumlah" => $jumlah,
        "satuan" => $satuan,
        "kategori" => $kategori,
        "status" => $status,
        "harga" => $harga
    );

    $url = "https://project-akhir-g2wmaqjniq-uc.a.run.app/barang/$id";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    curl_close($ch);
}

if ($result) {
    header("Location: ../inventaris.php");
    exit;
} else {
    echo "Gagal memproses permintaan.";
}
?>
