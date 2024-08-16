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

    $id_user = htmlspecialchars($_POST["id_user"]);
    $status_regis = htmlspecialchars($_POST["status_regis"]);

    $allowed_extensions = array('jpg', 'jpeg', 'png');

    if (!empty($_FILES['ktp']['name']) && !empty($_FILES['ktp']['tmp_name'])) {
        $ktp_file_extension = pathinfo($_FILES['ktp']['name'], PATHINFO_EXTENSION);
        $ktp_file_size = $_FILES['ktp']['size'];

        if (!in_array($ktp_file_extension, $allowed_extensions)) {
            die("Error: Hanya file JPG, JPEG, atau PNG yang diperbolehkan untuk KTP.");
        } elseif ($ktp_file_size > 1048576) { // 1 MB
            die("Error: Ukuran file KTP melebihi batas maksimum 1 MB.");
        } else {
            // File KTP valid, lanjutkan dengan proses penyimpanan
            $ktp_file_name = "ktp_" . $id_user . "." . $ktp_file_extension;
            $ktp_target_path = "../assets/images/ktp/" . $ktp_file_name;
            move_uploaded_file($_FILES['ktp']['tmp_name'], $ktp_target_path);
        }
    } else {
        die("Error: File KTP tidak diunggah.");
    }

    // Validasi file bukti registrasi
    if (!empty($_FILES['bukti_registrasi']['name']) && !empty($_FILES['bukti_registrasi']['tmp_name'])) {
        $bukti_registrasi_file_extension = pathinfo($_FILES['bukti_registrasi']['name'], PATHINFO_EXTENSION);
        $bukti_registrasi_file_size = $_FILES['bukti_registrasi']['size'];

        if (!in_array($bukti_registrasi_file_extension, $allowed_extensions)) {
            die("Error: Hanya file JPG, JPEG, atau PNG yang diperbolehkan untuk bukti registrasi.");
        } elseif ($bukti_registrasi_file_size > 1048576) { // 1 MB
            die("Error: Ukuran file bukti registrasi melebihi batas maksimum 1 MB.");
        } else {
            // File bukti registrasi valid, lanjutkan dengan proses penyimpanan
            $bukti_registrasi_file_name = "bukti_registrasi_" . $id_user . "." . $bukti_registrasi_file_extension;
            $bukti_registrasi_target_path = "../assets/images/bukti_registrasi/" . $bukti_registrasi_file_name;
            move_uploaded_file($_FILES['bukti_registrasi']['tmp_name'], $bukti_registrasi_target_path);
        }
    } else {
        die("Error: File bukti registrasi tidak diunggah.");
    }

    // Simpan data ke dalam database
    $query_insert = "INSERT INTO registrasi VALUES(NULL, '$id_user', '$ktp_file_name', '$bukti_registrasi_file_name', '$status_regis')";
    $simpan = mysqli_query($conn, $query_insert);

    if ($simpan) {
        echo "<script>
            alert('Data Berhasil Disimpan');
            document.location.href = 'registrasi.php';
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
    <title>Simawar - Tambah Registrasi</title>
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
                                <li class="breadcrumb-item"><a href="registrasi.php">Data Registrasi</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Registrasi</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <h6 class="mb-0 text-uppercase">Data Registrasi</h6>
                        <hr />
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body px-5 pb-5">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bx-plus me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">Tambah Registrasi</h5>
                                </div>
                                <hr>
                                <form class="row g-3" method="POST" target="" enctype="multipart/form-data">
                                    <div class="col-12">
                                        <label for="id_user" class="form-label">Nama Pengguna :</label>
                                        <input type="text" id="searchUser" class="form-control" placeholder="Cari Pengguna...">
                                        <select name="id_user" id="id_user" class="form-select" required>
                                            <option value="">Pilih Pengguna...</option>
                                            <?php
                                            $query_bagian = "SELECT * FROM user";
                                            $result_bagian = mysqli_query($conn, $query_bagian);
                                            while ($row_bagian = mysqli_fetch_assoc($result_bagian)) {
                                            ?>
                                                <option value="<?php echo $row_bagian["id_user"] ?>"><?php echo $row_bagian["nm_user"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <script>
                                        document.getElementById("searchUser").addEventListener("input", function() {
                                            var input, filter, select, options, option, i, txtValue;
                                            input = document.getElementById("searchUser");
                                            filter = input.value.toUpperCase();
                                            select = document.getElementById("id_user");
                                            options = select.getElementsByTagName("option");
                                            for (i = 0; i < options.length; i++) {
                                                option = options[i];
                                                txtValue = option.textContent || option.innerText;
                                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                    option.style.display = "";
                                                } else {
                                                    option.style.display = "none";
                                                }
                                            }
                                        });
                                    </script>

                                    <div class="col-12">
                                        <label class="form-label">Status Registrasi :</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_regis" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">Menunggu Terkonfirmasi</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_regis" id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">Terkonfirmasi</label>
                                        </div>
                                    </div>

                                    <div style="text-align: left;">
                                        <label for="ktp" style="text-align: left; margin-right: 10px;">Upload KTP:</label>
                                        <input type="file" name="ktp" id="ktp" accept="image/*" style="display: none;" onchange="displayFileName('ktp', 'ktp-file-name')">
                                        <button type="button" class="btn btn-secondary" style="margin-right: 10px;" onclick="document.getElementById('ktp').click();">Select File</button>
                                        <span id="ktp-file-name"></span>
                                        <small>File format .JPG .JPEG .PNG with a maximum size of 1 MB</small>
                                    </div>

                                    <!-- Tambahkan input file untuk bukti registrasi -->
                                    <div style="text-align: left;">
                                        <label for="bukti_registrasi" style="text-align: left; margin-right: 10px;">Upload Bukti Registrasi:</label>
                                        <input type="file" name="bukti_registrasi" id="bukti_registrasi" accept="image/*" style="display: none;" onchange="displayFileName('bukti_registrasi', 'bukti-registrasi-file-name')">
                                        <button type="button" class="btn btn-secondary" style="margin-right: 10px;" onclick="document.getElementById('bukti_registrasi').click();">Select File</button>
                                        <span id="bukti-registrasi-file-name"></span>
                                        <small>File format .JPG .JPEG .PNG with a maximum size of 1 MB</small>
                                    </div>

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
        <script>
            // Fungsi untuk menampilkan nama file yang dipilih
            function displayFileName(inputId, spanId) {
                var input = document.getElementById(inputId);
                var fileName = input.value.split('\\').pop();
                var span = document.getElementById(spanId);
                span.textContent = fileName;
            }
        </script>
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