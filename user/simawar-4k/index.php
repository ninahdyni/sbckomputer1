<?php

session_start();

if (isset($_SESSION["login"])) {
    header("Location: logout.php");
    exit;
}

include "koneksi.php";

if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM tbl_user WHERE username = '$username' && status = 1 ";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {

            $_SESSION["login"] = true;
            $_SESSION["id_user"] = $row["id_user"];
            $_SESSION["level"] = $row["level"];

            if ($row["level"] == 1) {
                header("Location: sadmin/index.php");
            } else if ($row["level"] == 2) {
                header("Location: admin/index.php");
            } else if ($row["level"] == 3) {
                header("Location: user/index.php");
            } else if ($row["level"] == 4) {
                header("Location: pimpinan/index.php");
            }

            exit;
        }
    }

    $error = true;
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
    <title>Simawar - Login</title>
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
                                        <h3 class="">Sistem Informasi Surat Masuk dan Keluar (Simawar)</h3>
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
                                                    <div class="text-dark">Username atau Password SALAH...!</div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php } ?>

                                    <div class="form-body">
                                        <form class="row g-3" method="POST" action="">
                                            <div class="col-12">
                                                <label for="username" class="form-label">Username :</label>
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Password :</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" name="password" id="password" placeholder="Password" required>
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-end"> <a href="lupa.php">Lupa Password ?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary" name="submit"><i class="bx bxs-lock-open"></i>Sign in</button>
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
</body>

</html>