<?php

include "koneksi.php";
include("includes/header.php");

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
}

$id_user = $_SESSION["id_user"];

$query_user = "SELECT * FROM user WHERE id_user = $id_user";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);

// Update the query to use the correct column name
$query_users = "SELECT u.id_user, r.status_regis, p.status_daftar, s.keterangan, s.file_sertifikat
    FROM user u
    LEFT JOIN registrasi r ON u.id_user = r.id_user
    LEFT JOIN (
        SELECT id_user, id, status_daftar
        FROM pendaftaran
        ORDER BY tgl_pendaftaran DESC
        LIMIT 1
    ) p ON u.id_user = p.id_user
    LEFT JOIN sertifikat s ON p.id = s.id
    WHERE u.id_user = $id_user";

$result_users = mysqli_query($conn, $query_users);

if (mysqli_num_rows($result_users) > 0) {
    $row_users = mysqli_fetch_assoc($result_users);
    $file_sertifikat = $row_users["file_sertifikat"]; // Use the correct column name
} else {
    $row_users = false;
}

if (isset($_POST["submit"])) {

    $username = htmlspecialchars($_POST["username"]);
    $nm_user = htmlspecialchars($_POST["nm_user"]);
    $tempat_lahir = htmlspecialchars($_POST["tempat_lahir"]);
    $tanggal_lahir = htmlspecialchars($_POST["tanggal_lahir"]);
    $pekerjaan = htmlspecialchars($_POST["pekerjaan"]);
    $telp = $_POST["telp"];
    $email = $_POST["email"];
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

        move_uploaded_file($tmpName, '../admin_area/sadmin/assets/images/users/' . $namaFileBaru);

        $foto = $namaFileBaru;
    }

    $query = "UPDATE user SET 
    username = '$username' ,
    nm_user = '$nm_user' ,
    tempat_lahir = '$tempat_lahir' ,
    tanggal_lahir = '$tanggal_lahir' ,
    pekerjaan = '$pekerjaan' ,
    telp = '$telp' ,
    email = '$email' ,
    foto = '$foto'
    WHERE id_user = '$id_user'";
    $update = mysqli_query($conn, $query);

    if ($update) {
        echo "<script>
            alert('Profile anda berhasil diupdate');
            document.location.href = 'profile.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal disimpan');
            history.go(-1);
        </script>";
    }
}
?>
<main id="main">
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Profile Pengguna</h2>
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li>Profile Pengguna</li>
                </ol>
            </div>

        </div>
    </section><!-- Breadcrumbs Section -->
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body px-5 pb-5">
                    <form class="row g-3" method="POST" target="" enctype="multipart/form-data" style="border: 2px solid #ffffff; padding: 10px;">
                        <div class="text-center mb-2" align="center">
                            <img src="../admin_area/sadmin/assets/images/users/<?php echo $row_user["foto"] ?>" class="rounded-circle p-1 border" width="90">
                        </div>

                        <div class="form-group">
                            <label for="status_regis" class="form-label">Status Registrasi :</label>
                            <?php
                            if ($row_users) {
                                if ($row_users["status_regis"] == 2) {
                                    echo '<span class="badge bg-light-success text-success w-100 text-left"><big>Terkonfirmasi</big></span>';
                                } else if ($row_users["status_regis"] == 1) {
                                    echo '<span class="badge bg-light-warning text-warning w-100 text-left"><big>Menunggu Konfirmasi</big></span>';
                                } else if ($row_users["status_regis"] == 0) {
                                    // Tambahkan tautan ke submit.php di sini
                                    echo '<a href="submit.php" class="badge bg-light-danger text-danger w-100 text-left"><big>Klik Untuk Registrasi!!</big></a>';
                                }
                            } else {
                                echo '<span class="badge bg-light-danger text-danger w-100 text-left"><big>Data tidak ditemukan</big></span>';
                            }
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="status_daftar" class="form-label">Status Pendaftaran :</label>
                            <?php
                            if ($row_users) {
                                if ($row_users["status_daftar"] == 2) {
                                    echo '<div class="d-flex align-items-center">';
                                    echo '<span class="badge bg-light-success text-success text-left"><big>Aktif</big><a href="struk.php" style="margin-left: 5px;"><i class="bx bxs-printer" style="font-size: 2em;"></i></a></span>';
                                    echo '</div>';
                                } else if ($row_users["status_daftar"] == 1) {
                                    echo '<span class="badge bg-light-warning text-warning w-100 text-left"><big>Diproses</big></span>';
                                } else if ($row_users["status_daftar"] == 0) {
                                    echo '<a href="index.php#portfolio" class="badge bg-light-danger text-danger w-100 text-left"><big>N I H I L !!</big></a>';
                                }
                            }
                            ?>
                        </div>

                        <?php if ($row_users && $row_users["status_daftar"] == 2) : ?>
                            <div class="form-group">
                                <label for="keterangan" class="form-label">Download Sertifikat :</label>
                                <?php
                                if ($row_users["keterangan"] == 2) {
                                    echo '<div class="d-flex align-items-center">';
                                    echo '<span class="badge bg-light-success text-success text-left"><big>Download Sertifikat</big><a href="../admin_area/sadmin/file-sertifikat/' . $file_sertifikat . '" style="margin-left: 5px;"><i class="bx bxs-printer" style="font-size: 2em;"></i></a></span>';
                                    echo '</div>';
                                } else if (empty($row_users["keterangan"])) {
                                    $nama_user = urlencode($row_user["nm_user"]); // Encode URL
                                    $whatsapp_message = "Halo%20Sultan%20Beruntung%20Centre%20Komputer,%0A%0Asaya%20" . $nama_user . "%20ingin%20mengonfirmasi%20untuk%20mengunduh%20sertifikat%20kursus%20saya.%0A%0ABisakah%20Anda%20membantu%20saya?";
                                    echo '<a href="https://web.whatsapp.com/send?phone=6288242739374&text=' . $whatsapp_message . '" target="_blank" rel="noopener noreferrer" class="badge bg-light-warning text-warning w-100 text-left"><big>Konfirmasi Jika Sudah Menyelesaikan Semua Pertemuan</big></a>';
                                }
                                ?>
                            </div>
                        <?php endif; ?>



                        <div class="form-group">
                            <label for="username" class="form-label">Username :</label>
                            <input type="text" class="form-control" name="username" id="username" value="<?php echo $row_user["username"] ?>" placeholder="Username 1 kata huruf kecil semua" required>
                        </div>
                        <div class="form-group">
                            <label for="nm_user" class="form-label">Nama :</label>
                            <input type="text" class="form-control" name="nm_user" id="nm_user" value="<?php echo $row_user["nm_user"] ?>" placeholder="Nama lengkap dengan gelar" required>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir :</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?php echo $row_user["tempat_lahir"] ?>" placeholder="Tempat Lahir Kamu" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir :</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo $row_user["tanggal_lahir"] ?>" placeholder="Tanggal Lahir Kamu" required>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan" class="form-label">Pekerjaan :</label>
                            <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="<?php echo $row_user["pekerjaan"] ?>" placeholder="Pekerjaan Kamu" required>
                        </div>
                        <div class="form-group">
                            <label for="telp" class="form-label">Telpon :</label>
                            <input type="number" class="form-control" name="telp" id="telp" value="<?php echo $row_user["telp"] ?>" placeholder="Nomor Telpon Aktif WA" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $row_user["email"] ?>" placeholder="Email Aktif" required>
                        </div>
                        <div class="col-12">
                            <label for="foto" class="form-label">Upload Foto :</label>
                            <input class="form-control" type="file" name="foto" id="foto">
                        </div>
                        <small>File format .JPG .JPEG .PNG dengan ukuran maksimal 1 MB</small>
                        <input type="hidden" name="fotoLama" value="<?php echo $row_user["foto"] ?>">
                        <div class="col-12" align="center">
                            <button type="submit" class="btn btn-primary px-4" name="submit">Simpan</button>
                            <button type="button" class="btn btn-secondary px-4" onclick="self.history.back()">Cancel</button>
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
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!--End Back To Top Button-->

    <?php include("includes/footer.php"); ?>

    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="../admin_area/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="../admin_area/assets/js/jquery.min.js"></script>
    <script src="../admin_area/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="../admin_area/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="../admin_area/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--app JS-->
    <script src="../admin_area/assets/js/app.js"></script>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="vendor/jquery-steps/jquery.steps.min.js"></script>
    <script src="vendor/minimalist-picker/dobpicker.js"></script>
    <script src="vendor/jquery.pwstrength/jquery.pwstrength.js"></script>
    <script src="js/main.js"></script>