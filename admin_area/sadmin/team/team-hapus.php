<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id_bagian = $_GET["id"];

$query = "DELETE FROM team WHERE id_team = $id_bagian";
$hapus = mysqli_query($conn, $query);

if ($hapus) {
    echo "<script>
            alert('Data Berhasil Dihapus');
            document.location.href = 'team.php';
        </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            history.go(-1);
        </script>";
}
