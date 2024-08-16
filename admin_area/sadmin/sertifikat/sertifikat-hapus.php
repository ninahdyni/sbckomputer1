<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id_sertifikat = $_GET["id"];

$query = "DELETE FROM sertifikat WHERE id_sertifikat = $id_sertifikat";
$hapus = mysqli_query($conn, $query);

if ($hapus) {
    echo "<script>
            alert('Data Berhasil Dihapus');
            document.location.href = 'sertifikat.php';
        </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            history.go(-1);
        </script>";
}
