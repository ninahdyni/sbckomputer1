<?php
include "koneksi.php";

if (isset($_POST['kode_promo'])) {
    $kodePromo = $_POST['kode_promo'];

    // Update nilai 'terpakai' di tabel promo
    $queryUpdate = "UPDATE promo SET terpakai = terpakai + 1 WHERE kode = '$kodePromo'";
    mysqli_query($conn, $queryUpdate);
}
