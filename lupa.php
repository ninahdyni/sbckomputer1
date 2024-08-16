<?php
session_start();

include "koneksi.php";
include("includes/header.php");

if (isset($_POST["submit"])) {
    $telp = $_POST["telp"];
    $email = $_POST["email"];
    $password1 = mysqli_real_escape_string($conn, $_POST["password"]);
    $password2 = mysqli_real_escape_string($conn, $_POST["konfirmasiPassword"]);

    if ($password1 !== $password2) {
        echo "<script>
            alert('Ubah password gagal, konfirmasi password tidak sama');
            history.go(-1);
            </script>";
    } else {
        // Hash kata sandi baru menggunakan password_hash
        $passwordHash = password_hash($password1, PASSWORD_DEFAULT);

        $query_telp = "SELECT telp FROM user WHERE telp = '$telp'";
        $result_telp = mysqli_query($conn, $query_telp);
        if (mysqli_num_rows($result_telp) === 0) {
            echo "<script>
                alert('Reset Gagal, Nomor Telpon Tidak Ditemukan');
                history.go(-1);
                </script>";
        }

        $query_email = "SELECT email FROM user WHERE email = '$email'";
        $result_email = mysqli_query($conn, $query_email);
        if (mysqli_num_rows($result_email) === 0) {
            echo "<script>
                alert('Reset Gagal, Email Tidak Ditemukan');
                history.go(-1);
                </script>";
        }

        // Perbarui kata sandi ke database
        $query_reset = "UPDATE user SET password = '$passwordHash' WHERE email = '$email'";
        $result_reset = mysqli_query($conn, $query_reset);

        if ($result_reset) {
            echo "<script>
                alert('Reset Berhasil, Silahkan Log In Kembali');
                document.location.href = 'login.php';
                </script>";
        } else {
            echo "<script>
                alert('Reset Gagal, Silahkan Coba Lagi');
                history.go(-1);
                </script>";
        }
    }
}
?>

<main id="main">

    <body class="bg-login">
        <div class="wrapper">
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col mx-auto">
                            <div class="mb-2 text-center">
                                <img src="assets/images/logo-img.png" width="100" alt="" />
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <h3 class="">Lupa Password?</h3>
                                            <p>Silahkan masukkan/cocokkan data dibawah ini dengan data Anda untuk Mengganti Password</p>
                                        </div>

                                        <div class="form-body">
                                            <form class="row g-3" method="POST" action="">

                                                <div class="form-group">
                                                    <label for="telp" class="form-label">Telpon</label>
                                                    <input type="number" name="telp" id="telp" class="form-control" placeholder="No Telpon terdaftar" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email terdaftar" required>
                                                </div>
                                                <div class="form-group form-password">
                                                    <label for="password" class="form-label">Password Baru</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" class="form-control border-end-0" name="password" id="password" placeholder="Password" required>
                                                        <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                    </div>
                                                </div>
                                                <div class="form-group form-password">
                                                    <label for="konfirmasiPassword" class="form-label">Ulangi Password Baru</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" class="form-control border-end-0" name="konfirmasiPassword" id="konfirmasiPassword" placeholder="Password" required>
                                                        <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary" name="submit"><i class="bx bxs-lock-open"></i>Reset Password</button>
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
        </div>
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