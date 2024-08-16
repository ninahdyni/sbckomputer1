<?php
session_start();

include '../koneksi.php';

$query_sertifikat = "SELECT 
    p.id,
    p.tanggal_mulai,
    u.nm_user,
    u.tempat_lahir,
    u.tanggal_lahir,
    u.telp,
    pr.nama_kelas,
    s.id_sertifikat,
    s.tanggal_selesai,
    s.file_sertifikat,
    s.keterangan
FROM 
    pendaftaran p
    INNER JOIN user u ON p.id_user = u.id_user
    INNER JOIN program pr ON p.id_program = pr.id_program
    LEFT JOIN sertifikat s ON p.id = s.id
WHERE
    p.tanggal_mulai IS NOT NULL
    AND s.id_sertifikat IS NOT NULL";

$result_sertifikat = mysqli_query($conn, $query_sertifikat) or die("Error: " . mysqli_error($conn));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CETAK</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <style>
        @media print {
            @page {
                size: landscape;
                margin: 10mm;
            }

            body {
                text-align: center;
            }

            table {
                border-collapse: collapse;
                margin: 0 auto;
                width: 90%;
                border: 1px solid #000;
            }

            table th,
            table td {
                border: 1px solid #000;
                padding: 8px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="text-center">
        <img src="../assets/images/users/kop.png" alt="" width="1200px" height="260px" class="mb-2" style="display: block; margin: 0 auto;">
    </div>
    <u>
        <h4 align="center" style="margin-bottom: 20px;">REKAPITULASI DATA PENDAFTARAN</h4>
    </u>

    <table class="table indented-table">
        <thead>
            <tr>
                <th>Keterangan</th>
                <th>Nama Pengguna</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Telpon</th>
                <th>Nama Kelas</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row_sertifikat = mysqli_fetch_assoc($result_sertifikat)) { ?>
                <tr>
                    <td>
                        <?php if ($row_sertifikat["keterangan"] == 2) { ?>
                            <span class="badge bg-light-success text-success w-100">Selesai</span>
                        <?php } else if ($row_sertifikat["keterangan"] == 0) { ?>
                            <span class="badge bg-light-danger text-danger w-100">Data tidak ditemukan</span>
                        <?php } else {
                            echo '<span class="badge bg-light-danger text-danger w-100 text-left"><big>Data tidak ditemukan</big></span>';
                        } ?>
                    </td>
                    <td><?php echo $row_sertifikat["nm_user"] ?></td>
                    <td><?php echo $row_sertifikat["tempat_lahir"] ?></td>
                    <td><?php echo $row_sertifikat["tanggal_lahir"] ?></td>
                    <td><?php echo $row_sertifikat["telp"] ?></td>
                    <td><?php echo $row_sertifikat["nama_kelas"] ?></td>
                    <td><?php echo $row_sertifikat["tanggal_mulai"] ?></td>
                    <td><?php echo $row_sertifikat["tanggal_selesai"] ?></td>
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