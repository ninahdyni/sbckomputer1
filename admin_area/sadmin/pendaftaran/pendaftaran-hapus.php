<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id_bagian = $_GET["id"];

$query = "DELETE FROM pendaftaran WHERE id = $id_bagian";
$hapus = mysqli_query($conn, $query);

if ($hapus) {
    echo "<script>
            alert('Data Berhasil Dihapus');
            document.location.href = 'pendaftaran.php';
        </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            history.go(-1);
        </script>";
}
