<?php
session_start();

include '../koneksi.php';

$query_pendaftaran = "SELECT 
p.id, 
p.id_program,
p.nm_user2,
p.nm_user3,
p.nm_user4,
p.telp2,
p.telp3,
p.telp4, 
p.jadwal_kursus, 
p.status_daftar, 
p.bukti_transfer,
pr.nama_kelas, 
pr.biaya, 
pr.jenis_kelas, 
p.tanggal_mulai, 
pr.lama_pendidikan,
u.id_user,
u.username,
u.nm_user,
u.tempat_lahir,
u.tanggal_lahir,
u.email,
u.telp,
u.foto,                            
t.id_team,                            
t.nm_team                            
FROM 
pendaftaran p 
LEFT JOIN user u ON p.id_user = u.id_user
LEFT JOIN program pr ON p.id_program = pr.id_program
LEFT JOIN team t ON p.id_team = t.id_team ORDER BY id DESC";
$result_pendaftaran = mysqli_query($conn, $query_pendaftaran);

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
        <h4 align="center" style="margin-bottom: 20px;">REKAPITULASI DATA PENDAFTARAN</h4>
    </u>

    <table class="table indented-table">
        <thead>
            <tr>
                <th>Status</th>
                <th>Pilihan Kelas</th>
                <th>Jenis Kelas</th>
                <th>Tanggal Mulai</th>
                <th>Jadwal Kursus</th>
                <th>Username</th>
                <th>Nama Pengguna</th>
                <th>Tempat/Tanggal Lahir</th>
                <th>Email</th>
                <th>Telpon</th>
                <th>Lama Pendidikan</th>
                <th>Biaya Kursus</th>
                <th>Nama Pengajar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row_pendaftaran = mysqli_fetch_assoc($result_pendaftaran)) { ?>
                <tr>
                    <td>
                        <?php if ($row_pendaftaran["status_daftar"] == 2) { ?>
                            <span class="badge bg-light-success text-success w-100">Aktif</span>
                        <?php } else if ($row_pendaftaran["status_daftar"] == 1) { ?>
                            <span class="badge bg-light-warning text-warning w-100">Diproses</span>
                        <?php } else if ($row_pendaftaran["status_daftar"] == 0) { ?>
                            <span class="badge bg-light-danger text-danger w-100">Data tidak ditemukan</span>
                        <?php } else {
                            echo '<span class="badge bg-light-danger text-danger w-100 text-left"><big>Data tidak ditemukan</big></span>';
                        } ?>
                    </td>
                    <td><?php echo $row_pendaftaran["nama_kelas"] ?></td>
                    <td><?php echo $row_pendaftaran["jenis_kelas"] ?></td>
                    <td><?php echo $row_pendaftaran["tanggal_mulai"] ?></td>
                    <td><?php echo $row_pendaftaran["jadwal_kursus"] ?></td>
                    <td><?php echo $row_pendaftaran["username"] ?></td>
                    <td><?php echo $row_pendaftaran["nm_user"] ?>,
                        <?php echo $row_pendaftaran["nm_user2"] ?>,
                        <?php echo $row_pendaftaran["nm_user3"] ?>,
                        <?php echo $row_pendaftaran["nm_user4"] ?></td>
                    <td><?php echo $row_pendaftaran["tempat_lahir"] ?>/<?php echo $row_pendaftaran["tanggal_lahir"] ?></td>
                    <td><?php echo $row_pendaftaran["email"] ?></td>
                    <td><?php echo $row_pendaftaran["telp"] ?>,
                        <?php echo $row_pendaftaran["telp2"] ?>,
                        <?php echo $row_pendaftaran["telp3"] ?>,
                        <?php echo $row_pendaftaran["telp4"] ?>,
                    </td>
                    <td><?php echo $row_pendaftaran["lama_pendidikan"] ?></td>
                    <td><?php echo $row_pendaftaran["biaya"] ?></td>

                    <td><?php echo $row_pendaftaran["nm_team"] ?></td>
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