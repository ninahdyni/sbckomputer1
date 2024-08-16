<?php

session_start();

if ($_SESSION["level"] != 1) {
    header("Location: logout.php");
    exit;
}

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id_users = $_GET["id"];
$password = '$2y$10$iwNGgqBvuEJynBRNa4buueQhq7e3zVSh4XifmsoN0SaeB06P/.6Zy';

$query = "UPDATE tbl_user SET password = '$password' WHERE id_user = $id_users ";
$edit = mysqli_query($conn, $query);

if ($edit) {
    echo "<script>
            alert('Password berhasil direset menjadi : admin');
            document.location.href = 'user.php';
        </script>";
} else {
    echo "<script>
            alert('Data gagal disimpan');
            history.go(-1);
        </script>";
}
