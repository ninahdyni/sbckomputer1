<?php

include "koneksi.php";
include("includes/header.php");

if (isset($_SESSION['id_user'])) {
    // Pengguna sudah login, lanjutkan menampilkan profil
    $id_user = $_SESSION['id_user'];
    // Tampilkan profil pengguna dengan ID $id_user
}

$id_user = $_SESSION["id_user"];

$query_user = "SELECT * FROM user WHERE id_user = $id_user";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);

$product_id = $_GET['id'];

$query_program = "SELECT * FROM program WHERE id_program = $product_id";
$result_program = mysqli_query($conn, $query_program);
$row_program = mysqli_fetch_assoc($result_program);

if (isset($_POST["submit"])) {
    // Pengguna mengklik tombol "Submit"

    // Ambil data dari formulir
    $id_user = $_POST["id_user"];
    $id_program = $_POST["id_program"];
    $tanggal_mulai = $_POST["tanggal_mulai"];
    $tgl_pendaftaran = $_POST["tgl_pendaftaran"];
    $id_team = "0";
    $status_daftar = 1;
    $nm_user2 = "";
    $nm_user3 = "";
    $nm_user4 = "";
    $telp2 = "";
    $telp3 = "";
    $telp4 = "";

    $allowed_extensions = array('jpg', 'jpeg', 'png');

    if (!empty($_FILES['bukti_transfer']['name']) && !empty($_FILES['bukti_transfer']['tmp_name'])) {
        $bukti_transfer_file_extension = pathinfo($_FILES['bukti_transfer']['name'], PATHINFO_EXTENSION);
        $bukti_transfer_file_size = $_FILES['bukti_transfer']['size'];

        if (!in_array($bukti_transfer_file_extension, $allowed_extensions)) {
            die("Error: Hanya file JPG, JPEG, atau PNG yang diperbolehkan untuk bukti_transfer.");
        } elseif ($bukti_transfer_file_size > 1048576) { // 1 MB
            die("Error: Ukuran file bukti_transfer melebihi batas maksimum 1 MB.");
        } else {
            // File bukti_transfer valid, lanjutkan dengan proses penyimpanan
            $bukti_transfer_file_name = "bukti_transfer_" . $id_user . "." . $bukti_transfer_file_extension;
            $bukti_transfer_target_path = "../admin_area/sadmin/assets/images/bukti_transfer/" . $bukti_transfer_file_name;
            move_uploaded_file($_FILES['bukti_transfer']['tmp_name'], $bukti_transfer_target_path);
        }
    } else {
        die("<script>
        alert('Error: File bukti_transfer tidak diunggah.');
        history.go(-1);
    </script>");
    }

    // Ambil jadwal kursus yang dipilih dari $_POST
    $selectedSchedules = $_POST["selected_schedule"];

    // Pastikan ada jadwal yang dipilih sebelum menyimpan ke database
    if (!empty($selectedSchedules)) {
        // Gabungkan jadwal kursus yang dipilih menjadi satu string (misalnya, dengan koma sebagai pemisah)
        $selectedSchedulesString = implode(', ', $selectedSchedules);

        // Selanjutnya, masukkan data ke tabel pendaftaran
        $query = "INSERT INTO pendaftaran (id_user, nm_user2, nm_user3, nm_user4, telp2, telp3, telp4, id_program, tanggal_mulai, jadwal_kursus, bukti_transfer, id_team, status_daftar, tgl_pendaftaran) VALUES ('$id_user', '$nm_user2','$nm_user3','$nm_user4', '$telp2','$telp3','$telp4', '$id_program', '$tanggal_mulai', '$selectedSchedulesString', '$bukti_transfer_file_name', '$id_team', '$status_daftar', '$tgl_pendaftaran')";
        $simpan = mysqli_query($conn, $query);

        if ($simpan) {
            // Mendapatkan ID pendaftaran terbaru
            $id_pendaftaran_terbaru = mysqli_insert_id($conn);

            echo "<script>
                alert('Pendaftaran berhasil disimpan!');
                document.location.href = 'evaluasi.php?id=$id_pendaftaran_terbaru'; // Pengalihan ke evaluasi.php dengan id_pendaftaran terbaru
                </script>";
        } else {
            echo "<script>
                alert('Gagal menyimpan pendaftaran');
                history.go(-1);
            </script>";
        }
    } else {
        echo "<script>
            alert('Pilih setidaknya satu jadwal kursus sebelum menyimpan pendaftaran.');
            history.go(-1);
        </script>";
    }
}

?>

<main id="main">

    <body class="bg-login">
        <div class="wrapper">
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-6 my-lg-0">
                <div class="container-fluid"> <!-- Tambahkan class "container" di sini -->
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col-md mx-auto" style="width: 100%; margin: 0 auto;"> <!-- Menambahkan style untuk mengatur lebar -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="border p-6 rounded">
                                        <div class="login-separater text-center mb-4"> <span>FORM PENDAFTARAN KELAS KURUSUS</span>
                                            <hr />
                                        </div>

                                        <div class="form-body mb-3">
                                            <form class="row g-6" method="POST" target="" enctype="multipart/form-data" style="border: 2px solid #ffffff; padding: 10px;">
                                                <div class="form-group col-md-5">
                                                    <label for="nm_user" class="form-label">Nama Lengkap</label>
                                                    <input type="text" name="nm_user" id="nm_user" class="form-control" value="<?php echo $row_user["nm_user"] ?>" placeholder="Nama Lengkap dengan gelar" required>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <label for="id_program" class="form-label">Nama Kelas</label>
                                                    <select name="id_program" id="id_program" class="form-select" readonly>
                                                        <option value="<?php echo $row_program["id_program"] ?>"><?php echo $row_program["nama_kelas"] ?></option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?php echo $row_user["tempat_lahir"] ?>" placeholder="Masukan Tempat Lahir Kamu" required>
                                                </div>


                                                <div class="form-group col-md-5">
                                                    <label for="jenis_kelas" class="form-label">Jenis Kelas</label>
                                                    <input type="text" name="jenis_kelas" id="jenis_kelas" class="form-control" value="<?php echo $row_program["jenis_kelas"] ?>" placeholder="Masukan Pekerjaan Kamu" readonly>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?php echo $row_user["tanggal_lahir"] ?>" placeholder="Masukan Tempat Lahir Kamu" required>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <label for="lama_pendidikan" class="form-label">Lama Pendidikan</label>
                                                    <input type="text" name="lama_pendidikan" id="lama_pendidikan" class="form-control" value="<?php echo $row_program["lama_pendidikan"] ?>" placeholder="Masukan Pekerjaan Kamu" readonly>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $row_user["email"] ?>" placeholder="Email Aktif" required>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <label for="tanggal_mulai" class="form-label"><b>Tanggal Mulai</b></label>
                                                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
                                                </div>


                                                <div class="form-group col-md-5">
                                                    <label for="telp" class="form-label">Telpon</label>
                                                    <input type="number" name="telp" id="telp" class="form-control" value="<?php echo $row_user["telp"] ?>" placeholder="Telpon Aktif WA" required>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <label for="biaya" class="form-label">Biaya Pendidikan</label>
                                                    <input type="text" name="biaya" id="biaya" class="form-control" value="<?php echo $row_program["biaya"] ?>" placeholder="Masukan Pekerjaan Kamu" readonly>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <label for="bukti_transfer" class="form-label">Upload Bukti Transfer :</label>
                                                    <input class="form-control" type="file" name="bukti_transfer" id="bukti_transfer" required>
                                                    <small>File format .JPG .JPEG .PNG dengan ukuran maksimal 1 MB</small>
                                                </div>


                                                <div class="form-group col-md-6">
                                                    <label for="kode_promo" class="form-label">Kode Promo</label>
                                                    <div class="input-group">
                                                        <input type="text" name="kode_promo" id="kode_promo" class="form-control" placeholder="Masukkan kode promo">
                                                        <button type="button" class="btn btn-secondary" id="cekPromo">Cek Promo</button>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label class="form-label" style="text-align: left; margin-left: 10px; font-weight: bold;">Pilih Jadwal Kursus: (Silahkan Pilih minimal 3 Jadwal Kursus)</label>
                                                        <?php
                                                        $hari_jadwal = array(
                                                            "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"
                                                        );

                                                        $jam_jadwal = array(
                                                            "10.00-12.00", "14.00-16.00", "16.00-18.00", "19.30-21.30"
                                                        );

                                                        echo '<style>';
                                                        echo '.form-check-label { display: flex; align-items: center; margin-right: 0px; }'; // Menggunakan flexbox untuk mengatur tata letak
                                                        echo '.form-check-input { margin: 0; }'; // Menghilangkan margin pada tombol checkbox
                                                        echo '.hari { margin-left: 10px; }'; // Menambahkan margin kiri pada elemen dengan kelas hari
                                                        echo '.jadwal { margin-left: 10px; }'; // Menambahkan margin kiri pada div jadwal
                                                        echo '</style>';

                                                        foreach ($hari_jadwal as $hari) {
                                                            echo '<div class="hari">' . $hari . '</div>';
                                                            echo '<div class="jadwal">';
                                                            foreach ($jam_jadwal as $jam) {
                                                                echo '<div class="form-check form-check-inline">';
                                                                echo '<input class="form-check-input" type="checkbox" name="selected_schedule[]" id="' . $hari . '_' . $jam . '" value="' . $hari . ': ' . $jam . '" >';
                                                                echo '<label class="form-check-label" for="' . $hari . '_' . $jam . '"> ' . $jam . '</label>';
                                                                echo '</div>';
                                                            }
                                                            echo '</div>';
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="form-group col-md-6" style="display: flex; flex-direction: column; align-items: left; text-align: left;">
                                                        <label class="form-label" style="font-weight: bold; text-align: left; position: relative; left: -90px;">LKP SULTAN BERUNTUNG CENTRE KURSUS KOMPUTER</label>
                                                        <img src="../assets/img/rekening.jpeg" alt="Logo" style="width: 250px; height: 300px; margin-top: 10px;">
                                                        <img src="../assets/img/qris.png" alt="Logo" style="width: 250px; height: 100px; margin-top: 10px;">
                                                    </div>
                                                </div>

                                                <input type="hidden" name="id_team" value="0">
                                                <input type="hidden" name="status_daftar" value="1">
                                                <input type="hidden" name="id_user" value="<?php echo $row_user["id_user"] ?>">
                                                <input type="hidden" name="tgl_pendaftaran" value="<?php echo date("Y-m-d H:i:s") ?>">

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
                </div>
            </div>
        </div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    </body>
</main>
<br></br>

<?php include("includes/footer.php"); ?>

<script>
    $(document).ready(function() {
        $("#cekPromo").click(function() {
            var kodePromo = $("#kode_promo").val();

            // Lakukan permintaan AJAX untuk mengambil data promo berdasarkan kode
            $.ajax({
                type: 'POST',
                url: 'get_promo_data.php',
                data: {
                    kode_promo: kodePromo
                },
                success: function(response) {
                    var data = JSON.parse(response);

                    if (data.success) {
                        // Cek apakah kelas dari promo cocok dengan id_program
                        if (data.id_program === '<?php echo $row_program["id_program"] ?>') {
                            // Tampilkan biaya promo dari promo
                            $("#biaya").val(data.biaya);

                            // Update biaya asli ke biaya promo
                            $("#biaya").attr("readonly", true);
                            $("#biaya").addClass("disabled");

                            // Update nilai 'terpakai' di tabel promo
                            $.ajax({
                                type: 'POST',
                                url: 'update_promo_usage.php',
                                data: {
                                    kode_promo: kodePromo
                                }
                            });
                        } else {
                            // Kelas tidak sesuai, tampilkan pesan kesalahan
                            alert('Kode promo tidak dapat digunakan untuk kelas ini.');
                        }
                    } else {
                        // Promo tidak ditemukan atau tidak valid, atau batas penggunaan tercapai
                        if (data.message) {
                            alert(data.message);
                        } else {
                            alert('Kode promo tidak valid.');
                        }

                        // Tetapkan biaya asli
                        $("#biaya").attr("readonly", false);
                        $("#biaya").removeClass("disabled");
                    }
                }
            });
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