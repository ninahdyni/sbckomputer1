<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id_user = $_SESSION["id_admin"];

$query_user = "SELECT * FROM tbl_admin WHERE id_admin = $id_user";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);

$query_users = "SELECT * FROM pendaftaran ORDER BY id DESC";
$result_users = mysqli_query($conn, $query_users);
?>

<!doctype html>
<html lang="en" class="<?php echo $row_user["theme"] ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="../assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="../assets/css/pace.min.css" rel="stylesheet" />
    <script src="../assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/app.css" rel="stylesheet">
    <link href="../assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="../assets/css/dark-theme.css" />
    <link rel="stylesheet" href="../assets/css/semi-dark.css" />
    <link rel="stylesheet" href="../assets/css/header-colors.css" />
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Simawar - Data Pendaftaran</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        <?php include "../admin/include/theme-sidebar.php" ?>
        <?php include "../admin/include/theme-header.php" ?>

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="../sadmin/index.php"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Pendaftaran</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->

                <h5 class="my-4 text-uppercase">Data Pendaftaran</h5>

                <!-- Filter by Year -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="tahun" class="form-label"><b>PILIH TAHUN :</b></label>
                        <select name="tahun" id="tahun" class="form-select" required>
                            <option value="">Pilih Tahun...</option>
                            <?php
                            $currentYear = date('Y');
                            for ($i = 2020; $i <= $currentYear; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card radius-10 mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h5 class="mb-1">Grafik Pendaftaran</h5>
                                    </div>
                                </div>
                                <canvas id="pendaftaranChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end page wrapper -->

        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

        <?php include "../admin/include/theme-footer.php" ?>

    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

    <!-- Custom JS for Chart -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('pendaftaranChart').getContext('2d');
            const labels = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            const pendaftaranChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // Bulan dari Januari hingga Desember
                    datasets: [{
                        label: 'Jumlah Pendaftaran',
                        data: Array(12).fill(0), // Awalnya diisi 0 untuk setiap bulan
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    onClick: function(event, elements) {
                        if (elements.length > 0) {
                            const monthIndex = elements[0].index;
                            const selectedMonth = labels[monthIndex];
                            const tahun = document.getElementById('tahun').value;
                            if (tahun) {
                                const url = `detail_pendaftaran.php?bulan=${monthIndex + 1}&tahun=${tahun}`;
                                window.location.href = url;
                            }
                        }
                    }
                }
            });

            function updateChartData(data) {
                const counts = Array(12).fill(0);
                data.forEach(item => {
                    counts[item.bulan - 1] = item.jumlah;
                });
                pendaftaranChart.data.datasets[0].data = counts;
                pendaftaranChart.update();
            }

            $('#tahun').change(function() {
                const tahun = $(this).val();

                if (tahun) {
                    $.ajax({
                        url: 'get_pendaftaran_data.php',
                        type: 'POST',
                        data: {
                            tahun: tahun
                        },
                        success: function(response) {
                            const result = JSON.parse(response);
                            updateChartData(result);
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>