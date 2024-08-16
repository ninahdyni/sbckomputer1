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
    <title>Simawar - Data Promo</title>
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
                                <li class="breadcrumb-item active" aria-current="page">Data Promo</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <h5 class="my-4 text-uppercase">Data Promo</h5>
                <div class="row">
                    <div class="col-md-6">
                        <label for="judul" class="form-label"><b> PILIH PROMO :</b></label>
                        <select name="judul" id="judul" class="form-select" required>
                            <option value="">Pilih Promo...</option>
                            <?php
                            $query_promo = "SELECT promo.*, program.nama_kelas 
                                            FROM promo 
                                            INNER JOIN program ON promo.id_program = program.id_program";
                            $result_promo = mysqli_query($conn, $query_promo);
                            while ($row_promo = mysqli_fetch_assoc($result_promo)) {
                            ?>
                                <option value="<?php echo $row_promo["judul"] ?>"><?php echo $row_promo["judul"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <a href="promo-tambah.php" class="btn btn-primary"><i class='bx bx-plus me-1'></i>Tambah Program</a>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col">
                        <div class="card radius-10 mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h5 class="mb-1">Promo Yang Dipilih</h5>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="example2" class="table table-hover table-bordered">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Action</th>
                                                <th>Judul Promo</th>
                                                <th>Kelas Promo</th>
                                                <th>kode Promo</th>
                                                <th>Pesan 1</th>
                                                <th>Pesan 2</th>
                                                <th>Biaya Promo</th>
                                                <th>Batas</th>
                                                <th>Terpakai</th>
                                            </tr>
                                        </thead>
                                        <tbody id="promoTableBody">

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
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Tempat Lahir</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Pekerjaan</th>
                                                <th>Telpon</th>
                                                <th>Email</th>
                                                <th>Tanggal Reg</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query_users = "SELECT * FROM user ORDER BY id_user DESC";
                                            $result_users = mysqli_query($conn, $query_users);
                                            while ($row_users = mysqli_fetch_assoc($result_users)) { ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex order-actions">
                                                            <a href="../user/user-edit.php?id=<?php echo $row_users["id_user"] ?>" class="text-light bg-success border-0"><i class='bx bxs-edit'></i></a>
                                                            <a href="javascript:void(0);" onclick="kirimEmail(<?php echo $row_users["id_user"] ?>, '<?php echo $row_users["email"] ?>', '<?php echo $row_users["nm_user"] ?>')" class="ms-4 text-light bg-primary border-0"><i class='bx bxs-inbox'></i></a>
                                                            <a href="javascript:void(0);" onclick="kirimPesanWhatsApp(<?php echo $row_users["id_user"] ?>, '<?php echo $row_users["telp"] ?>', '<?php echo $row_users["nm_user"] ?>')" class="ms-4 text-light bg-info border-0"><i class='bx bxs-phone'></i></a>
                                                            </a>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <img src="../assets/images/users/<?php echo $row_users["foto"] ?>" alt="<?php echo $row_users["foto"] ?>" width="50" class="rounded-circle p-1 border">
                                                    </td>
                                                    <td><?php echo $row_users["nm_user"] ?></td>
                                                    <td><?php echo $row_users["username"] ?></td>
                                                    <td><?php echo $row_users["tempat_lahir"] ?></td>
                                                    <td><?php echo $row_users["tanggal_lahir"] ?></td>
                                                    <td><?php echo $row_users["pekerjaan"] ?></td>
                                                    <td>
                                                        <a href="tel:<?php echo $row_users["telp"] ?>"><?php echo $row_users["telp"] ?></a>
                                                    </td>
                                                    <td>
                                                        <a href="mailto:<?php echo $row_users["email"] ?>"><?php echo $row_users["email"] ?></a>
                                                    </td>
                                                    <td><?php echo $row_users["tgl_reg"] ?></td>
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
        document.getElementById('judul').addEventListener('change', function() {
            var selectedValue = this.value;
            var promoTableBody = document.getElementById('promoTableBody');

            // Kosongkan isi tabel terlebih dahulu
            promoTableBody.innerHTML = '';

            // Ambil data promo sesuai dengan pilihan pengguna
            <?php
            $query_promo = "SELECT promo.*, program.nama_kelas 
                                            FROM promo 
                                            INNER JOIN program ON promo.id_program = program.id_program";
            $result_promo = mysqli_query($conn, $query_promo);
            while ($row_promo = mysqli_fetch_assoc($result_promo)) {
            ?>
                if ("<?php echo $row_promo["judul"] ?>" === selectedValue) {
                    var newRow = promoTableBody.insertRow();
                    var cell1 = newRow.insertCell(0);
                    var cell2 = newRow.insertCell(1);
                    var cell3 = newRow.insertCell(2);
                    var cell4 = newRow.insertCell(3);
                    var cell5 = newRow.insertCell(4);
                    var cell6 = newRow.insertCell(5);
                    var cell7 = newRow.insertCell(6);
                    var cell8 = newRow.insertCell(7);
                    var cell9 = newRow.insertCell(8);

                    cell1.innerHTML = `<div class="d-flex order-actions">
                                    <a href="promo-edit.php?id=<?php echo $row_promo["id_promo"] ?>" class="text-light bg-success border-0"><i class='bx bxs-edit'></i></a>
                                    <a href="promo-hapus.php?id=<?php echo $row_promo["id_promo"] ?>" class="ms-4 text-light bg-warning border-0" onClick="return confirm('Apakah anda yakin ingin menghapus data ini...?')"><i class='bx bxs-trash'></i></a>
                                </div>`;
                    cell2.innerHTML = "<?php echo $row_promo["judul"] ?>";
                    cell3.innerHTML = "<?php echo $row_promo["nama_kelas"] ?>";
                    cell4.innerHTML = "<b><?php echo $row_promo["kode"] ?></b>";
                    cell5.innerHTML = "<pre style='white-space: pre-wrap;'><?php echo $row_promo["pesan1"] ?></pre>";
                    cell6.innerHTML = "<pre style='white-space: pre-wrap;'><?php echo $row_promo["pesan2"] ?></pre>";
                    cell7.innerHTML = "<?php echo $row_promo["biaya_promo"] ?>";
                    cell8.innerHTML = `<span class="badge bg-light-success text-success w-100"><?php echo $row_promo["batas"] ?></span>`;
                    cell9.innerHTML = `<span class="badge bg-light-danger text-danger w-100"><?php echo $row_promo["terpakai"] ?></span>`;

                }
            <?php } ?>
        });
    </script>

    <script>
        // Fungsi untuk mengirim pesan WhatsApp dengan promo yang dipilih
        function kirimPesanWhatsApp(userId, userPhone, userName) {
            var selectPromo = document.getElementById('judul');
            var selectedValue = selectPromo.value;

            // Temukan data promo yang sesuai dengan pilihan pengguna
            <?php
            $query_promo = "SELECT promo.*, program.nama_kelas 
                                            FROM promo 
                                            INNER JOIN program ON promo.id_program = program.id_program";
            $result_promo = mysqli_query($conn, $query_promo);
            while ($row_promo = mysqli_fetch_assoc($result_promo)) {
            ?>
                if ("<?php echo $row_promo["judul"] ?>" === selectedValue) {
                    var nama_kelas = "<?php echo $row_promo["nama_kelas"] ?>";
                    var pesan1 = "<?php echo $row_promo["pesan1"] ?>";
                    var pesan2 = "<?php echo $row_promo["pesan2"] ?>";
                    var kode = "<?php echo $row_promo["kode"] ?>";
                    var nomorTelepon = userPhone;

                    // Periksa apakah nomor telepon sudah termasuk kode negara
                    if (!nomorTelepon.startsWith('+')) {
                        nomorTelepon = '+62' + nomorTelepon;
                    }

                    // Buat tautan WhatsApp dengan pesan, kode, dan data pengguna
                    var tautanWhatsApp = "whatsapp://send?phone=" + nomorTelepon + "&text=" +
                        encodeURIComponent(
                            "Hallo! " + userName + "\n\n" +
                            "Program Kursus " + nama_kelas + "\n\n" +
                            pesan1 + "\n\n" +
                            "KODE PROMO: " + "\n\n" +
                            kode + "\n\n" +
                            pesan2 + "\n\n" +
                            "- SULTAN BERUNTUNG CENTRE"
                        );
                    // Buka tautan WhatsApp dalam jendela baru
                    window.open(tautanWhatsApp, "_blank");
                }
            <?php } ?>
        }
    </script>
    <script>
        function kirimEmail(userId, email, userName) {
            var selectPromo = document.getElementById('judul');
            var selectedValue = selectPromo.value;

            // Temukan data promo yang sesuai dengan pilihan pengguna
            <?php
            $query_promo = "SELECT promo.*, program.nama_kelas 
                                            FROM promo 
                                            INNER JOIN program ON promo.id_program = program.id_program";
            $result_promo = mysqli_query($conn, $query_promo);
            while ($row_promo = mysqli_fetch_assoc($result_promo)) {
            ?>
                if ("<?php echo $row_promo["judul"] ?>" === selectedValue) {
                    var judulPromo = "<?php echo $row_promo["judul"] ?>";
                    var nama_kelas = "<?php echo $row_promo["nama_kelas"] ?>";
                    var pesan1 = "<?php echo $row_promo["pesan1"] ?>";
                    var pesan2 = "<?php echo $row_promo["pesan2"] ?>";
                    var kode = "<?php echo $row_promo["kode"] ?>";
                    var email = email;
                    // Definisikan subjek email
                    var subjek = "Promo: " + judulPromo;

                    // Definisikan isi pesan email
                    var isiPesan = "Halo, " + userName + "\n\n" +
                        "Ini adalah promo khusus untuk Anda:\n" +
                        "KELAS PROMO: " + nama_kelas + "\n\n" +
                        pesan1 + "\n\n" +
                        pesan2 + "\n\n" +
                        "KODE PROMO: " + kode + "\n\n" +
                        "Terima kasih!";

                    // Buat tautan email dengan subjek dan isi pesan
                    var tautanEmail = "mailto:" + email + "?subject=" + encodeURIComponent(subjek) + "&body=" + encodeURIComponent(isiPesan);

                    // Buka tautan email dalam jendela baru
                    window.open(tautanEmail);
                }
            <?php } ?>
        }
    </script>
    <!--app JS-->
    <script src="../assets/js/app.js"></script>
</body>

</html>