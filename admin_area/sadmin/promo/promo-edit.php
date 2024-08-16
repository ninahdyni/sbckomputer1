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

$id_users = $_GET["id"];

$query_users = "SELECT * FROM promo WHERE id_promo = $id_users";
$result_users = mysqli_query($conn, $query_users);
$row_users = mysqli_fetch_assoc($result_users);

if (isset($_POST["submit"])) {

    $judul = htmlspecialchars($_POST["judul"]);
    $id_program = htmlspecialchars($_POST["id_program"]);
    $kode = htmlspecialchars($_POST["kode"]);
    $biaya_promo = htmlspecialchars($_POST["biaya_promo"]);
    $pesan1 = htmlspecialchars($_POST["pesan1"]);
    $pesan2 = htmlspecialchars($_POST["pesan2"]);
    $batas = htmlspecialchars($_POST["batas"]);
    $terpakai = htmlspecialchars($_POST["terpakai"]);

    $query = "UPDATE promo SET judul = '$judul', id_program = '$id_program', kode = '$kode', biaya_promo = '$biaya_promo', pesan1 = '$pesan1', pesan2 = '$pesan2', batas = '$batas', terpakai = '$terpakai' WHERE id_promo = $id_users ";
    $edit = mysqli_query($conn, $query);

    if ($edit) {
        echo "<script>
            alert('Data Berhasil Disimpan');
            document.location.href = 'promo.php';
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
                        <h6 class="mb-0 text-uppercase">Data User</h6>
                        <hr />
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body px-5 pb-5">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bx-plus me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">Tambah User</h5>
                                </div>
                                <hr>
                                <form class="row g-3" method="POST" target="">
                                    <div class="col-12">
                                        <label for="judul" class="form-label">Judul Promo :</label>
                                        <input type="text" class="form-control" name="judul" id="judul" value="<?php echo $row_users["judul"] ?>" placeholder="Judul Promo" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="id_program" class="form-label">Nama Program :</label>
                                        <select name="id_program" id="id_program" class="form-select" required>
                                            <option value="">Pilih pendaftaran...</option>
                                            <?php
                                            $query_pendaftaran = "SELECT * FROM program";
                                            $result_pendaftaran = mysqli_query($conn, $query_pendaftaran);
                                            while ($row_pendaftaran = mysqli_fetch_assoc($result_pendaftaran)) {
                                                $selected = ($row_pendaftaran["nama_kelas"] == $row_users["id_program"]) ? "selected" : "";
                                            ?>
                                                <option value="<?php echo $row_pendaftaran["id_program"] ?>" <?php echo $selected ?>><?php echo $row_pendaftaran["nama_kelas"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label for="kode" class="form-label"><b>Kode Promo :</b></label>
                                        <input type="text" class="form-control" name="kode" id="kode" value="<?php echo $row_users["kode"] ?>" placeholder="KODE UNIK HURUF KAPITAL" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="biaya_promo" class="form-label">Biaya Promo :</label>
                                        <input type="text" class="form-control" name="biaya_promo" id="biaya_promo" value="<?php echo $row_users["biaya_promo"] ?>" placeholder="ex: Rp. 1.000.000,00" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="pesan1" class="form-label">Pesan 1 :</label>
                                        <textarea type="textarea" class="form-control" name="pesan1" id="pesan1" placeholder="Pesan Paragraf 1" required><?php echo $row_users["pesan1"] ?></textarea>
                                    </div>

                                    <div class="col-12">
                                        <label for="pesan2" class="form-label">Pesan 2 :</label>
                                        <textarea type="textarea" class="form-control" name="pesan2" id="pesan2" placeholder="Pesan Paragraf 2" required><?php echo $row_users["pesan2"] ?></textarea>
                                    </div>

                                    <div class="col-12">
                                        <label for="batas" class="form-label">Batas Pemakaian :</label>
                                        <input type="number" class="form-control" name="batas" id="batas" value="<?php echo $row_users["batas"] ?>" placeholder="Batas Pemakaian" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="terpakai" class="form-label">Jumlah Terpakai :</label>
                                        <input type="number" class="form-control" name="terpakai" id="terpakai" value="<?php echo $row_users["terpakai"] ?>" placeholder="Jumlah Terpakai" required>
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