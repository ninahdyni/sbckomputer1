<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id_user = $_SESSION["id_admin"];

$query_user = "SELECT * FROM tbl_admin WHERE id_admin = $id_user";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);

$id_users = $_GET["id"];

$query_users = "SELECT 
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
LEFT JOIN team t ON p.id_team = t.id_team WHERE id = $id_users";
$result_users = mysqli_query($conn, $query_users);
$row_users = mysqli_fetch_assoc($result_users);

if (isset($_POST["submit"])) {
    $nm_user = htmlspecialchars($_POST["nm_user"]);
    $nm_user2 = htmlspecialchars($_POST["nm_user2"]);
    $nm_user3 = htmlspecialchars($_POST["nm_user3"]);
    $nm_user4 = htmlspecialchars($_POST["nm_user4"]);
    $tempat_lahir = htmlspecialchars($_POST["tempat_lahir"]);
    $tanggal_lahir = htmlspecialchars($_POST["tanggal_lahir"]);
    $email = htmlspecialchars($_POST["email"]);
    $telp = htmlspecialchars($_POST["telp"]);
    $telp2 = htmlspecialchars($_POST["telp2"]);
    $telp3 = htmlspecialchars($_POST["telp3"]);
    $telp4 = htmlspecialchars($_POST["telp4"]);
    $id_program = htmlspecialchars($_POST["id_program"]);
    $tanggal_mulai = htmlspecialchars($_POST["tanggal_mulai"]);
    $id_team = htmlspecialchars($_POST["id_team"]);
    $status_daftar = htmlspecialchars($_POST["status_daftar"]);
    if (isset($_POST["selected_schedule"])) {
        // $_POST["selected_schedule"] adalah array yang berisi jadwal kursus yang dipilih
        $selected_schedules = $_POST["selected_schedule"];

        // Lakukan sesuatu dengan data jadwal kursus yang dipilih
        // Misalnya, Anda bisa menyimpannya ke dalam database atau melakukan operasi lain yang Anda butuhkan.

        // Contoh: Menyimpan data ke dalam database
        $jadwal_kursus = implode(", ", $selected_schedules);

        // Kemudian Anda dapat menyimpan $jadwal_kursus ke dalam database
    } else {
        // Tidak ada jadwal kursus yang dipilih

    }

    $fotoLama = $_POST["fotoLama"];

    if ($_FILES["bukti_transfer"]["error"] === 4) {
        $foto = $fotoLama;
    } else {
        $namaFile = $_FILES["bukti_transfer"]["name"];
        $ukuranFile = $_FILES["bukti_transfer"]["size"];
        $error = $_FILES["bukti_transfer"]["error"];
        $tmpName = $_FILES["bukti_transfer"]["tmp_name"];

        $ekstensifotoValid = ["jpg", "jpeg", "png"];
        $ekstensifoto = pathinfo($namaFile, PATHINFO_EXTENSION);

        if (!in_array($ekstensifoto, $ekstensifotoValid)) {
            echo "<script>
            alert('Yang Anda upload bukan foto');
            history.go(-1);
            </script>";
            return false;
        }

        if ($ukuranFile > 1000000) {
            echo "<script>
            alert('Ukuran foto terlalu besar, maksimal 1 MB');
            history.go(-1);
            </script>";
            return false;
        }

        $namaFileBaru = uniqid() . '.' . $ekstensifoto;
        move_uploaded_file($tmpName, '../assets/images/bukti_transfer/' . $namaFileBaru);
        $foto = $namaFileBaru;
    }

    $query_user = "UPDATE user SET nm_user = '$nm_user', 
                    tempat_lahir = '$tempat_lahir', 
                    tanggal_lahir = '$tanggal_lahir', 
                    email = '$email', 
                    telp = '$telp', 
                    foto = '$foto' 
                    WHERE id_user = (SELECT id_user FROM pendaftaran WHERE id = '$id_users')";
    $update_user = mysqli_query($conn, $query_user);

    // Update data pada tabel 'pendaftaran'
    $query_pendaftaran = "UPDATE pendaftaran SET nm_user2 = '$nm_user2', 
                            nm_user3 = '$nm_user3', 
                            nm_user4 = '$nm_user4', 
                            telp2 = '$telp2', 
                            telp3 = '$telp3', 
                            telp4 = '$telp4', 
                            id_program = '$id_program', 
                            tanggal_mulai = '$tanggal_mulai', 
                            id_team = '$id_team', 
                            status_daftar = '$status_daftar', 
                            bukti_transfer = '$foto' 
                            WHERE id = '$id_users'";
    $update_pendaftaran = mysqli_query($conn, $query_pendaftaran);

    // Cek apakah kedua query berhasil dijalankan
    if ($update_user && $update_pendaftaran) {
        echo "<script>
            alert('Data berhasil diupdate');
            document.location.href = 'pendaftaran.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal disimpan');
            history.go(-1);
        </script>";
    }
}
?>

