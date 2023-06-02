<?php

$id = $_GET["id"];
$url = "https://project-akhir-g2wmaqjniq-uc.a.run.app/barang/$id";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode == 200) {
    header("Location: ./inventaris.php");
    exit;
} else {
    echo "Gagal menghapus data.";
}
?>
