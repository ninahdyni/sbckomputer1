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

$query_registrasi = "SELECT 
registrasi.id_registrasi,
registrasi.status_regis,
user.foto,
user.nm_user,
user.email,
user.telp,
registrasi.foto_ktp,
registrasi.bukti_registrasi
FROM 
registrasi
INNER JOIN 
user ON registrasi.id_user = user.id_user";
$result_registrasi = mysqli_query($conn, $query_registrasi);
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
    <link href="../assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
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
    <title>Simawar - Data Registrasi</title>
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
                                <li class="breadcrumb-item"><a href="../sadmin/index.php"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Registrasi</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <h5 class="my-4 text-uppercase">Data Registrasi</h5>
                <div class="col">
                    <a href="registrasi-tambah.php" class="btn btn-primary"><i class='bx bx-plus mr-1'></i>Tambah Data</a>
                </div>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-hover table-bordered">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Action</th>
                                        <th>Status</th>
                                        <th>Foto Pengguna</th>
                                        <th>Nama Pengguna</th>
                                        <th>Email</th>
                                        <th>Telpon</th>
                                        <th>Foto KTP</th>
                                        <th>Bukti Registrasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row_registrasi = mysqli_fetch_assoc($result_registrasi)) { ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex order-actions">
                                                    <a href="registrasi-edit.php?id=<?php echo $row_registrasi["id_registrasi"] ?>" class="text-light bg-success border-0"><i class='bx bxs-edit'></i></a>
                                                    <a href="registrasi-hapus.php?id=<?php echo $row_registrasi["id_registrasi"] ?>" class="ms-4 text-light bg-warning border-0" onClick="return confirm('Apakah anda yakin ingin menghapus data ini...?')"><i class='bx bxs-trash'></i></a>

                                                </div>
                                            </td>
                                            <td>
                                                <?php if ($row_registrasi["status_regis"] == 2) { ?>
                                                    <span class="badge bg-light-success text-success w-100">Terkonfirmasi</span>
                                                <?php } else if ($row_registrasi["status_regis"] == 1) { ?>
                                                    <span class="badge bg-light-danger text-danger w-100">Belum Terkonfirmasi</span>
                                                <?php } else if ($row_registrasi["status_regis"] == 0) { ?>
                                                    <span class="badge bg-light-danger text-danger w-100">Data tidak ditemukan</span>
                                                <?php } else {
                                                    echo '<span class="badge bg-light-danger text-danger w-100 text-left"><big>Data tidak ditemukan</big></span>';
                                                } ?>
                                            </td>
                                            <td>
                                                <img src="../assets/images/users/<?php echo $row_registrasi["foto"] ?>" alt="<?php echo $row_registrasi["foto"] ?>" width="50" class="rounded-circle p-1 border">
                                            </td>
                                            <td><?php echo $row_registrasi["nm_user"] ?></td>
                                            <td><?php echo $row_registrasi["email"] ?></td>
                                            <td><?php echo $row_registrasi["telp"] ?></td>
                                            <td>
                                                <a href="../assets/images/ktp/<?php echo $row_registrasi["foto_ktp"] ?>" target="_blank"><?php echo $row_registrasi["foto_ktp"] ?> <i class="lni lni-link"></i></a>
                                            </td>
                                            <td>
                                                <a href="../assets/images/bukti_registrasi/<?php echo $row_registrasi["bukti_registrasi"] ?>" target="_blank"><?php echo $row_registrasi["bukti_registrasi"] ?> <i class="lni lni-link"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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

    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                lengthChange: false,
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
    <!--app JS-->
    <script src="../assets/js/app.js"></script>
</body>

</html>