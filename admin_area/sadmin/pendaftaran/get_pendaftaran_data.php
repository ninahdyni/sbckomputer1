<?php
include "../koneksi.php";

if (isset($_POST['tahun'])) {
    $tahun = $_POST['tahun'];

    $query = "SELECT MONTH(tgl_pendaftaran) AS bulan,COUNT(*) AS jumlah 
        FROM pendaftaran 
        WHERE YEAR(tgl_pendaftaran) = $tahun 
        GROUP BY MONTH(tgl_pendaftaran)";

    $result = mysqli_query($conn, $query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'bulan' => $row['bulan'],
            'jumlah' => $row['jumlah']
        ];
    }

    echo json_encode($data);
}
