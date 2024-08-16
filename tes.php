<?php
session_start();

include "koneksi.php";
include("includes/header.php");

if (isset($_SESSION['id_user'])) {
    // Pengguna sudah login, lanjutkan menampilkan profil
    $id_user = $_SESSION['id_user'];
    // Tampilkan profil pengguna dengan ID $id_user
}
$id_user =  $_SESSION["id_user"];

$query_user = "SELECT * FROM user WHERE id_user = $id_user";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);
// Proses jika tombol "Submit" pada langkah terakhir diklik
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $username = $_POST["username"];
    $nm_user = $_POST["nm_user"];
    $email = $_POST["email"];
    $telp = $_POST["telp"];
    $foto = $_POST["foto"];
    $status_regis = 1;

    // Validasi file KTP
    $allowed_extensions = array('jpg', 'jpeg', 'png');

    if (!empty($_FILES['ktp']['name']) && !empty($_FILES['ktp']['tmp_name'])) {
        $ktp_file_extension = pathinfo($_FILES['ktp']['name'], PATHINFO_EXTENSION);
        $ktp_file_size = $_FILES['ktp']['size'];

        if (!in_array($ktp_file_extension, $allowed_extensions)) {
            die("Error: Hanya file JPG, JPEG, atau PNG yang diperbolehkan untuk KTP.");
        } elseif ($ktp_file_size > 1048576) { // 1 MB
            die("Error: Ukuran file KTP melebihi batas maksimum 1 MB.");
        } else {
            // File KTP valid, lanjutkan dengan proses penyimpanan
            $ktp_file_name = "ktp_" . $id_user . "." . $ktp_file_extension;
            $ktp_target_path = "../admin_area/sadmin/assets/images/ktp/" . $ktp_file_name;
            move_uploaded_file($_FILES['ktp']['tmp_name'], $ktp_target_path);
        }
    } else {
        die("Error: File KTP tidak diunggah.");
    }

    // Validasi file bukti registrasi
    if (!empty($_FILES['bukti_registrasi']['name']) && !empty($_FILES['bukti_registrasi']['tmp_name'])) {
        $bukti_registrasi_file_extension = pathinfo($_FILES['bukti_registrasi']['name'], PATHINFO_EXTENSION);
        $bukti_registrasi_file_size = $_FILES['bukti_registrasi']['size'];

        if (!in_array($bukti_registrasi_file_extension, $allowed_extensions)) {
            die("Error: Hanya file JPG, JPEG, atau PNG yang diperbolehkan untuk bukti registrasi.");
        } elseif ($bukti_registrasi_file_size > 1048576) { // 1 MB
            die("Error: Ukuran file bukti registrasi melebihi batas maksimum 1 MB.");
        } else {
            // File bukti registrasi valid, lanjutkan dengan proses penyimpanan
            $bukti_registrasi_file_name = "bukti_registrasi_" . $id_user . "." . $bukti_registrasi_file_extension;
            $bukti_registrasi_target_path = "../admin_area/sadmin/assets/images/bukti_registrasi/" . $bukti_registrasi_file_name;
            move_uploaded_file($_FILES['bukti_registrasi']['tmp_name'], $bukti_registrasi_target_path);
        }
    } else {
        die("Error: File bukti registrasi tidak diunggah.");
    }

    // Simpan data ke dalam database
    $query_insert = "INSERT INTO registrasi VALUES(NULL, '$username','$nm_user', '$email', '$telp', '$ktp_file_name', '$bukti_registrasi_file_name', '$foto', '$status_regis')";
    $simpan = mysqli_query($conn, $query_insert);

    if ($simpan) {
        echo "<script>
            alert('Data Berhasil Disimpan');
            document.location.href = 'konfirmasi.php';
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

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Form Registrasi</h2>
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Registrasi</a></li>
                    <li>Form Registrasi</li>
                </ol>
            </div>

        </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Form Registrasi Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <!-- partial:index.partial.html -->
            <!-- MultiStep Form -->
            <div class="row gy-4">
                <div class="col-md-12 col-md-offset-0">
                    <form id="msform">
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active">Personal Details</li>
                            <li>Social Profiles</li>
                            <li>Account Setup</li>
                        </ul>
                        <!-- fieldsets -->
                        <fieldset>
                            <h2 class="fs-title">Personal Details</h2>
                            <h3 class="fs-subtitle">Tell us something more about you</h3>
                            <input type="text" name="username" id="username" value="<?php echo $row_user["username"] ?>" placeholder="username" readonly>
                            <input type="email" name="email" id="email" value="<?php echo $row_user["email"] ?>" placeholder="Your Email">

                            <div style="text-align: left;">
                                <label for="ktp" style="text-align: left; margin-right: 10px;">Upload KTP:</label>
                                <input type="file" name="ktp" id="ktp" accept="image/*" style="display: none;" onchange="displayFileName('ktp', 'ktp-file-name')">
                                <button type="button" class="btn btn-secondary" style="margin-right: 10px;" onclick="document.getElementById('ktp').click();">Select File</button>
                                <span id="ktp-file-name"></span>
                                <small>File format .JPG .JPEG .PNG with a maximum size of 1 MB</small>
                            </div>

                            <!-- Tambahkan input file untuk bukti registrasi -->
                            <div style="text-align: left;">
                                <label for="bukti_registrasi" style="text-align: left; margin-right: 10px;">Upload Bukti Registrasi:</label>
                                <input type="file" name="bukti_registrasi" id="bukti_registrasi" accept="image/*" style="display: none;" onchange="displayFileName('bukti_registrasi', 'bukti-registrasi-file-name')">
                                <button type="button" class="btn btn-secondary" style="margin-right: 10px;" onclick="document.getElementById('bukti_registrasi').click();">Select File</button>
                                <span id="bukti-registrasi-file-name"></span>
                                <small>File format .JPG .JPEG .PNG with a maximum size of 1 MB</small>
                            </div>

                            <input type="hidden" name="foto" value="<?php echo $row_user["foto"] ?>">
                            <input type="hidden" name="username" value="<?php echo $row_user["username"] ?>">
                            <input type="hidden" name="telp" value="<?php echo $row_user["telp"] ?>">
                            <input type="hidden" name="nm_user" value="<?php echo $row_user["nm_user"] ?>">
                            <input type="hidden" name="status_regis" value="1">
                            <button type="submit" class="next action-button" name="submit" id="next-button-step1">Submit</button>
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>
                        <fieldset>
                            <h2 class="fs-title">Social Profiles</h2>
                            <h3 class="fs-subtitle">Your presence on the social network</h3>
                            <h2 class="fs-title">Social Profiles</h2>
                            <h3 class="fs-subtitle">Your presence on the social network</h3>
                            <p>Thank you for registering. Here are the details you provided:</p>
                            <ul>
                                <li><strong>Full Name:</strong> <?php echo $row_user["nm_user"]; ?></li>
                                <li><strong>Email:</strong> <?php echo $row_user["email"]; ?></li>
                                <li><strong>Phone:</strong> <?php echo $row_user["telp"]; ?></li>
                            </ul>
                            <p>Please confirm your registration by clicking the button below:</p>
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                            <a href="https://web.whatsapp.com/send?phone=6288242739374&text=Konfirmasi%20Nama%20Saya%20<?php echo urlencode($row_user["nm_user"]); ?>%20registrasi%20saya%20di%20website" target="_blank" id="confirm-button">
                                <input type="button" name="next" class="next action-button" id="next-button" value="Konfirmasi WA">
                            </a>
                        </fieldset>
                        <fieldset>
                            <h2 class="fs-title">Create your account</h2>
                            <h3 class="fs-subtitle">Fill in your credentials</h3>
                            <input type="text" name="email" placeholder="Email" />
                            <input type="password" name="pass" placeholder="Password" />
                            <input type="password" name="cpass" placeholder="Confirm Password" />
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                            <input type="button" name="finish" class="next action-button" value="finish" />
                        </fieldset>
                    </form>
                    <!-- link to designify.me code snippets -->

                    <!-- /.link to designify.me code snippets -->
                </div>
            </div>
        </div>
    </section><!-- End Form Registrasi Section -->

</main><!-- End #main -->

<?php include("includes/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script>
    // Fungsi untuk menampilkan nama file yang dipilih
    function displayFileName(inputId, spanId) {
        var input = document.getElementById(inputId);
        var fileName = input.value.split('\\').pop();
        var span = document.getElementById(spanId);
        span.textContent = fileName;
    }
</script>
<script>
    $(document).ready(function() {
        $.multistepform({
            container: 'multistepform-example-container',
            form_method: 'GET',
        });

        // Tambahkan kode berikut untuk mengatur posisi formulir di tengah halaman
        var formContainer = $('#multistepform-container');
        var windowHeight = $(window).height();
        var formHeight = formContainer.height();

        if (formHeight < windowHeight) {
            var marginTop = (windowHeight - formHeight) / 8;
            formContainer.css('margin-top', marginTop + 'px');
        }
    });
</script>

<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>
<script>
    $(document).ready(function() {
        var currentStep = 1;

        // Fungsi untuk menampilkan langkah tertentu
        function showStep(stepNumber) {
            $(".form").hide();
            $(".step" + stepNumber).show();
        }

        // Menampilkan langkah pertama saat halaman dimuat
        showStep(currentStep);

        // Tombol "Next" untuk pindah ke langkah berikutnya
        $("#next-button").click(function() {
            if (currentStep < 3) {
                currentStep++;
                showStep(currentStep);
            }
        });

        // Tombol "Previous" untuk kembali ke langkah sebelumnya
        $("#previous-button").click(function() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });
</script>
<script>
    // Fungsi untuk menampilkan nama file yang dipilih
    function displayFileName(inputId, spanId) {
        var input = document.getElementById(inputId);
        var fileName = input.value.split('\\').pop();
        var span = document.getElementById(spanId);
        span.textContent = fileName;
    }
</script>
<script>
    $(document).ready(function() {
        var currentStep = 1;

        // ...

        // Fungsi untuk menampilkan langkah tertentu
        function showStep(stepNumber) {
            $(".form").hide();
            $(".step" + stepNumber).show();
            currentStep = stepNumber; // Mengatur langkah saat ini
        }

        // ...
    });
</script>
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
<!-- /.MultiStep Form -->
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<script src="js/script-tes.js"></script>