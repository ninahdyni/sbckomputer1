<?php
session_start();

include '../koneksi.php';



$query_promo = "SELECT promo.*, program.nama_kelas 
                                            FROM promo 
                                            INNER JOIN program ON promo.id_program = program.id_program";
$result_promo = mysqli_query($conn, $query_promo);
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
        <h4 align="center" style="margin-bottom: 20px;">REKAPITULASI DATA PROMO</h4>
    </u>

    <table class="table indented-table">
        <thead>
            <tr>
                <th>Judul Promo</th>
                <th>Kelas Promo</th>
                <th>kode Promo</th>
                <th>Pesan 1</th>
                <th>Pesan 2</th>
                <th>Biaya Promo</th>
                <th>Batas</th>
                <th>Terpakai</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row_promo = mysqli_fetch_assoc($result_promo)) {
            ?>
                <tr>
                    <td><?php echo $row_promo['judul']; ?></td>
                    <td><?php echo $row_promo['nama_kelas']; ?></td>
                    <td><b><?php echo $row_promo['kode']; ?></b></td>
                    <td>
                        <pre style='white-space: pre-wrap;'><?php echo $row_promo['pesan1']; ?></pre>
                    </td>
                    <td>
                        <pre style='white-space: pre-wrap;'><?php echo $row_promo['pesan2']; ?></pre>
                    </td>
                    <td><?php echo $row_promo['biaya_promo']; ?></td>
                    <td><span class='badge bg-light-success text-success w-100'><?php echo $row_promo['batas']; ?></span></td>
                    <td><span class='badge bg-light-danger text-danger w-100'><?php echo $row_promo['terpakai']; ?></span></td>

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