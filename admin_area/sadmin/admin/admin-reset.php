<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id_users = $_GET["id"];
$password = '$2y$10$iwNGgqBvuEJynBRNa4buueQhq7e3zVSh4XifmsoN0SaeB06P/.6Zy';

$query = "UPDATE tbl_admin SET password = '$password' WHERE id_admin = $id_users ";
$edit = mysqli_query($conn, $query);

if ($edit) {
    echo "<script>
            alert('Password berhasil direset menjadi : admin');
            document.location.href = 'admin.php';
        </script>";
} else {
    echo "<script>
            alert('Data gagal disimpan');
            history.go(-1);
        </script>";
}
