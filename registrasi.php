<?php
session_start();

include "koneksi.php";
include("includes/header.php");

if (isset($_POST["submit"])) {

    $username = htmlspecialchars($_POST["username"]);
    $nm_user = htmlspecialchars($_POST["nm_user"]);
    $tempat_lahir = htmlspecialchars($_POST["tempat_lahir"]);
    $tanggal_lahir = htmlspecialchars($_POST["tanggal_lahir"]);
    $pekerjaan = htmlspecialchars($_POST["pekerjaan"]);
    $telp = htmlspecialchars($_POST["telp"]);
    $email = htmlspecialchars($_POST["email"]);
    $foto = htmlspecialchars($_POST["foto"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Menggunakan password_hash()
    $tgl_reg = htmlspecialchars($_POST["tgl_reg"]);
    $id_bagian = 4;

    $query = "INSERT INTO user VALUES (NULL, '$username', '$nm_user', '$tempat_lahir','$tanggal_lahir', '$pekerjaan','$telp', '$email', '$foto','$password', '$tgl_reg', '$id_bagian')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script>
            alert('Data Berhasil Disimpan! Silahkan Log In Kembali');
            document.location.href = 'login.php';
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

    <body class="bg-login">
        <div class="wrapper">
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-6 my-lg-0">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col mx-auto">
                            <div class="mb-2 text-center">
                                <img src="assets/images/logo-img.png" width="100" alt="" />
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="border p-6 rounded">
                                        <div class="login-separater text-center mb-4"> <span>SIGN IN HERE</span>
                                            <hr />
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-2" method="POST" action="">
                                            <div class="form-group col-md-12">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" name="username" id="username" class="form-control" placeholder="Username 1 kata saja dan huruf kecil" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="nm_user" class="form-label">Nama Lengkap</label>
                                                <input type="text" name="nm_user" id="nm_user" class="form-control" placeholder="Nama Lengkap dengan gelar" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Masukkan Tempat Lahir Kamu" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Masukkan Pekerjaan Kamu" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="telp" class="form-label">Telepon</label>
                                                <input type="number" name="telp" id="telp" class="form-control" placeholder="Telepon Aktif WA" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Email Aktif" required>
                                            </div>
                                            <div class="form-group col-md-12 form-password">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" name="password" id="password" placeholder="Password" required>
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>

                                            <input type="hidden" name="foto" value="default.png">
                                            <input type="hidden" name="id_bagian" value="4">
                                            <input type="hidden" name="tgl_reg" value="<?php echo date("Y-m-d H:i:s") ?>">

                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary" name="submit"><i class="bx bxs-lock-open"></i>Buat Akun</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <a href="login.php" class="btn btn-secondary mt-2">Back to Login</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</main>
<br></br>

<?php include("includes/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>
<script src="assets/js/app.js"></script>