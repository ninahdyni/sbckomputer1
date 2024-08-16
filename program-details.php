<?php

include "koneksi.php";
include("includes/header.php");

?>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Program Details</h2>
        <ol>
          <li><a href="index.php">Home</a></li>
          <li><a href="#">Program</a></li>
          <li>Program Details</li>
        </ol>
      </div>

    </div>
  </section><!-- Breadcrumbs Section -->

  <!-- ======= Portfolio Details Section ======= -->
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">

      <div class="row gy-4">
        <?php
        $product_id = $_GET['id'];

        $product_query = "SELECT * FROM program WHERE id_program = $product_id";
        $run_query = mysqli_query($conn, $product_query);
        if (mysqli_num_rows($run_query) > 0) {
          while ($row = mysqli_fetch_array($run_query)) {
            $pro_id = $row['id_program'];
            $pro_nm = $row['nama_kelas'];
            $pro_jenis = $row['jenis_kelas'];
            $pro_deskripsi = $row['deskripsi'];
            $pro_materi = $row['materi'];
            $pro_lama = $row['lama_pendidikan'];
            $pro_biaya = $row['biaya'];
            $pro_img = $row['foto_program'];
        ?>

            <div class="col-lg-8">
              <div class="portfolio-details-slider swiper">
                <div class="swiper-wrapper align-items-center">

                  <div class="swiper-slide">
                    <img src="admin_area/sadmin/assets/images/program/<?php echo $pro_img; ?>" alt="">
                  </div>
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="portfolio-info">
                <h3>Informasi Program Kursus</h3>
                <ul>
                  <li><strong>Nama Prgram</strong>: <?php echo $pro_nm; ?></li>
                  <li><strong>Jenis Kelas</strong>: <?php echo $pro_jenis; ?></li>
                  <li><strong>Materi</strong>: <?php echo $pro_materi; ?></li>
                  <li><strong>Lama Pendidikan</strong>: <?php echo $pro_lama; ?></li>
                  <li><strong>Biaya Pendidikan</strong>: <?php echo $pro_biaya; ?></li>
                </ul>
              </div>
              <div class="portfolio-description">
                <h2>Deskripsi Program Kursus</h2>
                <p>
                  <?php echo $pro_deskripsi; ?> </p>
                <form action="login.php" method="post">
                  <input type="submit" class="btn btn-secondary" value="Daftar Kelas" style="width: 100%; margin: 0 auto; display: block;">
                </form>

              </div>
            </div>

        <?php
          }
        }
        ?>
      </div>


    </div>
  </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

<?php include("includes/footer.php"); ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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