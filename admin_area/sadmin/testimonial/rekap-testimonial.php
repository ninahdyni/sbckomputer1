<?php
session_start();

include '../koneksi.php';

$query_testimonial = "SELECT testimonial.id_testi, testimonial.komentar, user.nm_user, user.pekerjaan, user.foto, user.username FROM testimonial INNER JOIN user ON testimonial.id_user = user.id_user";
$result_testimonial = mysqli_query($conn, $query_testimonial);

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
        <h4 align="center" style="margin-bottom: 20px;">REKAPITULASI DATA TESTIMONIAL</h4>
    </u>

    <table class="table indented-table">
        <thead>
            <tr>
                <th>Foto Pengguna</th>
                <th>Username</th>
                <th>Nama Pengguna</th>
                <th>Pekerjaan</th>
                <th>Komentar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row_testimonial = mysqli_fetch_assoc($result_testimonial)) { ?>
                <tr>
                    <td>
                        <img src="../assets/images/users/<?php echo $row_testimonial["foto"] ?>" alt="<?php echo $row_testimonial["foto"] ?>" width="50" class="rounded-circle p-1 border">
                    </td>
                    <td><?php echo $row_testimonial["username"] ?></td>
                    <td><?php echo $row_testimonial["nm_user"] ?></td>
                    <td><?php echo $row_testimonial["pekerjaan"] ?></td>
                    <td style="white-space: normal;"><?php echo $row_testimonial["komentar"] ?></td>
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