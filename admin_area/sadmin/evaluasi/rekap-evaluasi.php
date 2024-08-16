<?php
session_start();

include '../koneksi.php';

$query_evaluasi = "SELECT
    e.id_evaluasi,
    e.platform,
    p.id,
    u.nm_user,
    u.telp
FROM
    evaluasi e
INNER JOIN
    pendaftaran p ON e.id = p.id
INNER JOIN
    user u ON p.id_user = u.id_user";

$result_evaluasi = mysqli_query($conn, $query_evaluasi);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CETAK</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <script>
        window.print()
    </script>

    <style>
        @media print {
            @page {
                size: landscape;
                margin: 10mm;
                /* Menambahkan margin 10mm di setiap sisi */
            }

            body {
                text-align: center;
            }

            table {
                border-collapse: collapse;
                margin: 0 auto;
                width: 90%;
                /* Lebarkan tabel agar tidak keluar dari kertas saat dicetak */
                border: 1px solid #000;
            }

            table th,
            table td {
                border: 1px solid #000;
                padding: 8px;
                font-size: 14px;
                /* Ubah ukuran font untuk lebih sesuai dengan kebutuhan cetak */
            }
        }
    </style>
</head>

<body>
    <div class="text-center">
        <img src="../assets/images/users/kop.png" alt="" width="1200px" height="260px" class="mb-2" style="display: block; margin: 0 auto;">
    </div>
    <u>
        <h4 align="center" style="margin-bottom: 20px;">REKAPITULASI DATA EVALUASI SOSIAL MEDIA</h4>
    </u>

    <table class="table indented-table">
        <thead>
            <tr>
                <th>Nama Pengguna</th>
                <th>Telpon</th>
                <th>Platform</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row_evaluasi = mysqli_fetch_assoc($result_evaluasi)) { ?>
                <tr>
                    <td><?php echo $row_evaluasi["nm_user"] ?></td>
                    <td><?php echo $row_evaluasi["telp"] ?></td>
                    <td><?php echo $row_evaluasi["platform"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php
    setlocale(LC_TIME, 'id_ID');
    $tanggal_permohonan = new DateTime();
    $bulan_indonesia = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember',
    ];
    ?>

    <p align='right'>
        Banjarmasin, <?php echo str_replace(array_keys($bulan_indonesia), $bulan_indonesia, $tanggal_permohonan->format('d F Y')); ?>
        <br>
        Direktur,
    </p><br><br><br>
    <p style="text-align: right; margin-right: 0px;">
        <u>Herry Adi Chandra, S.Kom., M.Kom</u>
    </p>
</body>

</html>