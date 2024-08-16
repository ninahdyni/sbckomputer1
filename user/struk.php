<?php
session_start();

include "koneksi.php";

if (isset($_SESSION['id_user'])) {
    // Pengguna sudah login, lanjutkan menampilkan profil
    $id_user = $_SESSION['id_user'];
    // Tampilkan profil pengguna dengan ID $id_user
}


$id_user =  $_SESSION["id_user"];

$query_user = "SELECT * FROM user WHERE id_user = $id_user";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);

$query_users = "SELECT u.id_user, p.id, p.id_program, pr.nama_kelas, pr.biaya, pr.jenis_kelas, p.tanggal_mulai, pr.lama_pendidikan
                FROM user u
                LEFT JOIN pendaftaran p ON u.id_user = p.id_user
                LEFT JOIN program pr ON p.id_program = pr.id_program
                LEFT JOIN team t ON p.id_team = t.id_team
                WHERE u.id_user = $id_user
                ORDER BY p.tgl_pendaftaran DESC
                LIMIT 1";



$result_users = mysqli_query($conn, $query_users);

// Periksa apakah data ditemukan
if (mysqli_num_rows($result_users) > 0) {
    $row_users = mysqli_fetch_assoc($result_users);
} else {
    $row_users = false;
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur Pembayaran</title>
    <style>
        body {
            font-family: Calibri, Arial, sans-serif;
            font-size: 12pt;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 200px;
            /* Ukuran struk pada saat tampilan normal */
            margin: 0 auto;
            padding: 10px;
            box-sizing: border-box;
            /* Hindari overflow pada kertas thermal */
        }

        /* Gaya untuk saat pencetakan */
        @media print {
            .container {
                width: 57mm;
                /* Ukuran struk pada saat pencetakan */
                padding: 5mm;
                /* Padding yang disesuaikan untuk kertas thermal */
            }
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        /* CSS lainnya di sini */
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;'>
    <center>
        <table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='CENTER' vertical-align:top'><span style='color:black;'>
                    <b>LKP SBC KOMPUTER</b></br>
                    <small style='font-size:9pt'> Fanama Jl. Pondok Banjar Indah Permai No. 29, Pemurus Dalam, Kec. Banjarmasin Sel., Kota Banjarmasin, Kalimantan Selatan 70238
                    </small>
                </span></br>

                <span style='font-size:12pt'>No. : <?php echo $row_users["id"] ?>, <?php echo date("Y-m-d H:i:s") ?></span></br>
            </td>
        </table>
        <style>
            hr {
                display: block;
                margin-top: 0.5em;
                margin-bottom: 0.5em;
                margin-left: auto;
                margin-right: auto;
                border-style: inset;
                border-width: 1px;
            }
        </style>
        <table cellspacing='0' cellpadding='0' style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>
            <tr align='center'>
                <td width='25%'>Item</td>
                <td width='20%'>qty</td>
                <td width='20%'>Price</td>
            </tr>
            <tr>
                <td colspan='3'>
                    <hr>
                </td>
            </tr>
            <tr>
                <td style='vertical-align:top'><?php echo $row_users["nama_kelas"] ?></td>
                <td style='vertical-align:top; text-align:center;'>1</td>
                <td style='text-align:right; vertical-align:top'><?php echo $row_users["biaya"] ?></td>
            </tr>
            <tr>
                <td colspan='3'>
                    <hr>
                </td>
            </tr>
        </table>
        <table style='width:350; font-size:12pt;' cellspacing='2'>
            <tbody>
                <tr>
                    <td width=40%>Nama</td>
                    <td width=60% style='text-align:left; font-size:14pt; color:black;'>: <?php echo $row_user["nm_user"] ?></td>

                </tr>
                <tr>
                    <td>Nama Kelas</td>
                    <td style='text-align:left; font-size:14pt; color:black;'>: <?php echo $row_users["nama_kelas"] ?></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td style='text-align:left; font-size:14pt; color:black;'>: <?php echo $row_users["jenis_kelas"] ?></td>
                </tr>
                <tr>
                    <td>Mulai Tanggal</td>
                    <td style='text-align:left; font-size:14pt; color:black;'>: <?php echo $row_users["tanggal_mulai"] ?></td>
                    </td>
                </tr>
                <tr>
                    <td>Lama Pendidikan</td>
                    <td style='text-align:left; font-size:14pt; color:black;'>: <?php echo $row_users["lama_pendidikan"] ?></td>
                    </td>
                </tr>
            </tbody>
        </table>
        <table cellspacing='0' cellpadding='0' style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>

            <tr>
                <td colspan='2'>
                    <hr>
                </td>
            </tr>
            <tr>
                <td style='text-align:right; vertical-align:top'>Total</td>
                <td style='text-align:right; vertical-align:top'><?php echo $row_users["biaya"] ?> (Lunas)</td>
            </tr>

        </table>
        <table style='width:350; font-size:12pt;' cellspacing='2'>
            <tr></br>
                <td align='center'>****** TERIMAKASIH ******</br></td>
            </tr>
        </table>
        <table style='width:350; font-size:18pt;' cellspacing='2'>
            <tr></br>
                <td align='center'><u>LUNAS<u></br></td>
            </tr>
        </table>
    </center>
    <script>
        window.print();
    </script>
</body>

</html>