<?php
    include "./database/connection.php";

    $kode = $_GET["kode_barang"];
    $sql = "DELETE FROM inventaris WHERE kode_barang = '$kode'";

    $result = $connect->query($sql);

    if($result) header("Location: ./inventaris.php");

?>