<!doctype html>
<html lang="en" class="<?php echo $row_user["theme"] ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="../assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="../assets/css/pace.min.css" rel="stylesheet" />
    <script src="../assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/app.css" rel="stylesheet">
    <link href="../assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="../assets/css/dark-theme.css" />
    <link rel="stylesheet" href="../assets/css/semi-dark.css" />
    <link rel="stylesheet" href="../assets/css/header-colors.css" />
    <title>Simawar - Tambah User</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        <?php include "../admin/include/theme-sidebar.php" ?>

        <?php include "../admin/include/theme-header.php" ?>

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="index.php"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item"><a href="user.php">Data User</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <h6 class="mb-0 text-uppercase">Data Pendaftaran</h6>
                        <hr />
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body px-5 pb-5">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bx-plus me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">Update Data Pendaftaran</h5>
                                </div>
                                <hr>
                                <form class="row g-3" method="POST" target="" enctype="multipart/form-data">
                                    <div class="col-12">
                                        <label for="username" class="form-label">Username :</label>
                                        <input type="text" class="form-control" name="username" id="username" value="<?php echo $row_users["username"] ?>" placeholder="Username 1 kata saja dan huruf kecil" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="nm_user" class="form-label">Nama Pengguna :</label>
                                        <input type="text" class="form-control" name="nm_user" id="nm_user" value="<?php echo $row_users["nm_user"] ?>" placeholder="Nama Lengkap dengan gelar" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="nm_user2" class="form-label">Nama Pengguna 2 :</label>
                                        <input type="text" class="form-control" name="nm_user2" id="nm_user2" value="<?php echo $row_users["nm_user2"] ?>" placeholder="Nama Lengkap dengan gelar">
                                    </div>
                                    <div class="col-12">
                                        <label for="nm_user3" class="form-label">Nama Pengguna 3 :</label>
                                        <input type="text" class="form-control" name="nm_user3" id="nm_user3" value="<?php echo $row_users["nm_user3"] ?>" placeholder="Nama Lengkap dengan gelar">
                                    </div>
                                    <div class="col-12">
                                        <label for="nm_user4" class="form-label">Nama Pengguna 4 :</label>
                                        <input type="text" class="form-control" name="nm_user4" id="nm_user4" value="<?php echo $row_users["nm_user4"] ?>" placeholder="Nama Lengkap dengan gelar">
                                    </div>
                                    <div class="col-12">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir :</label>
                                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?php echo $row_users["tempat_lahir"] ?>" placeholder="Tempat Lahir Pengguna" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir :</label>
                                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo $row_users["tanggal_lahir"] ?>" placeholder="Tanggal Lahir Pengguna" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email :</label>
                                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $row_users["email"] ?>" placeholder="Email Pengguna" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="telp" class="form-label">Telpon :</label>
                                        <input type="text" class="form-control" name="telp" id="telp" value="<?php echo $row_users["telp"] ?>" placeholder="Telpon Pengguna" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="telp2" class="form-label">Telpon 2 :</label>
                                        <input type="text" class="form-control" name="telp2" id="telp2" value="<?php echo $row_users["telp2"] ?>" placeholder="Telpon Pengguna">
                                    </div>
                                    <div class="col-12">
                                        <label for="telp3" class="form-label">Telpon 3 :</label>
                                        <input type="text" class="form-control" name="telp3" id="telp3" value="<?php echo $row_users["telp3"] ?>" placeholder="Telpon Pengguna">
                                    </div>
                                    <div class="col-12">
                                        <label for="telp4" class="form-label">Telpon 4 :</label>
                                        <input type="text" class="form-control" name="telp4" id="telp4" value="<?php echo $row_users["telp4"] ?>" placeholder="Telpon Pengguna">
                                    </div>

                                    <div class="col-12">
                                        <label for="id_program" class="form-label">Nama Program :</label>
                                        <select name="id_program" id="id_program" class="form-select" required>
                                            <option value="">Pilih Program...</option>
                                            <?php
                                            $query_program = "SELECT * FROM program";
                                            $result_program = mysqli_query($conn, $query_program);
                                            while ($row_program = mysqli_fetch_assoc($result_program)) {

                                            ?>
                                                <option value="<?php echo $row_program["id_program"] ?>" <?php if (!(strcmp($row_program["id_program"], htmlentities($row_users["id_program"], ENT_COMPAT, 'utf-8')))) {
                                                                                                                echo "SELECTED";
                                                                                                            } ?>><?php echo $row_program["nama_kelas"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label for="jenis_kelas" class="form-label">Jenis Kelas :</label>
                                        <select name="jenis_kelas" id="jenis_kelas" class="form-select" readonly>
                                            <option value="">--Pilih Jenis Kelas--</option>
                                            <option value="Private" <?php echo ($row_users["jenis_kelas"] == "Private") ? "selected" : "" ?>>Private</option>
                                            <option value="Reguler" <?php echo ($row_users["jenis_kelas"] == "Reguler") ? "selected" : "" ?>>Reguler</option>
                                        </select>
                                    </div>

                                    <label class="form-label" style="text-align: left; margin-left: 0px; font-weight: bold;">Pilih Jadwal Kursus: (Silahkan Pilih minimal 3 Jadwal Kursus)</label>

                                    <style>
                                        .form-check-label {
                                            display: flex;
                                            align-items: center;
                                            margin-right: 0px;
                                        }

                                        .form-check-input {
                                            margin: 0;
                                        }

                                        .hari {
                                            margin-left: 0px;
                                        }

                                        .jadwal {
                                            margin-left: 0px;
                                        }
                                    </style>

                                    <div>
                                        <?php
                                        $hari_jadwal = array(
                                            "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"
                                        );

                                        $jam_jadwal = array(
                                            "10.00-12.00", "14.00-16.00", "16.00-18.00", "19.30-21.30"
                                        );

                                        // Simulasi jadwal yang telah dipilih dari database
                                        $jadwal_kursus_db = explode(", ", $row_users["jadwal_kursus"]);

                                        foreach ($hari_jadwal as $hari) {
                                            echo '<div class="hari">' . $hari . '</div>';
                                            echo '<div class="jadwal">';
                                            foreach ($jam_jadwal as $jam) {
                                                echo '<div class="form-check form-check-inline">';
                                                $value = $hari . ': ' . $jam;
                                                $selected = in_array($value, $jadwal_kursus_db) ? 'checked' : '';
                                                echo '<input class="form-check-input" type="checkbox" name="selected_schedule[]" value="' . $value . '" ' . $selected . '>';
                                                echo '<label class="form-check-label"> ' . $jam . '</label>';
                                                echo '</div>';
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>


                                    <div class="col-12">
                                        <label for="tanggal_mulai" class="form-label" style="font-weight: bold;">Tanggal Mulai :</label>
                                        <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" value="<?php echo $row_users["tanggal_mulai"] ?>" placeholder="Tanggal Lahir Pengguna" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="lama_pendidikan" class="form-label">Lama Pendidikan :</label>
                                        <input type="text" class="form-control" name="lama_pendidikan" id="lama_pendidikan" value="<?php echo $row_users["lama_pendidikan"] ?>" placeholder="Lama Pendidikan" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="biaya" class="form-label">Biaya Program Kursus :</label>
                                        <input type="text" class="form-control" name="biaya" id="biaya" value="<?php echo $row_users["biaya"] ?>" placeholder="Biaya Program Kursus" readonly>
                                    </div>
                                    <div class="d-flex align-item-center">
                                        <img src="../assets/images/bukti_transfer/<?php echo $row_users["bukti_transfer"] ?>" width="90" height="100" alt="<?php echo $row_users["bukti_transfer"] ?>">
                                    </div>

                                    <div class="col-12">
                                        <label for="bukti_transfer" class="form-label">Upload Bukti Transfer :</label>
                                        <input class="form-control" type="file" name="bukti_transfer" id="bukti_transfer">
                                    </div>
                                    <small>File format .JPG .JPEG .PNG dengan ukuran maksimal 1 MB</small>

                                    <div class="col-12">
                                        <label for="id_team" class="form-label">Nama Pengajar :</label>
                                        <select name="id_team" id="id_team" class="form-select" required>
                                            <option value="">Pilih Pengajar...</option>
                                            <?php
                                            $query_team = "SELECT * FROM team";
                                            $result_team = mysqli_query($conn, $query_team);
                                            while ($row_team = mysqli_fetch_assoc($result_team)) {

                                            ?>
                                                <option value="<?php echo $row_team["id_team"] ?>" <?php if (!(strcmp($row_team["id_team"], htmlentities($row_users["id_team"], ENT_COMPAT, 'utf-8')))) {
                                                                                                        echo "SELECTED";
                                                                                                    } ?>><?php echo $row_team["nm_team"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Status Pendaftaran :</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_daftar" id="inlineRadio1" value="1" <?php echo ($row_users["status_daftar"] == 1) ? "checked" : "" ?>>
                                            <label class="form-check-label" for="inlineRadio1">Diproses</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_daftar" id="inlineRadio2" value="2" <?php echo ($row_users["status_daftar"] == 2) ? "checked" : "" ?>>
                                            <label class="form-check-label" for="inlineRadio2">Aktif</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="fotoLama" value="<?php echo $row_users["bukti_transfer"] ?>">
                                    <div class=" col-12">
                                        <button type="submit" class="btn btn-primary px-5" name="submit">Simpan</button>
                                        <button type="button" class="btn btn-secondary px-5" onclick="self.history.back()">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

        <?php include "../admin/include/theme-footer.php" ?>

        <!--end wrapper-->
        <!-- Bootstrap JS -->
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <!--plugins-->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
        <!--app JS-->
        <script src="../assets/js/app.js"></script>
</body>

</html>