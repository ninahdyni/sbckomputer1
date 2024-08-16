<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>LKP - Sultan Beruntung Centre</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/logo1.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://bbbootstrap.com/snippets/embed/multi-step-form-wizard-30467045">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
    <script src="js/jquery-multi-step-form.js" type="text/javascript"></script>
    <link href="css/jquery-multi-step-form.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- Template Main CSS File -->
    <link href="assets/css/style-sign.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Squadfree
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/squadfree-free-bootstrap-template-creative/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between position-relative">
            <div class="logo">
                <h1 class="text-light"><a href="index.php"><span>LKP - Sultan Beruntung Centre</span></a></h1>
            </div>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="index.php#about">About Us</a></li>
                    <li><a class="nav-link scrollto" href="index.php#services">Services</a></li>
                    <li><a class="nav-link scrollto" href="index.php#portfolio">Program Kursus</a></li>
                    <li class="dropdown">
                        <a href="#"><span>Pilihan Kelas</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li class="dropdown">
                                <a href="#"><span>Kelas Reguler</span> <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <?php
                                    $product_query = "SELECT * FROM program WHERE jenis_kelas = 'Reguler'";
                                    $run_query = mysqli_query($conn, $product_query);
                                    if (mysqli_num_rows($run_query) > 0) {
                                        while ($row = mysqli_fetch_array($run_query)) {
                                            $pro_id = $row['id_program'];
                                            $pro_nm = $row['nama_kelas'];
                                    ?>
                                            <li><a href="program-details.php?id=<?php echo $pro_id; ?>"><?php echo $pro_nm; ?></a></li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#"><span>Kelas Private</span> <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <?php
                                    $product_query = "SELECT * FROM program WHERE jenis_kelas = 'Private'";
                                    $run_query = mysqli_query($conn, $product_query);
                                    if (mysqli_num_rows($run_query) > 0) {
                                        while ($row = mysqli_fetch_array($run_query)) {
                                            $pro_id = $row['id_program'];
                                            $pro_nm = $row['nama_kelas'];
                                    ?>
                                            <li><a href="program-details.php?id=<?php echo $pro_id; ?>"><?php echo $pro_nm; ?></a></li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="index.php#team">Team</a></li>

                    <li class="dropdown"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <?php
                            if (isset($_SESSION['id_user'])) {
                                $id_user = $_SESSION['id_user'];

                                $product_query = "SELECT * FROM user where id_user = $id_user";
                                $run_query = mysqli_query($conn, $product_query);
                                if (mysqli_num_rows($run_query) > 0) {
                                    while ($row = mysqli_fetch_array($run_query)) {
                                        $pro_id = $row['id_user'];
                            ?>
                                        <li><a href="profile.php?id_user=<?php echo $pro_id; ?>">View Profil</a></li>
                            <?php
                                    }
                                }
                            }
                            ?>
                            <li><a href="../logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
</body>

</html>