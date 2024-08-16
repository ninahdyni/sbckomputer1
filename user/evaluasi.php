<?php
include "koneksi.php";
include("includes/header.php");

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
} else {
    echo "<script>
        alert('Anda harus login terlebih dahulu!');
        document.location.href = 'login.php';
        </script>";
    exit;
}

$id_pendaftaran = isset($_GET['id']) ? $_GET['id'] : '';

if (isset($_POST["submit"])) {
    if (isset($_POST["platform"])) {
        $platform = $_POST["platform"];
        echo "<script>alert('Platform: $platform');</script>";
    } else {
        echo "<script>alert('Platform tidak dipilih');</script>";
        exit;
    }
    $query = "INSERT INTO evaluasi (id_evaluasi, id, platform) VALUES (NULL, '$id_pendaftaran', '$platform')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script>
            alert('Evaluasi berhasil disimpan!');
            document.location.href = 'profile.php';
            </script>";
    } else {
        echo "<script>
            alert('Gagal menyimpan evaluasi');
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
                        <div class="col-md mx-auto" style="width: 100%; margin: 0 auto;">
                            <div class="card">
                                <div class="card-body">
                                    <div class="border p-6 rounded">
                                        <div class="login-separater text-center mb-4"> <span>FORM EVALUASI</span>
                                            <hr />
                                        </div>
                                        <div class="form-body mb-3">
                                            <form class="row g-6 custom-form" method="POST">
                                                <div class="form-group col-md-12">
                                                    <label for="platform" class="form-label" style="padding-left: 15px;"><b>Tahu LKP RKP Sultan Beruntung Centre dari:</b></label><br>
                                                    <div class="mb-3" style="padding-left: 15px;">
                                                        <label class="form-label"><b>Media Sosial:</b></label><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="platform" id="instagram" value="instagram">
                                                            <label class="form-check-label" for="instagram">Instagram</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="platform" id="twitter" value="twitter">
                                                            <label class="form-check-label" for="twitter">Twitter</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="platform" id="whatsapp" value="whatsapp">
                                                            <label class="form-check-label" for="whatsapp">Whatsapp</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="platform" id="telegram" value="telegram">
                                                            <label class="form-check-label" for="telegram">Telegram</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="platform" id="email" value="email">
                                                            <label class="form-check-label" for="email">Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3" style="padding-left: 15px;">
                                                        <label class="form-label"><b>Platform Lain:</b></label><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="platform" id="website" value="website">
                                                            <label class="form-check-label" for="website">Website</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="platform" id="brosur" value="brosur">
                                                            <label class="form-check-label" for="brosur">Brosur</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="platform" id="baleho" value="baleho">
                                                            <label class="form-check-label" for="baleho">Baleho</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="platform" id="spanduk" value="spanduk">
                                                            <label class="form-check-label" for="spanduk">Spanduk</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="platform" id="lainnya" value="lainnya">
                                                            <label class="form-check-label" for="radio">Lainnya</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">

                                                <div class="col-12" align="center">
                                                    <button type="submit" class="btn btn-primary px-4" name="submit">Simpan</button>
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
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    </body>
</main>
<br></br>

<?php include("includes/footer.php"); ?>

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
<script src="assets/js/app.js"></script>