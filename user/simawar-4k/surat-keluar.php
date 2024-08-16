<?php


include "koneksi.php";

$id_srt_klr = $_GET["id"];
$query_srt_klr = "SELECT U.nm_user, K.* FROM tbl_user U, tbl_srt_klr K WHERE U.id_user = K.penandatangan AND  id_srt_klr = $id_srt_klr";
$result_srt_klr = mysqli_query($conn, $query_srt_klr);
$row_srt_klr = mysqli_fetch_assoc($result_srt_klr);

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
    <title>Simawar - Surat Keluar</title>
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
                                    <div class="login-separater text-center mb-4"> <span>Validasi Data Surat Keluar</span>
                                        <hr />
                                    </div>

                                    <div class="form-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>No Surat</td>
                                                    <th>: <?php echo $row_srt_klr["no_srt"] ?></th>
                                                </tr>
                                                <tr>
                                                    <td>Tgl Surat</td>
                                                    <th>: <?php echo $row_srt_klr["tgl_srt"] ?></th>
                                                </tr>
                                                <tr>
                                                    <td>Lampiran</td>
                                                    <th>: <?php echo $row_srt_klr["lampiran"] ?></th>
                                                </tr>
                                                <tr>
                                                    <td>Hal</td>
                                                    <th>: <?php echo $row_srt_klr["hal"] ?></th>
                                                </tr>
                                                <tr>
                                                    <td>Tujuan</td>
                                                    <th>: <?php echo $row_srt_klr["untuk"] ?></th>
                                                </tr>
                                                <tr>
                                                    <td>Tgl TTD</td>
                                                    <th>: <?php echo $row_srt_klr["tgl_ttd"] ?></th>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <?php if ($row_srt_klr["status"] == 'New') { ?>
                                                        <th class="text-danger">:Belum Ditandatangani</th>
                                                    <?php } else if ($row_srt_klr["status"] == 'Ditandatangani') { ?>
                                                        <th class="text-info">: <?php echo $row_srt_klr["status"] ?></th>
                                                    <?php } ?>

                                                </tr>
                                            </tbody>
                                        </table>
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