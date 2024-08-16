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
// Proses jika tombol "Submit" pada langkah terakhir diklik
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $id_user = $_POST["id_user"];
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
    $query_insert = "INSERT INTO registrasi VALUES(NULL, '$id_user', '$ktp_file_name', '$bukti_registrasi_file_name', '$status_regis')";
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<body classname="snippet-body">

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

                        <!-- MultiStep Form -->
                        <div class="container-fluid" id="grad1">
                            <div class="row justify-content-center mt-0">
                                <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
                                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                                        <h2><strong>Sign Up Your User Account</strong></h2>
                                        <p>Fill all form field to go to next step</p>
                                        <div class="row">
                                            <div class="col-md-20 mx-0">
                                                <form id="msform" target="" method="post" role="form" enctype="multipart/form-data">
                                                    <!-- progressbar -->
                                                    <ul id="progressbar" style="margin-left: 40px;">
                                                        <li id="account"><strong>Account</strong></li>
                                                        <li class="active" id="personal"><strong>Personal</strong></li>
                                                        <li id="confirm"><strong>Finish</strong></li>
                                                    </ul>
                                                    <!-- fieldsets -->
                                                    <fieldset>
                                                        <div class="form-card">
                                                            <h2 class="fs-title">Personal Information</h2>
                                                            <p>Thank you for registering. Here are the details you provided:</p>
                                                            <ul>
                                                                <li><strong>Full Name:</strong> <?php echo $row_user["nm_user"]; ?></li>
                                                                <li><strong>Email:</strong> <?php echo $row_user["email"]; ?></li>
                                                                <li><strong>Phone:</strong> <?php echo $row_user["telp"]; ?></li>
                                                                <input type="hidden" name="id_user" value="<?php echo $row_user["id_user"] ?>">
                                                            </ul>
                                                            <p>Please confirm your registration by clicking the button below:</p>
                                                        </div>
                                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous">
                                                        <input type="button" name="next" class="next action-button" id="next-button" value="Konfirmasi WA" onclick="openWhatsApp()">
                                                        <script>
                                                            function openWhatsApp() {
                                                                var phoneNumber = "6288242739374"; // Ganti dengan nomor WhatsApp yang sesuai
                                                                var userName = "<?php echo rawurlencode($row_user["nm_user"]); ?>"; // Ganti dengan pengambilan nama pengguna dari PHP
                                                                var message = "Konfirmasi Nama Saya " + userName + " registrasi saya di website";
                                                                window.open("https://web.whatsapp.com/send?phone=" + phoneNumber + "&text=" + message, "_blank");
                                                            }
                                                        </script>

                                                    </fieldset>

                                                    <fieldset>
                                                        <div class="form-card">
                                                            <h2 class="fs-title text-center">Success !</h2>
                                                            <br><br>
                                                            <div class="row justify-content-center">
                                                                <div class="col-3">
                                                                    <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                                                                </div>
                                                            </div>
                                                            <br><br>
                                                            <div class="row justify-content-center">
                                                                <div class="col-7 text-center">
                                                                    <h5>You Have Successfully Signed Up</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="profile.php">
                                                            <input type="button" name="next" class="next action-button" value="Next Step">
                                                        </a>
                                                    </fieldset>
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
            </div>
        </section>
        <?php include("includes/footer.php"); ?>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="#"></script>
        <script type="text/javascript" src="#"></script>
        <script type="text/javascript" src="#"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                var current_fs, next_fs, previous_fs; //fieldsets
                var opacity;

                $(".next").click(function() {

                    current_fs = $(this).parent();
                    next_fs = $(this).parent().next();

                    //Add Class Active
                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                    //show the next fieldset
                    next_fs.show();
                    //hide the current fieldset with style
                    current_fs.animate({
                        opacity: 0
                    }, {
                        step: function(now) {
                            // for making fielset appear animation
                            opacity = 1 - now;

                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            next_fs.css({
                                'opacity': opacity
                            });
                        },
                        duration: 600
                    });
                });

                $(".previous").click(function() {

                    current_fs = $(this).parent();
                    previous_fs = $(this).parent().prev();

                    //Remove class active
                    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

                    //show the previous fieldset
                    previous_fs.show();

                    //hide the current fieldset with style
                    current_fs.animate({
                        opacity: 0
                    }, {
                        step: function(now) {
                            // for making fielset appear animation
                            opacity = 1 - now;

                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            previous_fs.css({
                                'opacity': opacity
                            });
                        },
                        duration: 600
                    });
                });

                $('.radio-group .radio').click(function() {
                    $(this).parent().find('.radio').removeClass('selected');
                    $(this).addClass('selected');
                });

                $(".submit").click(function() {
                    return false;
                })

            });
        </script>
        <script type="text/javascript">
            var myLink = document.querySelector('a[href="#"]');
            myLink.addEventListener('click', function(e) {
                e.preventDefault();
            });
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

</body>

</html>