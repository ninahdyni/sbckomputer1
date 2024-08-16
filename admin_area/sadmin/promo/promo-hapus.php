<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id_user = $_GET["id"];

$query = "DELETE FROM promo WHERE id_promo = $id_user";
$hapus = mysqli_query($conn, $query);

if ($hapus) {
    echo "<script>
            alert('Data Berhasil Dihapus');
            document.location.href = 'promo.php';
        </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            history.go(-1);
        </script>";
}
