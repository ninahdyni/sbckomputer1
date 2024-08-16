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

// Mendapatkan ID dari URL
$id_sertifikat = $_GET['id'];

// Query untuk mengambil data sertifikat
$query = "SELECT 
        s.id_sertifikat,
        s.tanggal_selesai,
        s.file_sertifikat
    FROM sertifikat s
    WHERE s.id_sertifikat = $id_sertifikat";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {
    $tanggal_selesai = htmlspecialchars($_POST["tanggal_selesai"]);

    // Nama file sertifikat
    if (!empty($_FILES["file_sertifikat"]["name"])) {
        $namaFile = $_FILES["file_sertifikat"]["name"];
        $typeFile = $_FILES["file_sertifikat"]["type"];
        $ukuranFile = $_FILES["file_sertifikat"]["size"];
        $tmpName = $_FILES["file_sertifikat"]["tmp_name"];

        $upload_directory = '../file-sertifikat/'; // Pastikan path ini benar sesuai dengan struktur folder Anda

        // Check for file upload errors
        if ($_FILES["file_sertifikat"]["error"] !== 0) {
            die("Terjadi kesalahan saat mengunggah file: " . $_FILES["file_sertifikat"]["error"]);
        }

        // Check file type
        $allowedTypes = array("application/pdf");
        if (!in_array($typeFile, $allowedTypes)) {
            die("Format file tidak didukung. Gunakan format PDF.");
        }

        // Check file size (10MB)
        if ($ukuranFile > 10485760) { // 10MB = 10 * 1024 * 1024 bytes
            die("Ukuran file terlalu besar. Maksimum 10MB.");
        }

        $upload_path = $upload_directory . $namaFile;
        if (move_uploaded_file($tmpName, $upload_path)) {

            // Update data sertifikat
            $query_sertifikat = "UPDATE sertifikat SET tanggal_selesai = '$tanggal_selesai', file_sertifikat = '$namaFile' WHERE id_sertifikat = $id_sertifikat";
            $result_sertifikat = mysqli_query($conn, $query_sertifikat);

            if ($result_sertifikat) {
                echo "<script>
                    alert('Data Berhasil Diperbarui');
                    document.location.href = 'sertifikat.php';
                </script>";
            } else {
                echo "<script>
                    alert('Data gagal diperbarui');
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
        // Update data sertifikat tanpa mengubah file
        $query_sertifikat = "UPDATE sertifikat SET tanggal_selesai = '$tanggal_selesai' WHERE id_sertifikat = $id_sertifikat";
        $result_sertifikat = mysqli_query($conn, $query_sertifikat);

        if ($result_sertifikat) {
            echo "<script>
                alert('Data Berhasil Diperbarui');
                document.location.href = 'sertifikat.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal diperbarui');
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
    <title>Simawar - Edit Data Sertifikat</title>
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
                                <li class="breadcrumb-item"><a href="sertifikat.php">Data Sertifikat</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <h6 class="mb-0 text-uppercase">Edit Data Sertifikat</h6>
                        <hr />
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body px-5 pb-5">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bx-edit me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">Edit Data Sertifikat</h5>
                                </div>
                                <hr>
                                <form class="row g-3" method="POST" enctype="multipart/form-data">
                                    <div class="col-12">
                                        <label for="tanggal_selesai" class="form-label"><b>Tanggal Selesai :</b></label>
                                        <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai" placeholder="Tanggal Selesai Kursus" value="<?php echo htmlspecialchars($row['tanggal_selesai']); ?>" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="file_sertifikat" class="form-label">Upload File Sertifikat :</label>
                                        <input class="form-control" type="file" name="file_sertifikat" id="file_sertifikat">
                                    </div>
                                    <small>File format .PDF dengan ukuran maksimal 10 MB</small>
                                    <?php if ($row['file_sertifikat']) : ?>
                                        <div class="col-12 mt-2">
                                            <label class="form-label">File Sertifikat Saat Ini:</label>
                                            <a href="../file-sertifikat/<?php echo htmlspecialchars($row['file_sertifikat']); ?>" target="_blank"><?php echo htmlspecialchars($row['file_sertifikat']); ?></a>
                                        </div>
                                    <?php endif; ?>

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
</body>

</html>