<?php
session_start();

include "koneksi.php";
include("includes/header.php");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $passwordInput = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    $cek = mysqli_num_rows($result);
    if ($cek > 0) {
        $data = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $data['email'];
        $_SESSION['status'] = 'login';
        $pass = $data['password'];
        $_SESSION["id_user"] = $data["id_user"];
        if (password_verify($passwordInput, $pass)) {
            echo "<script>
                alert('Kamu berhasil Log In');
                document.location.href = 'user/index.php';
            </script>";
            exit;
        } else {
            $error = true;
        }
    } else {
        $error = true;
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
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <img src="assets/img/logo1.png" width="100" alt="" />
                                            <h3 class="">LKP Sultan Beruntung Centre</h3>
                                        </div>
                                        <div class="login-separater text-center mb-4"> <span>SIGN IN HERE</span>
                                            <hr />
                                        </div>

                                        <?php if (isset($error)) { ?>
                                            <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="font-35 text-dark"><i class='bx bx-info-circle'></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="mb-0 text-dark">Warning...!</h6>
                                                        <div class="text-dark">email atau Password SALAH...!</div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php } ?>

                                        <div class="form-body">
                                            <form class="row g-2" method="POST" action="">
                                                <div class="form-group">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
                                                </div>
                                                <div class="form-group form-password">
                                                    <label for="password" class="form-label">Password</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" class="form-control border-end-0" name="password" id="password" placeholder="Password" required>
                                                        <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-end"> <a href="lupa.php">Lupa Password ?</a>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary" name="submit"><i class="bx bxs-lock-open"></i>Log in</button>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <a href="registrasi.php" class="btn btn-secondary mt-2">Belum Punya Akun? Sign Up</a>
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