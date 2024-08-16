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

$query_users = "SELECT * FROM program WHERE id_program = $id_users";
$result_users = mysqli_query($conn, $query_users);
$row_users = mysqli_fetch_assoc($result_users);

if (isset($_POST["submit"])) {

    $nama_kelas = htmlspecialchars($_POST["nama_kelas"]);
    $jenis_kelas = htmlspecialchars($_POST["jenis_kelas"]);
    $deskripsi = htmlspecialchars($_POST["deskripsi"]);
    $materi = htmlspecialchars($_POST["materi"]);
    $lama_pendidikan = htmlspecialchars($_POST["lama_pendidikan"]);
    $biaya = htmlspecialchars($_POST["biaya"]);
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

        move_uploaded_file($tmpName, '../assets/images/program/' . $namaFileBaru);

        $foto = $namaFileBaru;
    }

    $query = "UPDATE program SET 
    nama_kelas = '$nama_kelas', 
    jenis_kelas = '$jenis_kelas',
    deskripsi = '$deskripsi',
    materi = '$materi', 
    lama_pendidikan = '$lama_pendidikan', 
    biaya = '$biaya', 
        foto_program = '$foto'
    WHERE id_program = '$id_users'";
    $update = mysqli_query($conn, $query);

    if ($update) {
        echo "<script>
            alert('Data berhasil diupdate');
            document.location.href = 'program.php';
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
    <title>Simawar - Tambah program</title>
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
                                <li class="breadcrumb-item"><a href="program.php">Data program</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah program</li>
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
                                    <h5 class="mb-0 text-primary">Update Data Program</h5>
                                </div>
                                <hr>
                                <form class="row g-3" method="POST" target="" enctype="multipart/form-data">
                                    <div class="col-12">
                                        <label for="nama_kelas" class="form-label">Nama Kelas :</label>
                                        <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" value="<?php echo $row_users["nama_kelas"] ?>" placeholder="Nama Program" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="jenis_kelas" class="form-label">Jenis Kelas :</label>
                                        <select name="jenis_kelas" id="jenis_kelas" class="form-select" required>
                                            <option value="">--Pilih Jenis Kelas--</option>
                                            <option value="Private" <?php if ($row_users["jenis_kelas"] == "Private") echo ' selected="selected"'; ?>>Private</option>
                                            <option value="Reguler" <?php if ($row_users["jenis_kelas"] == "Reguler") echo ' selected="selected"'; ?>>Reguler</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label for="deskripsi" class="form-label">Deskripsi :</label>
                                        <textarea rows="5" type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi" required><?php echo $row_users["deskripsi"] ?></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="materi" class="form-label">Materi :</label>
                                        <textarea rows="5" type="text" class="form-control" name="materi" id="materi" placeholder="Materi yg Diajarkan" required><?php echo $row_users["materi"] ?></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="lama_pendidikan" class="form-label">Lama Pendidikan :</label>
                                        <input type="text" class="form-control" name="lama_pendidikan" id="lama_pendidikan" value="<?php echo $row_users["lama_pendidikan"] ?>" placeholder="Lama Pendidikan" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="biaya" class="form-label">Biaya Pendidikan :</label>
                                        <input type="text" class="form-control" name="biaya" id="biaya" value="<?php echo $row_users["biaya"] ?>" placeholder="Biaya Program" required>
                                    </div>

                                    <div class="d-flex align-item-center">
                                        <img src="../assets/images/program/<?php echo $row_users["foto_program"] ?>" class="rounded-circle p-1 border" width="90" height="90" alt="<?php echo $row_users["foto_program"] ?>">
                                    </div>

                                    <div class="col-12">
                                        <label for="foto" class="form-label">Upload Foto :</label>
                                        <input class="form-control" type="file" name="foto" id="foto">
                                    </div>
                                    <small>File format .JPG .JPEG .PNG dengan ukuran maksimal 1 MB</small>

                                    <input type="hidden" name="fotoLama" value="<?php echo $row_users["foto_program"] ?>">

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