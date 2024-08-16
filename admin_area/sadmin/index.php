<?php

session_start();

if ($_SESSION["id_bagian"] != 1) {
    header("Location: logout.php");
    exit;
}

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id_user =  $_SESSION["id_admin"];

$query_user = "SELECT * FROM  tbl_admin WHERE id_admin = $id_user";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);
?>

<!doctype html>
<html lang="en" class="<?php echo $row_user["theme"] ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../assets/images/favicon-32x32.png" type="image/png" />
    <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="../assets/plugins/highcharts/css/highcharts.css" rel="stylesheet" />
    <link href="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
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
    <title>Simawar - Dashboard</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        <?php include "include/theme-sidebar.php" ?>

        <?php include "include/theme-header.php" ?>

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
                    <?php
                    $query_admin = "SELECT * FROM tbl_admin";
                    $result_admin = mysqli_query($conn, $query_admin);
                    $jml_admin = mysqli_num_rows($result_admin);

                    ?>
                    <div class="col">
                        <div class="card radius-10 overflow-hidden bg-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-white"><a href="../sadmin/admin/admin.php" style="color: white;">Jumlah Admin</a></p>
                                        <h5 class="mb-0 text-white"><?php echo $jml_admin ?></h5>
                                    </div>
                                    <div class="ms-auto text-white"> <i class='bx bx-cabinet font-30'></i>
                                    </div>
                                </div>
                            </div>
                            <div class="" id="chart1"></div>
                        </div>
                    </div>

                    <?php
                    $query_users = "SELECT * FROM  user";
                    $result_users = mysqli_query($conn, $query_users);
                    $jml_users = mysqli_num_rows($result_users);
                    ?>

                    <div class="col">
                        <div class="card radius-10 overflow-hidden bg-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-white"><a href="../sadmin/user/user.php" style="color: white;">Jumlah Pengguna</a></p>
                                        <h5 class="mb-0 text-white"><?php echo $jml_users ?></h5>
                                    </div>
                                    <div class="ms-auto text-white"> <i class='bx bx-user font-30'></i>
                                    </div>
                                </div>
                            </div>
                            <div class="" id="chart2"></div>
                        </div>
                    </div>

                    <?php
                    $query_program = "SELECT * FROM  program";
                    $result_program = mysqli_query($conn, $query_program);
                    $jml_program = mysqli_num_rows($result_program);
                    ?>

                    <div class="col">
                        <div class="card radius-10 overflow-hidden bg-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-dark"><a href="../sadmin/program/program.php" style="color: black;">Jumlah Program</a></p>
                                        <h5 class="mb-0 text-dark"><?php echo $jml_program ?></h5>
                                    </div>
                                    <div class="ms-auto text-dark"> <i class='bx bx-envelope font-30'></i>
                                    </div>
                                </div>
                            </div>
                            <div class="" id="chart3"></div>
                        </div>
                    </div>

                    <?php
                    $query_team = "SELECT * FROM team";
                    $result_team = mysqli_query($conn, $query_team);
                    $jml_team = mysqli_num_rows($result_team);
                    ?>

                    <div class="col">
                        <div class="card radius-10 overflow-hidden bg-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-white"><a href="../sadmin/team/team.php" style="color: white;">Tenaga Pengajar</a></p>
                                        <h5 class="mb-0 text-white"><?php echo $jml_team ?></h5>
                                    </div>
                                    <div class="ms-auto text-white"> <i class='bx bx-envelope-open font-30'></i>
                                    </div>
                                </div>
                            </div>
                            <div class="" id="chart4"></div>
                        </div>
                    </div>
                </div>
                <!--end row-->
                <!--end row-->

                <div class="row">
                    <div class="col">
                        <div class="card radius-10 mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h5 class="mb-1">5 Registrasi Terbaru </h5>
                                    </div>
                                </div>

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
                                            <?php
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
                                            user ON registrasi.id_user = user.id_user ORDER BY id_registrasi DESC LIMIT 5";
                                            $result_registrasi = mysqli_query($conn, $query_registrasi);
                                            while ($row_registrasi = mysqli_fetch_assoc($result_registrasi)) {

                                            ?> <tr>
                                                    <td>
                                                        <div class="d-flex order-actions">
                                                            <a href="registrasi/registrasi-edit.php?id=<?php echo $row_registrasi["id_registrasi"] ?>" class="text-light bg-success border-0"><i class='bx bxs-edit'></i></a>
                                                            <a href="registrasi/registrasi-hapus.php?id=<?php echo $row_registrasi["id_registrasi"] ?>" class="ms-4 text-light bg-warning border-0" onClick="return confirm('Apakah anda yakin ingin menghapus data ini...?')"><i class='bx bxs-trash'></i></a>

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
                                                        <img src="assets/images/users/<?php echo $row_registrasi["foto"] ?>" alt="<?php echo $row_registrasi["foto"] ?>" width="50" class="rounded-circle p-1 border">
                                                    </td>
                                                    <td><?php echo $row_registrasi["nm_user"] ?></td>
                                                    <td><?php echo $row_registrasi["email"] ?></td>
                                                    <td><?php echo $row_registrasi["telp"] ?></td>
                                                    <td>
                                                        <a href="assets/images/ktp/<?php echo $row_registrasi["foto_ktp"] ?>" target="_blank"><?php echo $row_registrasi["foto_ktp"] ?> <i class="lni lni-link"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="assets/images/bukti_registrasi/<?php echo $row_registrasi["bukti_registrasi"] ?>" target="_blank"><?php echo $row_registrasi["bukti_registrasi"] ?> <i class="lni lni-link"></i></a>
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
                <!--end row-->
                <div class="row">
                    <div class="col">
                        <div class="card radius-10 mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h5 class="mb-1">5 Pendaftaran Terbaru </h5>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="example2" class="table table-hover table-bordered">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Action</th>
                                                <th>Status</th>
                                                <th>Pilihan Kelas</th>
                                                <th>Jenis Kelas</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Jadwal Kursus</th>
                                                <th>Username</th>
                                                <th>Nama Pengguna</th>
                                                <th>Tempat Lahir</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Email</th>
                                                <th>Telpon</th>
                                                <th>Lama Pendidikan</th>
                                                <th>Biaya Kursus</th>
                                                <th>Bukti Transfer</th>
                                                <th>Nama Pengajar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query_pendaftaran = "SELECT 
                                            p.id, 
                                            p.id_program,
                                            p.nm_user2,
                                            p.nm_user3,
                                            p.nm_user4,
                                            p.telp2,
                                            p.telp3,
                                            p.telp4, 
                                            p.jadwal_kursus, 
                                            p.status_daftar, 
                                            p.bukti_transfer,
                                            pr.nama_kelas, 
                                            pr.biaya, 
                                            pr.jenis_kelas, 
                                            p.tanggal_mulai, 
                                            pr.lama_pendidikan,
                                            u.id_user,
                                            u.username,
                                            u.nm_user,
                                            u.tempat_lahir,
                                            u.tanggal_lahir,
                                            u.email,
                                            u.telp,
                                            u.foto,                            
                                            t.id_team,                            
                                            t.nm_team                            
                                            FROM 
                                            pendaftaran p 
                                            LEFT JOIN user u ON p.id_user = u.id_user
                                            LEFT JOIN program pr ON p.id_program = pr.id_program
                                            LEFT JOIN team t ON p.id_team = t.id_team ORDER BY id DESC LIMIT 5";
                                            $result_pendaftaran = mysqli_query($conn, $query_pendaftaran);
                                            while ($row_pendaftaran = mysqli_fetch_assoc($result_pendaftaran)) {

                                            ?> <tr>
                                                    <td>
                                                        <div class="d-flex order-actions">
                                                            <a href="pendaftaran/pendaftaran-edit.php?id=<?php echo $row_pendaftaran["id"] ?>" class="text-light bg-success border-0"><i class='bx bxs-edit'></i></a>
                                                            <a href="pendaftaran/pendaftaran-hapus.php?id=<?php echo $row_pendaftaran["id"] ?>" class="ms-4 text-light bg-warning border-0" onClick="return confirm('Apakah anda yakin ingin menghapus data ini...?')"><i class='bx bxs-trash'></i></a>
                                                            <a href="pendaftaran/pendaftaran-print.php?id=<?php echo $row_pendaftaran["id"] ?>" class="ms-4 text-light bg-info border-0"><i class='bx bxs-printer'></i></a>
                                                        </div>
                                                    </td>
                                                    </td>
                                                    <td>
                                                        <?php if ($row_pendaftaran["status_daftar"] == 2) { ?>
                                                            <span class="badge bg-light-success text-success w-100">Aktif</span>
                                                        <?php } else if ($row_pendaftaran["status_daftar"] == 1) { ?>
                                                            <span class="badge bg-light-warning text-warning w-100">Diproses</span>
                                                        <?php } else if ($row_pendaftaran["status_daftar"] == 0) { ?>
                                                            <span class="badge bg-light-danger text-danger w-100">Data tidak ditemukan</span>
                                                        <?php } else {
                                                            echo '<span class="badge bg-light-danger text-danger w-100 text-left"><big>Data tidak ditemukan</big></span>';
                                                        } ?>
                                                    </td>
                                                    <td><?php echo $row_pendaftaran["nama_kelas"] ?></td>
                                                    <td><?php echo $row_pendaftaran["jenis_kelas"] ?></td>
                                                    <td><?php echo $row_pendaftaran["tanggal_mulai"] ?></td>
                                                    <td><?php echo $row_pendaftaran["jadwal_kursus"] ?></td>
                                                    <td><?php echo $row_pendaftaran["username"] ?></td>
                                                    <td><?php echo $row_pendaftaran["nm_user"] ?></td>
                                                    <td><?php echo $row_pendaftaran["tempat_lahir"] ?></td>
                                                    <td><?php echo $row_pendaftaran["tanggal_lahir"] ?></td>
                                                    <td><?php echo $row_pendaftaran["email"] ?></td>
                                                    <td><?php echo $row_pendaftaran["telp"] ?></td>
                                                    <td><?php echo $row_pendaftaran["lama_pendidikan"] ?></td>
                                                    <td><?php echo $row_pendaftaran["biaya"] ?></td>
                                                    <td>
                                                        <a href="assets/images/bukti_transfer/<?php echo $row_pendaftaran["bukti_transfer"] ?>" target="_blank"><?php echo $row_pendaftaran["bukti_transfer"] ?> <i class="lni lni-link"></i></a>
                                                    </td>
                                                    <td><?php echo $row_pendaftaran["nm_team"] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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

        <?php include "include/theme-footer.php" ?>

    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/plugins/highcharts/js/highcharts.js"></script>
    <script src="../assets/plugins/highcharts/js/exporting.js"></script>
    <script src="../assets/plugins/highcharts/js/variable-pie.js"></script>
    <script src="../assets/plugins/highcharts/js/export-data.js"></script>
    <script src="../assets/plugins/highcharts/js/accessibility.js"></script>
    <script src="../assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="../assets/js/index.js"></script>
    <!--app JS-->
    <script src="../assets/js/app.js"></script>
    <script>
        new PerfectScrollbar('.customers-list');
        new PerfectScrollbar('.store-metrics');
        new PerfectScrollbar('.product-list');
    </script>
</body>

</html>