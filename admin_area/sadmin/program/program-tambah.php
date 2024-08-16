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

    $nama_kelas = htmlspecialchars($_POST["nama_kelas"]);
    $jenis_kelas = htmlspecialchars($_POST["jenis_kelas"]);
    $deskripsi = htmlspecialchars($_POST["deskripsi"]);
    $materi = htmlspecialchars($_POST["materi"]);
    $lama_pendidikan = htmlspecialchars($_POST["lama_pendidikan"]);
    $biaya = htmlspecialchars($_POST["biaya"]);

    if (isset($_FILES["foto"])) {
        $namaFile = $_FILES["foto"]["name"];
        $typeFile = $_FILES["foto"]["type"];
        $ukuranFile = $_FILES["foto"]["size"];
        $tmpName = $_FILES["foto"]["tmp_name"];

        $upload_directory = '../assets/images/program/';
        if ($_FILES["foto"]["error"] !== 0) {
            echo "Terjadi kesalahan saat mengunggah file: " . $_FILES["foto"]["error"];
            exit;
        }

        // Check file type
        $allowedTypes = array("image/jpeg", "image/jpg", "image/png");
        if (!in_array($typeFile, $allowedTypes)) {
            echo "<script>alert('Format file tidak didukung. Gunakan format JPG, JPEG, atau PNG.');</script>";
            echo "<script>window.history.back();</script>";
            die();
        }

        // Check file size (1MB)
        if ($ukuranFile > 1048576) {
            echo "<script>alert('Ukuran file terlalu besar. Maksimum 1MB.');</script>";
            echo "<script>window.history.back();</script>";
            die();
        }


        $upload_path = $upload_directory . $namaFile;
        if (move_uploaded_file($tmpName, $upload_path)) {

            $query = "INSERT INTO program VALUES (NULL, '$nama_kelas', '$jenis_kelas', '$deskripsi', '$materi', '$lama_pendidikan', '$biaya', '$namaFile')";
            $simpan = mysqli_query($conn, $query);

            if ($simpan) {
                echo "<script>
                alert('Data Berhasil Disimpan');
                document.location.href = 'program.php';
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
    <title>Simawar - Tambah Program</title>
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
                                <li class="breadcrumb-item"><a href="user.php">Data Program</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Program</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <h6 class="mb-0 text-uppercase">Data Program</h6>
                        <hr />
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body px-5 pb-5">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bx-plus me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">Tambah Program</h5>
                                </div>
                                <hr>
                                <form class="row g-3" method="POST" target="" enctype="multipart/form-data">
                                    <div class="col-12">
                                        <label for="nama_kelas" class="form-label">Nama Kelas :</label>
                                        <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" placeholder="Nama Program Kursus" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="jenis_kelas" class="form-label">Jenis Kelas :</label>
                                        <select name="jenis_kelas" id="jenis_kelas" class="form-select" required>
                                            <option value="">--Pilih Jenis Kelas--</option>
                                            <option value="Private">Private</option>
                                            <option value="Reguler">Reguler</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label for="deskripsi" class="form-label">Deskripsi :</label>
                                        <textarea rows="5" type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi" required></textarea>
                                    </div>

                                    <div class="col-12">
                                        <label for="materi" class="form-label">Materi :</label>
                                        <textarea rows="5" type="text" class="form-control" name="materi" id="materi" placeholder="Materi yg Diajarkan" required></textarea>
                                    </div>

                                    <div class="col-12">
                                        <label for="lama_pendidikan" class="form-label">Lama Pendidikan :</label>
                                        <input type="text" class="form-control" name="lama_pendidikan" id="lama_pendidikan" placeholder="Lama Pendidikan Kursus" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="biaya" class="form-label">Biaya Pendidikan :</label>
                                        <input type="text" class="form-control" name="biaya" id="biaya" placeholder="Biaya Pendidikan Kursus" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="foto" class="form-label">Upload Foto :</label>
                                        <input class="form-control" type="file" name="foto" id="foto">
                                    </div>
                                    <small>File format .JPG .JPEG .PNG dengan ukuran maksimal 1 MB</small>

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