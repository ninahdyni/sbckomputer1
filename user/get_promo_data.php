<?php
include "koneksi.php";

if (isset($_POST['kode_promo'])) {
    $kodePromo = $_POST['kode_promo'];

    $query = "SELECT * FROM promo WHERE kode = '$kodePromo'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $promoData = mysqli_fetch_assoc($result);

        if ($promoData['terpakai'] < $promoData['batas']) {
            // Jika batas penggunaan kode promo belum tercapai
            // Maka Anda dapat menggunakannya
            $response = [
                'success' => true,
                'biaya' => $promoData['biaya_promo'],
                'id_program' => $promoData['id_program']
            ];
        } else {
            // Jika batas penggunaan kode promo sudah tercapai
            $response = ['success' => false, 'message' => 'Kode promo sudah mencapai batas penggunaan.'];
        }
    } else {
        $response = ['success' => false, 'message' => 'Kode promo tidak valid.'];
    }

    echo json_encode($response);
}
