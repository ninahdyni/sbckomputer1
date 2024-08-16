<style>
    * {
        font-family: 'Times New Roman', Times, serif;
        font-size: 20px;
    }

    table {
        border-collapse: collapse;
        border-color: white;
    }

    table-page {
        border-collapse: collapse;
        border-color: black;
    }

    td {
        padding: 5px;
        /* Mengatur jarak atas dan bawah antara baris */
    }
</style>

<div class="text-center">
    <img src="../assets/images/users/kop.png" alt="" width="820px" height="260px" class="mb-2" style="display: block; margin: 0 auto;">
</div>
<h1 align="center"><u>ABSEN PESERTA DIDIK</u></h1>
<div class="table-responsive mt-3">

    <table border="1" width="90%" align="left" cellpadding="8" style="margin-left: 10px;">
        <tbody>
            <?php
            $id = $_GET['id'];
            // $id = 11;
            include "../koneksi.php";
            $query = mysqli_query($conn, "SELECT 
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
            t.nm_team                            
        FROM 
            pendaftaran p 
            LEFT JOIN user u ON p.id_user = u.id_user
            LEFT JOIN program pr ON p.id_program = pr.id_program
            LEFT JOIN team t ON p.id_team = t.id_team WHERE id = $id");
            while ($data = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td width=25%><b> Program kursus</b></td>
                    <td width=75%><b>: <?php echo $data['nama_kelas'] ?></b></td>

                </tr>
                <tr>
                    <td><b>Kelas</b></td>
                    <td><b>: <?php echo $data['jenis_kelas'] ?></b></td>
                </tr>
                <tr>
                    <td><b>Mulai Tanggal</b></td>
                    <td><b>: <?php echo $data['tanggal_mulai'] ?></b></td>
                    </b></td>
                </tr>

                <tr>
                    <td><b>Jadwal Kursus</b></td>
                    <td><b>: <?php echo $data['jadwal_kursus'] ?></b></td>
                </tr>

                <?php
                $peserta = array();

                if (!empty($data['nm_user'])) {
                    $peserta[] = $data['nm_user'];
                }

                if (!empty($data['nm_user2'])) {
                    $peserta[] = '&nbsp;&nbsp;2. ' . $data['nm_user2'];
                }

                if (!empty($data['nm_user3'])) {
                    $peserta[] = '&nbsp;&nbsp;3. ' . $data['nm_user3'];
                }

                if (!empty($data['nm_user4'])) {
                    $peserta[] = '&nbsp;&nbsp;4. ' . $data['nm_user4'];
                }

                if (count($peserta) > 1) {
                    $peserta_label = implode('<br>', $peserta);
                    echo '<tr>
            <td><b>Nama Peserta</b></td>
            <td><b>: 1. ' . $peserta_label . '</b></td>
          </tr>';
                } elseif (count($peserta) == 1) {
                    echo '<tr>
            <td><b>Nama Peserta</b></td>
            <td><b>: ' . $data['nm_user'] . '</b></td>
          </tr>';
                }
                ?>

                <?php
                $peserta = array();

                if (!empty($data['telp'])) {
                    $peserta[] = $data['telp'];
                }

                if (!empty($data['telp2'])) {
                    $peserta[] = '&nbsp;&nbsp;2. ' . $data['telp2'];
                }

                if (!empty($data['telp3'])) {
                    $peserta[] = '&nbsp;&nbsp;3. ' . $data['telp3'];
                }

                if (!empty($data['telp4'])) {
                    $peserta[] = '&nbsp;&nbsp;4. ' . $data['telp4'];
                }

                if (count($peserta) > 1) {
                    $peserta_label = implode('<br>', $peserta);
                    echo '<tr>
            <td><b>No HP</b></td>
            <td><b>: 1. ' . $peserta_label . '</b></td>
          </tr>';
                } elseif (count($peserta) == 1) {
                    echo '<tr>
            <td><b>No HP</b></td>
            <td><b>: ' . $data['telp'] . '</b></td>
          </tr>';
                }
                ?>
                <tr>
                    <td><b>Instruktur</b></td>
                    <td><b>: <?php echo $data['nm_team'] ?></b></td>
                </tr>

        </tbody>
    </table>
    <br></br>
    <br></br>
    <br></br>
    <br></br>

    <div class="text-center mb-3">
        <?php
                if ($data['nama_kelas'] == 'Web Master') {
                    echo '<img src="../assets/images/users/tabel_20.png" alt="" width="820px" height="450px" class="mb-2" style="display: block; margin: 0 auto;">';
                } elseif ($data['nama_kelas'] == 'Komputer Akuntansi') {
                    echo '<img src="../assets/images/users/tabel_10.png" alt="" width="890px" class="mb-2" style="display: block; margin: 0 auto;">';
                } else {
                    echo '<img src="../assets/images/users/tabel.png" alt="" width="890px" class="mb-2" style="display: block; margin: 0 auto;">';
                }
        ?>
    </div>

    <div style="padding-left: 10px;">
        <p><b>Catatan: </b></p>
    </div>


    <div style="text-align: right; margin-right: 40px;">
        <img src="../assets/images/users/qr-kode.png" alt="" width="80px" class="mb-2" style="margin: 0;">
    </div>

</div>
<?php
            }
?>
<script>
    window.print();
</script>