<?php

session_start();

if ($_SESSION["level"] != 4) {
    header("Location: logout.php");
    exit;
}

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id_user =  $_SESSION["id_user"];

$query_user = "SELECT * FROM  tbl_user WHERE id_user = $id_user";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);

if (isset($_POST["submit"])) {

    $no_srt = htmlspecialchars($_POST["no_srt"]);
    $tgl_srt = htmlspecialchars($_POST["tgl_srt"]);
    $lampiran = htmlspecialchars($_POST["lampiran"]);
    $hal = htmlspecialchars($_POST["hal"]);
    $untuk = htmlspecialchars($_POST["untuk"]);
    $penandatangan = htmlspecialchars($_POST["penandatangan"]);
    $tgl_ttd = htmlspecialchars($_POST["tgl_ttd"]);
    $status = htmlspecialchars($_POST["status"]);
    $tgl_input = htmlspecialchars($_POST["tgl_input"]);
    $oleh = htmlspecialchars($_POST["oleh"]);

    $namaFile = $_FILES["file"]["name"];
    $ukuranFile = $_FILES["file"]["size"];
    $error = $_FILES["file"]["error"];
    $tmpName = $_FILES["file"]["tmp_name"];

    $ekstensifileValid = ["pdf", "doc", "docx", "xls", "xlsx"];
    $ekstensifile = explode('.', $namaFile);
    $ekstensifile = strtolower(end($ekstensifile));

    if (!in_array($ekstensifile, $ekstensifileValid)) {
        echo "<script>
            alert('Yang Anda upload bukan file');
            history.go(-1);
        </script>";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "<script>
            alert('Ukuran file terlalu besar,maksimal 10 MB');
            history.go(-1);
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensifile;

    move_uploaded_file($tmpName, '../assets/files/' . $namaFileBaru);

    $file = $namaFileBaru;

    $query = "INSERT INTO tbl_srt_klr VALUES (NULL, '$no_srt', '$tgl_srt', '$lampiran', '$hal', '$untuk', '$file', '$penandatangan', '$tgl_ttd', '$status', '$tgl_input', '$oleh')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script>
            alert('Data Berhasil Disimpan');
            document.location.href = 'srt-klr.php';
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
    <title>Simawar - Upload Surat Keluar</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        <?php include "theme-sidebar.php" ?>

        <?php include "theme-header.php" ?>

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="index.php"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item"><a href="srt-klr.php">Surat Keluar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Upload Surat Keluar</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <h6 class="mb-0 text-uppercase">Data Surat Keluar</h6>
                        <hr />
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body px-5 pb-5">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bx-plus me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">Upload Surat Keluar</h5>
                                </div>
                                <hr>
                                <form class="row g-3" method="POST" target="" enctype="multipart/form-data">
                                    <div class="col-12">
                                        <label for="no_srt" class="form-label">Nomor Surat :</label>
                                        <input type="text" class="form-control" name="no_srt" id="no_srt" placeholder="Nomor Surat Keluar" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="tgl_srt" class="form-label">Tanggal Surat :</label>
                                        <input type="date" class="form-control" name="tgl_srt" id="tgl_srt" placeholder="Tanggal Surat Keluar" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="lampiran" class="form-label">Lampiran :</label>
                                        <input type="text" class="form-control" name="lampiran" id="lampiran" placeholder="Lampiran" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="hal" class="form-label">Perihal :</label>
                                        <input type="text" class="form-control" name="hal" id="hal" placeholder="Perihal" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="untuk" class="form-label">Untuk :</label>
                                        <input type="text" class="form-control" name="untuk" id="untuk" placeholder="Surat Untuk" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="file" class="form-label">Upload Surat :</label>
                                        <input class="form-control" type="file" name="file" id="file" required>
                                    </div>
                                    <small>File format .PDF .DOX .DOCX. .XLS .XLSX dengan ukuran maksimal 10 MB</small>

                                    <div class="col-12">
                                        <label for="penandatangan" class="form-label">Penandatangan :</label>
                                        <select name="penandatangan" id="penandatangan" class="form-select" required>
                                            <option value="">Pilih Penandatangan...</option>
                                            <?php
                                            $query_penandatangan = "SELECT * FROM tbl_user";
                                            $result_penandatangan = mysqli_query($conn, $query_penandatangan);
                                            while ($row_penandatangan = mysqli_fetch_assoc($result_penandatangan)) {

                                            ?>
                                                <option value="<?php echo $row_penandatangan["id_user"] ?>"><?php echo $row_penandatangan["nm_user"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <input type="hidden" name="tgl_ttd" value="">
                                    <input type="hidden" name="status" value="New">
                                    <input type="hidden" name="tgl_input" value="<?php echo date("Y-m-d H:i:s") ?>">
                                    <input type="hidden" name="oleh" value="<?php echo $row_user["id_user"] ?>">

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

        <?php include "theme-footer.php" ?>

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