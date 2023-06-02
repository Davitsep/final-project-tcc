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

    if ($response === false) {
        echo "Gagal mengirim permintaan ke API: " . curl_error($ch);
        exit;
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200) {
        header("Location: ../inventaris.php");
        exit;
    } else {
        echo "Gagal memproses permintaan: " . $httpCode;
        exit;
    }
} elseif ($_GET["op"] == "edit") {
    if (isset($_GET["id"])) {
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

        if ($response === false) {
            echo "Gagal mengirim permintaan ke API: " . curl_error($ch);
            exit;
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            header("Location: ../inventaris.php");
            exit;
        } else {
            echo "Gagal memproses permintaan: " . $httpCode;
            exit;
        }
    } else {
        echo "ID tidak ditemukan dalam parameter URL.";
        exit;
    }
} else {
    echo "Operasi tidak valid.";
    exit;
}
?>
