<?php
session_start();

include '../koneksi.php';

$query_registrasi = "SELECT 
registrasi.id_registrasi,
registrasi.status_regis,
user.foto,
user.nm_user,
user.email,
user.telp,
registrasi.foto_ktp,
registrasi.bukti_registrasi
FROM 
registrasi
INNER JOIN 
user ON registrasi.id_user = user.id_user";
$result_registrasi = mysqli_query($conn, $query_registrasi);

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
        <h4 align="center" style="margin-bottom: 20px;">REKAPITULASI DATA REGISTRASI</h4>
    </u>

    <table class="table indented-table">
        <thead>
            <tr>
                <th>Status</th>
                <th>Foto Pengguna</th>
                <th>Nama Pengguna</th>
                <th>Email</th>
                <th>Telpon</th>
                <th>Foto KTP</th>
                <th>Bukti Registrasi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row_registrasi = mysqli_fetch_assoc($result_registrasi)) { ?>
                <tr>
                    <td>
                        <?php if ($row_registrasi["status_regis"] == 2) { ?>
                            <span class="badge bg-light-success text-success w-100">Terkonfirmasi</span>
                        <?php } else if ($row_registrasi["status_regis"] == 1) { ?>
                            <span class="badge bg-light-danger text-danger w-100">Belum Terkonfirmasi</span>
                        <?php } else if ($row_registrasi["status_regis"] == 0) { ?>
                            <span class="badge bg-light-danger text-danger w-100">Data tidak ditemukan</span>
                        <?php } else {
                            echo '<span class="badge bg-light-danger text-danger w-100 text-left"><big>Data tidak ditemukan</big></span>';
                        } ?>
                    </td>
                    <td>
                        <img src="../assets/images/users/<?php echo $row_registrasi["foto"] ?>" alt="<?php echo $row_registrasi["foto"] ?>" width="50" class="rounded-circle p-1 border">
                    </td>
                    <td><?php echo $row_registrasi["nm_user"] ?></td>
                    <td><?php echo $row_registrasi["email"] ?></td>
                    <td><?php echo $row_registrasi["telp"] ?></td>
                    <td>
                        <a href="../assets/images/ktp/<?php echo $row_registrasi["foto_ktp"] ?>" target="_blank"><?php echo $row_registrasi["foto_ktp"] ?> <i class="lni lni-link"></i></a>
                    </td>
                    <td>
                        <a href="../assets/images/bukti_registrasi/<?php echo $row_registrasi["bukti_registrasi"] ?>" target="_blank"><?php echo $row_registrasi["bukti_registrasi"] ?> <i class="lni lni-link"></i></a>
                    </td>
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