<?php

session_start();

include "koneksi.php";

if (isset($_POST["submit"])) {

    $nik = $_POST["nik"];
    $telp = $_POST["telp"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query_nik = "SELECT nik FROM tbl_admin WHERE nik = '$nik'";
    $result_nik = mysqli_query($conn, $query_nik);
    if (mysqli_num_rows($result_nik) === 0) {
        echo "<script>
            alert('Reset Gagal,NIK/NIP Tidak Ditemukan');
            history.go(-1);
        </script>";
        return false;
    }

    $query_telp = "SELECT telp FROM tbl_admin WHERE telp = '$telp'";
    $result_telp = mysqli_query($conn, $query_telp);
    if (mysqli_num_rows($result_telp) === 0) {
        echo "<script>
            alert('Reset Gagal,Nomor Telpon Tidak Ditemukan');
            history.go(-1);
        </script>";
        return false;
    }

    $query_email = "SELECT email FROM tbl_admin WHERE email = '$email'";
    $result_email = mysqli_query($conn, $query_email);
    if (mysqli_num_rows($result_email) === 0) {
        echo "<script>
            alert('Reset Gagal,Email Tidak Ditemukan');
            history.go(-1);
        </script>";
        return false;
    }

    $query_reset = "UPDATE tbl_admin SET password = '$password' WHERE nik = '$nik'";
    $result_reset = mysqli_query($conn, $query_reset);

    if ($result_reset) {
        echo "<script>
            alert('Reset Berhasil, Password Diubah Menjadi : admin');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Reset Gagal, Silahkan Coba Lagi');
            history.go(-1);
        </script>";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>Simawar - Lupa Password</title>
</head>

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
                                        <p>Silahkan masukkan/cocokkan data dibawah ini dengan data Anda,apabila berhasil maka password akan direset menjadi : <b>admin</b></p>
                                    </div>

                                    <div class="form-body">
                                        <form class="row g-3" method="POST" action="">
                                            <div class="col-12">
                                                <label for="nik" class="form-label">NIK/NIP :</label>
                                                <input type="number" class="form-control" name="nik" id="nik" placeholder="NIK/NIP terdaftar" required>
                                            </div>


                                            <div class="col-12">
                                                <label for="telp" class="form-label">Telpon :</label>
                                                <input type="number" class="form-control" name="telp" id="telp" placeholder="No Telpon terdaftar" required>
                                            </div>


                                            <div class="col-12">
                                                <label for="email" class="form-label">Email :</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email terdaftar" required>
                                            </div>

                                            <input type="hidden" name="password" value="$2y$10$Kr.T5mbxBcT5SgIKBiILnuIFGPlVyikP0e9DzmRcC7KoYYxLbGFEG">

                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary" name="submit"><i class="bx bxs-lock-open"></i>Reset Password</button>
                                                    <a href="index.php" class="btn btn-secondary mt-2">Back to Login</a>
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

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>