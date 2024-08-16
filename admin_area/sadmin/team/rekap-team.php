<?php
session_start();

include '../koneksi.php';

$query_team = "SELECT T.*, B.nm_bagian FROM team T LEFT JOIN bagian B ON T.id_bagian = B.id_bagian ORDER BY T.id_team DESC";
$result_team = mysqli_query($conn, $query_team);

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
        <h4 align="center" style="margin-bottom: 20px;">REKAPITULASI DATA PENGAJAR</h4>
    </u>

    <table class="table indented-table">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama Pengajar</th>
                <th>NIK</th>
                <th>Bagian</th>
                <th>Email</th>
                <th>Telpon</th>
                <th>WhatsApp</th>
                <th>Instagram</th>
                <th>Twitter</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row_team = mysqli_fetch_assoc($result_team)) { ?>
                <tr>
                    <td> <img src="../assets/images/team/<?php echo $row_team["foto_team"] ?>" alt="<?php echo $row_team["foto_team"] ?>" width="50" class="rounded-circle p-1 border">
                    </td>
                    <td><?php echo $row_team["nm_team"] ?></td>
                    <td><?php echo $row_team["nik"] ?></td>
                    <td><?php echo $row_team["nm_bagian"] ?></td>
                    <td><?php echo $row_team["email_team"] ?></td>
                    <td><?php echo $row_team["telp_team"] ?></td>
                    <td><?php echo $row_team["whatsapp"] ?></td>
                    <td><?php echo $row_team["instagram"] ?></td>
                    <td><?php echo $row_team["twitter"] ?></td>
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