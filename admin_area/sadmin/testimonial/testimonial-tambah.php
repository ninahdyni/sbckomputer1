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
    $komentar = htmlspecialchars($_POST["komentar"]);


    $query = "INSERT INTO testimonial VALUES (NULL, '$id_user', '$komentar')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script>
                alert('Data Berhasil Disimpan');
                document.location.href = 'testimonial.php';
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
    <title>Simawar - Tambah Testimonial</title>
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
                                <li class="breadcrumb-item"><a href="testimonial.php">Data Testimonial</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Testimonial</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <h6 class="mb-0 text-uppercase">Data Testimonial</h6>
                        <hr />
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body px-5 pb-5">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bx-plus me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">Tambah Testimonial</h5>
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
                                        <label for="komentar" class="form-label">Komentar :</label>
                                        <textarea type="textarea" class="form-control" rows="5" name="komentar" id="komentar" placeholder="Komentar" required></textarea>
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