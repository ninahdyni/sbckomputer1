<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id_user =  $_SESSION["id_admin"];

$query_user = "SELECT * FROM  tbl_admin WHERE id_admin = $id_user";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);

$id_users = $_GET["id"];

$query_users = "SELECT * FROM team WHERE id_team = $id_users";
$result_users = mysqli_query($conn, $query_users);
$row_users = mysqli_fetch_assoc($result_users);

if (isset($_POST["submit"])) {

    $nm_team = ($_POST["nm_team"]);
    $nik = ($_POST["nik"]);
    $id_bagian = ($_POST["id_bagian"]);
    $whatsapp = ($_POST["whatsapp"]);
    $instagram = ($_POST["instagram"]);
    $twitter = ($_POST["twitter"]);
    $telp_team = ($_POST["telp_team"]);
    $email_team = ($_POST["email_team"]);
    $fotoLama = $_POST["fotoLama"];

    if ($_FILES["foto"]["error"] === 4) {
        $foto = $fotoLama;
    } else {

        $namaFile = $_FILES["foto"]["name"];
        $ukuranFile = $_FILES["foto"]["size"];
        $error = $_FILES["foto"]["error"];
        $tmpName = $_FILES["foto"]["tmp_name"];

        $ekstensifotoValid = ["jpg", "jpeg", "png"];
        $ekstensifoto = explode('.', $namaFile);
        $ekstensifoto = strtolower(end($ekstensifoto));

        if (!in_array($ekstensifoto, $ekstensifotoValid)) {
            echo "<script>
            alert('Yang Anda upload bukan foto');
            history.go(-1);
        </script>";
            return false;
        }

        if ($ukuranFile > 1000000) {
            echo "<script>
            alert('Ukuran foto terlalu besar,maksimal 1 MB');
            history.go(-1);
        </script>";
            return false;
        }

        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensifoto;

        move_uploaded_file($tmpName, '../assets/images/team/' . $namaFileBaru);

        $foto = $namaFileBaru;
    }

    $query = "UPDATE team SET 
    nm_team = '$nm_team', 
    nik = '$nik', 
    id_bagian = '$id_bagian', 
    whatsapp = '$whatsapp',
    instagram = '$instagram',
    twitter = '$twitter', 
    email_team = '$email_team', 
    telp_team = '$telp_team', 
        foto_team = '$foto'
    WHERE id_team = '$id_users'";
    $update = mysqli_query($conn, $query);

    if ($update) {
        echo "<script>
            alert('Data berhasil diupdate');
            document.location.href = 'team.php';
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
                        <h6 class="mb-0 text-uppercase">Profile</h6>
                        <hr />
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body px-5 pb-5">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bx-plus me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">Update Profile</h5>
                                </div>
                                <hr>
                                <form class="row g-3" method="POST" target="" enctype="multipart/form-data">
                                    <div class="col-12">
                                        <label for="nm_team" class="form-label">Nama Team :</label>
                                        <input type="text" class="form-control" name="nm_team" id="nm_team" value="<?php echo $row_users["nm_team"] ?>" placeholder="Username 1 kata huruf kecil semua" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="nik" class="form-label">NIK Pengajar :</label>
                                        <input type="text" class="form-control" name="nik" id="nik" value="<?php echo $row_users["nik"] ?>" placeholder="NIK Sultan Beruntung Centre" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="id_bagian" class="form-label">Bagian :</label>
                                        <select name="id_bagian" id="id_bagian" class="form-select" required>
                                            <option value="">Pilih Bagian...</option>
                                            <?php
                                            $query_bagian = "SELECT * FROM bagian";
                                            $result_bagian = mysqli_query($conn, $query_bagian);
                                            while ($row_bagian = mysqli_fetch_assoc($result_bagian)) {
                                                $selected = ($row_bagian["id_bagian"] == $row_users["id_bagian"]) ? 'selected="selected"' : '';
                                            ?>
                                                <option value="<?php echo $row_bagian["id_bagian"] ?>" <?php echo $selected ?>><?php echo $row_bagian["nm_bagian"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label for="whatsapp" class="form-label">Whatsapp :</label>
                                        <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="<?php echo $row_users["whatsapp"] ?>" placeholder="No Aktif WA" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="instagram" class="form-label">Instagram :</label>
                                        <input type="text" class="form-control" name="instagram" id="instagram" value="<?php echo $row_users["instagram"] ?>" placeholder="ex: lkpsbckomputer, tanpa '@'" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="twitter" class="form-label">Twitter :</label>
                                        <input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo $row_users["twitter"] ?>" placeholder="ex: lkpsbckomputer, tanpa '@'" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="telp_team" class="form-label">Telpon :</label>
                                        <input type="number" class="form-control" name="telp_team" id="telp_team" value="<?php echo $row_users["telp_team"] ?>" placeholder="Nomor Telpon Aktif WA" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="email_team" class="form-label">Email :</label>
                                        <input type="email" class="form-control" name="email_team" id="email_team" value="<?php echo $row_users["email_team"] ?>" placeholder="Email Aktif" required>
                                    </div>

                                    <div class="d-flex align-item-center">
                                        <img src="../assets/images/team/<?php echo $row_users["foto_team"] ?>" class="rounded-circle p-1 border" width="90" alt="<?php echo $row_users["foto_team"] ?>">
                                    </div>

                                    <div class="col-12">
                                        <label for="foto" class="form-label">Upload Foto :</label>
                                        <input class="form-control" type="file" name="foto" id="foto">
                                    </div>
                                    <small>File format .JPG .JPEG .PNG dengan ukuran maksimal 1 MB</small>

                                    <input type="hidden" name="fotoLama" value="<?php echo $row_users["foto_team"] ?>">

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