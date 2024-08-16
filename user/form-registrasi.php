<?php

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

$query_user = "SELECT user.username, program.nama_kelas FROM user LEFT JOIN program ON user.id_program = program.id_program";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);

?>

<main id="main">
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Form Registrasi</h2>
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li>Form Registrasi</li>
                </ol>
            </div>
        </div>
    </section><!-- Breadcrumbs Section -->
    <section class="inner-page">
        <div class="container">
            <div class="row gy-4">
                <div class="container-body">
                    <h2>Sign up to a great new account</h2>
                    <form method="POST" id="signup-form" class="signup-form">
                        <h3>
                            <span class="title_text">Account Information</span>
                        </h3>
                        <fieldset>
                            <div class="fieldset-content">
                                <div class="form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username" value="<?php echo $row_user["username"] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" value="<?php echo $row_user["email"] ?>" placeholder="Your Email" />
                                </div>
                                <div class="form-group">
                                    <label for="foto_ktp" class="form-label">Foto KTP</label>
                                    <div class="form-file">
                                        <input type="file" name="foto_ktp" id="foto_ktp" class="custom-file-input" required />
                                        <span id='val_foto_ktp'></span>
                                        <a href="#" id='button_foto_ktp' class="btn btn-secondary">Select File</a>
                                        <small>File format .JPG .JPEG .PNG with a maximum size of 1 MB</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bukti_registrasi" class="form-label">Bukti Registrasi</label>
                                    <div class="form-file">
                                        <input type="file" name="bukti_registrasi" id="bukti_registrasi" class="custom-file-input" required />
                                        <span id='val_bukti_registrasi'></span>
                                        <a href="#" id='button_bukti_registrasi' class="btn btn-secondary">Select File</a>
                                        <small>File format .JPG .JPEG .PNG with a maximum size of 1 MB</small>
                                    </div>
                                </div>


                            </div>
                            <div class="fieldset-footer">
                                <span>Step 1 of 3</span>
                            </div>
                        </fieldset>
                        <h3>
                            <span class="title_text">Account Confirmation</span>
                        </h3>
                        <fieldset id="step-2" style="display: block;">
                            <p>Thank you for registering. Here are the details you provided:</p>
                            <ul>
                                <li><strong>Full Name:</strong> <?php echo $row_user["nm_user"]; ?></li>
                                <li><strong>Email:</strong> <?php echo $row_user["email"]; ?></li>
                                <li><strong>Phone:</strong> <?php echo $row_user["telp"]; ?></li>
                            </ul>
                            <p>Please confirm your registration by clicking the button below:</p>
                            <a href="https://web.whatsapp.com/send?phone=6288242739374&text=Konfirmasi%20Nama%20Saya%20<?php echo urlencode($row_user["nm_user"]); ?>%0ARegistrasi%20saya%20di%20website" target="_blank" class="btn btn-primary" id="confirm-button">Confirm via WhatsApp</a>

                            <div class="fieldset-footer">
                                <span>Step 2 of 3</span>
                            </div>
                        </fieldset>

                        <h3>
                            <span class="title_text">Verification</span>
                        </h3>
                        <fieldset id="step-3" style="display: none;">
                            <p>Pendaftaran anda Sudah diterima mohon tunggu konfirmasi nya </p>
                            <div class="fieldset-footer">
                                <span>Step 3 of 3</span>
                            </div>
                        </fieldset>
                        <div class="actions clearfix">
                            <ul role="menu" aria-label="Pagination">
                                <li class="disabled" aria-disabled="true"><a href="#previous" role="menuitem">Previous</a></li>
                                <li aria-hidden="false" aria-disabled="false"><a href="#next" role="menuitem">Next</a></li>
                                <li aria-hidden="true" style="display: none;"><a href="profile.php" role="menuitem">Submit</a></li>
                            </ul>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
    <?php include("includes/footer.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script>
        function refreshPagination(wizard, options, state) {
            if (options.enablePagination) {
                var finish = wizard.find(".actions a[href$='profile.php']").parent(),
                    next = wizard.find(".actions a[href$='#next']").parent();

                if (!options.forceMoveForward) {
                    var previous = wizard.find(".actions a[href$='#previous']").parent();
                    previous._enableAria(state.currentIndex > 0);
                }

                if (options.enableFinishButton && options.showFinishButtonAlways) {
                    finish._enableAria(state.stepCount > 0);
                    next._enableAria(state.stepCount > 1 && state.stepCount > (state.currentIndex + 1));
                } else {
                    finish._showAria(options.enableFinishButton && state.stepCount === (state.currentIndex + 1));
                    next._showAria(state.stepCount === 0 || state.stepCount > (state.currentIndex + 1)).
                    _enableAria(state.stepCount > (state.currentIndex + 1) || !options.enableFinishButton);
                }
            }
        }
    </script>

    <script>
        // Dalam event handler untuk tombol konfirmasi WhatsApp
        // Fungsi ini akan dipanggil saat dokumen selesai dimuat
        document.addEventListener("DOMContentLoaded", function() {
            // Temukan elemen input file dan tombol "Select File" untuk foto KTP
            var inputFotoKtp = document.getElementById("foto_ktp");
            var buttonFotoKtp = document.getElementById("button_foto_ktp");

            // Tambahkan event listener untuk tombol "Select File"
            buttonFotoKtp.addEventListener("click", function(e) {
                e.preventDefault(); // Mencegah perilaku default tombol
                inputFotoKtp.click(); // Pemicu klik pada input file
            });

            // Ketika pemilihan file berubah, tampilkan nama file
            inputFotoKtp.addEventListener("change", function() {
                var valFotoKtp = document.getElementById("val_foto_ktp");
                valFotoKtp.textContent = inputFotoKtp.value;
            });

            // Lakukan hal yang sama untuk bukti registrasi jika diperlukan
            var inputBuktiRegistrasi = document.getElementById("bukti_registrasi");
            var buttonBuktiRegistrasi = document.getElementById("button_bukti_registrasi");

            buttonBuktiRegistrasi.addEventListener("click", function(e) {
                e.preventDefault();
                inputBuktiRegistrasi.click();
            });

            inputBuktiRegistrasi.addEventListener("change", function() {
                var valBuktiRegistrasi = document.getElementById("val_bukti_registrasi");
                valBuktiRegistrasi.textContent = inputBuktiRegistrasi.value;
            });
        });
        document.querySelector('#step-2').style.display = 'none'; // Sembunyikan langkah 2
        document.querySelector('#step-3').style.display = 'block'; // Tampilkan langkah 3
        document.querySelector('#step-3').scrollIntoView({
            behavior: 'smooth'
        });
        document.getElementById("confirm-button").addEventListener("click", function() {
            // Tampilkan langkah ke-3 (Step 3 of 3)
            document.querySelector('#step-3').style.display = 'block';

            // Gulir ke langkah ke-3
            document.querySelector('#step-3').scrollIntoView({
                behavior: 'smooth'
            });
        });
        // Fungsi untuk mengklik tombol konfirmasi WhatsApp dan beralih ke langkah berikutnya
        function confirmAndNext() {
            // Simpan URL WhatsApp ke dalam variabel
            var whatsappURL = "https://web.whatsapp.com/send?phone=628123456789&text=Konfirmasi%20Nama%20Saya%20" + encodeURIComponent("<?php echo $row_user['nm_user']; ?>") + "%20registrasi%20saya%20di%20website";

            // Buka jendela WhatsApp di tab baru
            window.open(whatsappURL, '_blank');

            // Sembunyikan langkah saat ini (Step 2)
            document.querySelector('#step-2').style.display = 'none';

            // Tampilkan langkah berikutnya (Step 3)
            document.querySelector('#step-3').style.display = 'block';

            // Gulir ke langkah berikutnya
            document.querySelector('#step-3').scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Tambahkan event listener pada tombol konfirmasi WhatsApp
        document.getElementById("confirm-button").addEventListener("click", confirmAndNext);
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

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="vendor/jquery-steps/jquery.steps.min.js"></script>
    <script src="vendor/minimalist-picker/dobpicker.js"></script>
    <script src="vendor/jquery.pwstrength/jquery.pwstrength.js"></script>
    <script src="js/main.js"></script>