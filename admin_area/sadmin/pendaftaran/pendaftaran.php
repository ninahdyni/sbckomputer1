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
                            t.nm_team                            
                        FROM 
                            pendaftaran p 
                            LEFT JOIN user u ON p.id_user = u.id_user
                            LEFT JOIN program pr ON p.id_program = pr.id_program
                            LEFT JOIN team t ON p.id_team = t.id_team";

$result_pendaftaran = mysqli_query($conn, $query_pendaftaran);

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
    <title>Simawar - Data Pendaftaran</title>
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
                                <li class="breadcrumb-item active" aria-current="page">Data Pendaftaran</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <h5 class="my-4 text-uppercase">Data Pendaftaran</h5>
                <div class="col">
                    <a href="pendaftaran-tambah.php" class="btn btn-primary"><i class='bx bx-plus mr-1'></i>Tambah Data</a>
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
                                    <?php while ($row_pendaftaran = mysqli_fetch_assoc($result_pendaftaran)) { ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex order-actions">
                                                    <a href="pendaftaran-edit.php?id=<?php echo $row_pendaftaran["id"] ?>" class="text-light bg-success border-0"><i class='bx bxs-edit'></i></a>
                                                    <a href="pendaftaran-hapus.php?id=<?php echo $row_pendaftaran["id"] ?>" class="ms-4 text-light bg-warning border-0" onClick="return confirm('Apakah anda yakin ingin menghapus data ini...?')"><i class='bx bxs-trash'></i></a>
                                                    <?php if ($row_pendaftaran["status_daftar"] == 2) { ?>
                                                        <a href="pendaftaran-print.php?id=<?php echo $row_pendaftaran["id"] ?>" class="ms-4 text-light bg-info border-0"><i class='bx bxs-book'></i></a>
                                                        <a href="../sertifikat/sertifikat-tambah.php?id=<?php echo $row_pendaftaran["id"] ?>" class="ms-4 text-light bg-secondary border-0"><i class='bx bxs-printer'></i></a>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if ($row_pendaftaran["status_daftar"] == 2) { ?>
                                                    <span class="badge bg-light-success text-success w-100">Aktif</span>
                                                <?php } else if ($row_pendaftaran["status_daftar"] == 1) { ?>
                                                    <span class="badge bg-light-warning text-warning w-100">Diproses</span>
                                                <?php } else if ($row_pendaftaran["status_daftar"] == 0) { ?>
                                                    <span class="badge bg-light-danger text-danger w-100">Data tidak ditemukan</span>
                                                <?php } else { ?>
                                                    <span class="badge bg-light-danger text-danger w-100 text-left"><big>Data tidak ditemukan</big></span>
                                                <?php } ?>
                                            </td>

                                            <td><?php echo $row_pendaftaran["nama_kelas"] ?></td>
                                            <td><?php echo $row_pendaftaran["jenis_kelas"] ?></td>
                                            <td><?php echo $row_pendaftaran["tanggal_mulai"] ?></td>
                                            <td style="white-space: normal;"><?php echo $row_pendaftaran["jadwal_kursus"] ?></td>
                                            <td><?php echo $row_pendaftaran["username"] ?></td>
                                            <td><?php echo $row_pendaftaran["nm_user"] ?>,
                                                <?php echo $row_pendaftaran["nm_user2"] ?>,
                                                <?php echo $row_pendaftaran["nm_user3"] ?>,
                                                <?php echo $row_pendaftaran["nm_user4"] ?></td>
                                            <td><?php echo $row_pendaftaran["tempat_lahir"] ?></td>
                                            <td><?php echo $row_pendaftaran["tanggal_lahir"] ?></td>
                                            <td><?php echo $row_pendaftaran["email"] ?></td>
                                            <td><?php echo $row_pendaftaran["telp"] ?>,
                                                <?php echo $row_pendaftaran["telp2"] ?>,
                                                <?php echo $row_pendaftaran["telp3"] ?>,
                                                <?php echo $row_pendaftaran["telp4"] ?>,
                                            </td>
                                            <td><?php echo $row_pendaftaran["lama_pendidikan"] ?></td>
                                            <td><?php echo $row_pendaftaran["biaya"] ?></td>
                                            <td>
                                                <a href="../assets/images/bukti_transfer/<?php echo $row_pendaftaran["bukti_transfer"] ?>" target="_blank"><?php echo $row_pendaftaran["bukti_transfer"] ?> <i class="lni lni-link"></i></a>
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