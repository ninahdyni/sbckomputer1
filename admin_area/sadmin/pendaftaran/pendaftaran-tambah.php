<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id_user =  $_SESSION["id_admin"];

$query_user = "SELECT * FROM tbl_admin WHERE id_admin = $id_user";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);

if (isset($_POST["submit"])) {

    $username = htmlspecialchars($_POST["username"]);
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
    $tgl_pendaftaran = htmlspecialchars($_POST["tgl_pendaftaran"]);
    $selectedSchedules = $_POST["selected_schedule"];

    // Pastikan ada jadwal yang dipilih sebelum menyimpan ke database
    if (!empty($selectedSchedules)) {
        // Gabungkan jadwal kursus yang dipilih menjadi satu string (misalnya, dengan koma sebagai pemisah)
        $selectedSchedulesString = implode(', ', $selectedSchedules);
        // Pengecekan apakah file telah dipilih
        if (isset($_FILES["bukti_transfer"])) {
            $namaFile = $_FILES["bukti_transfer"]["name"];
            $typeFile = $_FILES["bukti_transfer"]["type"];
            $ukuranFile = $_FILES["bukti_transfer"]["size"];
            $tmpName = $_FILES["bukti_transfer"]["tmp_name"];

            $upload_directory = '../assets/images/bukti_transfer/';

            // Check for file upload errors
            if ($_FILES["bukti_transfer"]["error"] !== 0) {
                die("Terjadi kesalahan saat mengunggah file: " . $_FILES["bukti_transfer"]["error"]);
            }

            // Check file type
            $allowedTypes = array("image/jpeg", "image/jpg", "image/png");
            if (!in_array($typeFile, $allowedTypes)) {
                die("Format file tidak didukung. Gunakan format JPG, JPEG, atau PNG.");
            }

            // Check file size (1MB)
            if ($ukuranFile > 1048576) {
                die("Ukuran file terlalu besar. Maksimum 1MB.");
            }

            $upload_path = $upload_directory . $namaFile;
            if (move_uploaded_file($tmpName, $upload_path)) {

                $query_user = "INSERT INTO user (username, nm_user, tempat_lahir, tanggal_lahir, email, telp, id_bagian) 
                VALUES ('$username', '$nm_user', '$tempat_lahir', '$tanggal_lahir', '$email', '$telp', '4')";
                $result_user = mysqli_query($conn, $query_user);

                // Mendapatkan ID pengguna yang baru saja dimasukkan
                $id_user = mysqli_insert_id($conn);

                $query_pendaftaran = "INSERT INTO pendaftaran (id_user, nm_user2, nm_user3, nm_user4, telp2, telp3, telp4, id_program, tanggal_mulai, jadwal_kursus, bukti_transfer, id_team, status_daftar, tgl_pendaftaran) 
 VALUES ('$id_user', '$nm_user2', '$nm_user3', '$nm_user4', '$telp2', '$telp3', '$telp4', '$id_program', '$tanggal_mulai', '$selectedSchedulesString', '$namaFile', '$id_team', '$status_daftar', '$tgl_pendaftaran')";
                $result_pendaftaran = mysqli_query($conn, $query_pendaftaran);

                if ($result_user && $result_pendaftaran) {
                    echo "<script>
                alert('Data Berhasil Disimpan');
                document.location.href = 'pendaftaran.php';
            </script>";
                } else {
                    echo "<script>
                alert('Data gagal disimpan');
                history.go(-1);
            </script>";
                }
            } else {
                echo "<script>
                alert('Gagal mengunggah file. Silakan coba lagi.');
                history.go(-1);
            </script>";
            }
        } else {
            // Jika file tidak dipilih
            echo "<script>
            alert('Pilih file gambar terlebih dahulu.');
            history.go(-1);
        </script>";
        }
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
    <title>Simawar - Tambah Data</title>
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
                                <li class="breadcrumb-item"><a href="user.php">Data Pendaftaran</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
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
                                    <h5 class="mb-0 text-primary">Tambah Data</h5>
                                </div>
                                <hr>
                                <form class="row g-3" method="POST" target="" enctype="multipart/form-data">
                                    <div class="col-12">
                                        <label for="username" class="form-label">Username :</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username 1 kata saja dan huruf kecil" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="nm_user" class="form-label">Nama Pengguna :</label>
                                        <input type="text" class="form-control" name="nm_user" id="nm_user" placeholder="Nama Lengkap dengan gelar" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="nm_user2" class="form-label">Nama Pengguna 2 :</label>
                                        <input type="text" class="form-control" name="nm_user2" id="nm_user2" placeholder="Nama Lengkap dengan gelar">
                                    </div>
                                    <div class="col-12">
                                        <label for="nm_user3" class="form-label">Nama Pengguna 3 :</label>
                                        <input type="text" class="form-control" name="nm_user3" id="nm_user3" placeholder="Nama Lengkap dengan gelar">
                                    </div>
                                    <div class="col-12">
                                        <label for="nm_user4" class="form-label">Nama Pengguna 4 :</label>
                                        <input type="text" class="form-control" name="nm_user4" id="nm_user4" placeholder="Nama Lengkap dengan gelar">
                                    </div>
                                    <div class="col-12">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir :</label>
                                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir Pengguna" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir :</label>
                                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir Pengguna" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email :</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Pengguna" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="telp" class="form-label">Telpon :</label>
                                        <input type="text" class="form-control" name="telp" id="telp" placeholder="Telpon Pengguna" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="telp2" class="form-label">Telpon 2 :</label>
                                        <input type="text" class="form-control" name="telp2" id="telp2" placeholder="Telpon Pengguna">
                                    </div>
                                    <div class="col-12">
                                        <label for="telp3" class="form-label">Telpon 3 :</label>
                                        <input type="text" class="form-control" name="telp3" id="telp3" placeholder="Telpon Pengguna">
                                    </div>
                                    <div class="col-12">
                                        <label for="telp4" class="form-label">Telpon 4 :</label>
                                        <input type="text" class="form-control" name="telp4" id="telp4" placeholder="Telpon Pengguna">
                                    </div>

                                    <div class="col-12">
                                        <label for="id_program" class="form-label">Nama Program :</label>
                                        <select name="id_program" id="id_program" class="form-select" required>
                                            <option value="">Pilih pendaftaran...</option>
                                            <?php
                                            $query_pendaftaran = "SELECT * FROM program";
                                            $result_pendaftaran = mysqli_query($conn, $query_pendaftaran);
                                            while ($row_pendaftaran = mysqli_fetch_assoc($result_pendaftaran)) {

                                            ?>
                                                <option value="<?php echo $row_pendaftaran["id_program"] ?>"><?php echo $row_pendaftaran["nama_kelas"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <label class="form-label" style="text-align: left; margin-left: opx; font-weight: bold;">Pilih Jadwal Kursus: (Silahkan Pilih minimal 3 Jadwal Kursus)</label>
                                    <?php
                                    $hari_jadwal = array(
                                        "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"
                                    );

                                    $jam_jadwal = array(
                                        "10.00-12.00", "14.00-16.00", "16.00-18.00", "19.30-21.30"
                                    );

                                    echo '<style>';
                                    echo '.form-check-label { display: flex; align-items: center; margin-right: 0px; }'; // Menggunakan flexbox untuk mengatur tata letak
                                    echo '.form-check-input { margin: 0; }'; // Menghilangkan margin pada tombol checkbox
                                    echo '.hari { margin-left: 0px; }'; // Menambahkan margin kiri pada elemen dengan kelas hari
                                    echo '.jadwal { margin-left: 0px; }'; // Menambahkan margin kiri pada div jadwal
                                    echo '</style>';

                                    foreach ($hari_jadwal as $hari) {
                                        echo '<div class="hari">' . $hari . '</div>';
                                        echo '<div class="jadwal">';
                                        foreach ($jam_jadwal as $jam) {
                                            echo '<div class="form-check form-check-inline">';
                                            echo '<input class="form-check-input" type="checkbox" name="selected_schedule[]" id="' . $hari . '_' . $jam . '" value="' . $hari . ': ' . $jam . '">';
                                            echo '<label class="form-check-label" for="' . $hari . '_' . $jam . '"> ' . $jam . '</label>';
                                            echo '</div>';
                                        }
                                        echo '</div>';
                                    }
                                    ?>

                                    <div class="col-12">
                                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai :</label>
                                        <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" placeholder="Tanggal Lahir Pengguna" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="bukti_transfer" class="form-label">Upload Bukti Transfer :</label>
                                        <input class="form-control" type="file" name="bukti_transfer" id="bukti_transfer">
                                    </div>
                                    <small>File format .JPG .JPEG .PNG dengan ukuran maksimal 1 MB</small>
                                    <div class="col-12">
                                        <label for="id_team" class="form-label">Pengajar :</label>
                                        <select name="id_team" id="id_team" class="form-select" required>
                                            <option value="">Pilih Pengajar...</option>
                                            <?php
                                            $query_team = "SELECT * FROM team";
                                            $result_team = mysqli_query($conn, $query_team);
                                            while ($row_team = mysqli_fetch_assoc($result_team)) {

                                            ?>
                                                <option value="<?php echo $row_team["id_team"] ?>"><?php echo $row_team["nm_team"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Status Pendaftaran :</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_daftar" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">Diproses</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_daftar" id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">Aktif</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_user" value="">
                                    <input type="hidden" name="tgl_pendaftaran" value="<?php echo date("Y-m-d H:i:s") ?>">

                                    <div class="col-12">
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