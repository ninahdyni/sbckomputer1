<?php

include "koneksi.php";
include("includes/header-home.php");
?>


<!-- ======= Hero Section ======= -->

<section id="hero">
  <div class="hero-container" data-aos="fade-up">
    <h1>SELAMAT DATANG</h1>
    <h2>LKP - Sultan Beruntung Centre</h2>
    <a href="#about" class="btn-get-started scrollto"><i class="bx bx-chevrons-down"></i></a>
  </div>
</section><!-- End Hero -->

<main id="main">

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container">

      <div class="row no-gutters">
        <div class="content col-xl-5 d-flex align-items-stretch" data-aos="fade-up">
          <div class="content">
            <h1>PERKENALAN</h1>
            <p>
              Sultan Beruntung Centre "RPK SBC" adalah lembaga pendidikan unggul di Banjarmasin yang dikelola oleh profesional muda. Kami disini akan mengkhususkan diri dalam pelatihan komputer dan teknologi informasi yang berorientasi pada aplikasi dunia kerja. Letak geografis kami yang strategis, dekat dengan kampus, terminal, dan fasilitas akomodasi, membuat kami menjadi pilihan utama bagi pendidikan berkualitas di daerah ini.
            </p>
            <a href="#team" class="about-btn">About us <i class="bx bx-chevron-right"></i></a>
          </div>
        </div>
        <div class="col-xl-7 d-flex align-items-stretch">
          <div class="icon-boxes d-flex flex-column justify-content-center">
            <div class="row">
              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                <i class="bx bx-cube-alt"></i>
                <h4>FASILITAS</h4>
                <p>Fasilitas modern, instruktur terbaik, sertifikat, modul gratis, ruangan ber-AC, dan akses internet. Belajar dengan nyaman dan sukses.</p>
              </div>
              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                <i class="bx bx-shield"></i>
                <h4>PROGRAM KURSUS</h4>
                <p>Kursus terkini yang dirancang untuk sukses dalam dunia kerja. Mulailah perjalanan Anda menuju kesuksesan dengan kami.</p>
              </div>
              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                <i class="bx bx-images"></i>
                <h4>TENAGA PENGAJAR</h4>
                <p>Instruktur berkualitas tinggi dan berpengalaman. Kami siap membantu Anda mencapai impian Anda.</p>
              </div>
              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                <i class="bx bx-receipt"></i>
                <h4>PENDAFTARAN</h4>
                <p>Pendaftaran mudah dan cepat melalui situs web kami. Bergabunglah dengan kami dan mulailah perjalanan Anda menuju pendidikan berkualitas dan kemampuan yang siap kerja.</p>
              </div>
            </div>
          </div><!-- End .content-->
        </div>
      </div>

    </div>
  </section><!-- End About Section -->

  <!-- ======= Services Section ======= -->
  <section id="services" class="services">
    <div class="container">

      <div class="section-title" data-aos="fade-in" data-aos-delay="100">
        <h2>FASILITAS</h2>
        <p>Tersedia fasilitas modern dengan ruangan yang nyaman dan dilengkapi dengan peralatan terbaik untuk pengalaman belajar yang optimal, promosi menarik, dan pelatihan yang mendukung pengalaman belajar Anda.</p>
      </div>
      <center>
        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up">
              <div class="icon" style="text-align: left;"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title"><a href="">Paket Promo</a></h4>
              <img class="faded-away" src="../assets/img/foto-1.jpg" alt="Gambar Anda" style="width: 250px; height: 300px;">
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon" style="text-align: left;"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Video Pembelajaran</a></h4>
              <video controls autoplay width="250" height="300">
                <source src="../assets/img/sbc.mp4" type="video/mp4">
                Maaf, browser Anda tidak mendukung pemutaran video.
              </video>
            </div>
          </div>
          <style>
            .faded-away {
              opacity: 0.5;
              /* Menentukan tingkat transparansi gambar (0.0 - 1.0) */
              transition: opacity 0.5s;
              /* Menambahkan efek transisi untuk memudar */
            }

            .faded-away:hover {
              opacity: 1.0;
              /* Kembalikan transparansi ke 1.0 saat gambar dihover */
            }
          </style>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon" style="text-align: left;"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">Program Kursus</a></h4>
              <img class="faded-away" src="../assets/img/home.png" alt="Gambar Anda" style="width: 250px; height: 300px;">
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon" style="text-align: left;"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Video Pembelajaran</a></h4>
              <video controls autoplay width="250" height="300">
                <source src="../assets/img/sbc-2.mp4" type="video/mp4">
                Maaf, browser Anda tidak mendukung pemutaran video.
              </video>

            </div>
          </div>
        </div>
      </center>
    </div>
  </section><!-- End Services Section -->

  <!-- ======= Counts Section ======= -->
  <section id="counts" class="counts  section-bg">
    <div class="container">

      <div class="row no-gutters">

        <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
          <div class="count-box">
            <i class="bi bi-people"></i>
            <?php
            $query_user = "SELECT * FROM user";
            $result_user = mysqli_query($conn, $query_user);
            $jml_user = mysqli_num_rows($result_user);

            ?>
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $jml_user ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p><strong>Jumlah Pelajar</strong> Beragam & Terus Bertambah</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
          <div class="count-box">
            <i class="bi bi-journal-richtext"></i>
            <?php
            $query_program = "SELECT * FROM program";
            $result_program = mysqli_query($conn, $query_program);
            $jml_program = mysqli_num_rows($result_program);
            ?>
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $jml_program ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p><strong>Program Kursus</strong> Berkualitas & Variatif</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
          <div class="count-box">
            <i class="bi bi-headset"></i>
            <?php
            $query_team = "SELECT * FROM team";
            $result_team = mysqli_query($conn, $query_team);
            $jml_team = mysqli_num_rows($result_team);
            ?>
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $jml_team ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p><strong>Tenaga Pengajar</strong> Ahli & Kompeten</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
          <div class="count-box">
            <i class="bi bi-emoji-smile"></i>
            <?php
            $query_testimonial = "SELECT * FROM testimonial";
            $result_testimonial = mysqli_query($conn, $query_testimonial);
            $jml_testimonial = mysqli_num_rows($result_testimonial);
            ?>
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $jml_testimonial ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p><strong>Review Pengunjung</strong> Positif & Terpercaya</p>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Counts Section -->

  <!-- ======= Cta Section ======= -->
  <section id="cta" class="cta">
    <div class="container" data-aos="zoom-in">

      <div class="text-center">
        <h3>DAFTAR SEKARANG</h3>
        <P>Bergabunglah dengan komunitas belajar yang dinamis dan bersemangat. Akses fasilitas modern, instruktur berkualitas, dan peluang karir yang menjanjikan. Jangan sampai terlewatkan!</P>
        <?php

        if (isset($_SESSION['id_user'])) {
          $id_user = $_SESSION['id_user'];

          $product_query = "SELECT * FROM user where id_user = $id_user";
          $run_query = mysqli_query($conn, $product_query);
          if (mysqli_num_rows($run_query) > 0) {
            while ($row = mysqli_fetch_array($run_query)) {
              $pro_id = $row['id_user'];
        ?>
              <a class="cta-btn" href="submit.php?id_user=<?php echo $pro_id; ?>">DAFTAR SEKARANG</a>
        <?php
            }
          }
        }
        ?>
      </div>

    </div>
  </section><!-- End Cta Section -->

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio">
    <div class="container">

      <div class="section-title" data-aos="fade-in" data-aos-delay="100">
        <h2>PROGRAM KURSUS</h2>
        <P>
          Temukan kursus-kursus kami yang penuh wawasan, dirancang untuk mengubah pengetahuan menjadi kesuksesan dalam Mengejar Karier Impian Anda. Bergabung dan perluas kemampuan Anda sekarang!
        </P>
      </div>

      <div class="row" data-aos="fade-in">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-Private">Private</li>
            <li data-filter=".filter-Reguler">Reguler</li>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container" data-aos="fade-up">
        <?php
        $product_query = "SELECT * FROM program";
        $run_query = mysqli_query($conn, $product_query);
        if (mysqli_num_rows($run_query) > 0) {
          while ($row = mysqli_fetch_array($run_query)) {
            $pro_id = $row['id_program'];
            $pro_nm = $row['nama_kelas'];
            $pro_jenis = $row['jenis_kelas'];
            $pro_img = $row['foto_program'];
        ?>
            <div class="col-lg-2 col-md-4 portfolio-item filter-<?php echo ($pro_jenis); ?>">
              <div class="portfolio-wrap">
                <center>
                  <img src="../admin_area/sadmin/assets/images/program/<?php echo $pro_img; ?>" class="img-fluid" alt="" style="width: 200px; height: 200px;">
                </center>
                <div class="member" data-aos="fade-up" data-aos-delay="150">
                  <div class="member-info" align="center">
                    <h6><?php echo $pro_nm; ?></h6>
                    <div class="portfolio-links">
                      <a href="form-daftar.php?id=<?php echo $pro_id; ?>" title="Daftar Sekarang"><i class="bx bx-plus"></i></a>
                      <a href="program-details.php?id=<?php echo $pro_id; ?>" title="More Details"><i class="bx bx-link"></i></a>
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </div>
  </section>
  <!-- End Portfolio Section -->

  <!-- ======= Testimonials Section ======= -->
  <section id="testimonials" class="testimonials section-bg">
    <div class="container">

      <div class="section-title" data-aos="fade-in" data-aos-delay="100">
        <h2>Testimonials</h2>
      </div>

      <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">
          <?php
          $product_query = "SELECT testimonial.komentar, user.nm_user, user.pekerjaan, user.foto
        FROM testimonial INNER JOIN user ON testimonial.id_user = user.id_user";
          $run_query = mysqli_query($conn, $product_query);
          if (mysqli_num_rows($run_query) > 0) {
            while ($row = mysqli_fetch_array($run_query)) {
              $pro_nm = $row['nm_user'];
              $pro_komentar = $row['komentar'];
              $pro_job = $row['pekerjaan'];
              $pro_img = $row['foto'];
          ?>
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    <?php echo $pro_komentar; ?>
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                  <img src="../admin_area/sadmin/assets/images/users/<?php echo $pro_img; ?>" class="testimonial-img" alt="">
                  <h3><?php echo $pro_nm; ?></h3>
                  <h4><?php echo $pro_job; ?></h4>
                </div>
              </div><!-- End testimonial item -->
          <?php
            }
          }
          ?>
        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>
  </section><!-- End Testimonials Section -->

  <!-- ======= Team Section ======= -->
  <section id="team" class="team">
    <div class="container">

      <div class="section-title" data-aos="fade-in" data-aos-delay="100">
        <h2>Team</h2>
        <p>
          Kami adalah tim berpengalaman yang berkomitmen untuk membantu Anda mencapai kesuksesan melalui Program Kursus ini. Dengan pengetahuan dan keterampilan kami, kami siap mendukung perjalanan Anda menuju tujuan yang lebih besar.
        </p>
      </div>

      <div class="row">
        <?php
        $query_team = "SELECT T.*, B.nm_bagian FROM team T LEFT JOIN bagian B ON T.id_bagian = B.id_bagian WHERE T.id_team != 0 ORDER BY T.id_team DESC";
        $result_team = mysqli_query($conn, $query_team);
        while ($row_team = mysqli_fetch_assoc($result_team)) {
        ?>

          <div class="col-lg-2 col-md-4">
            <div class="member" data-aos="fade-up">
              <div class="pic"><img src="../admin_area/sadmin/assets/images/team/<?php echo $row_team["foto_team"] ?>" class="img-fluid" alt="<?php echo $row_team["foto_team"] ?>"></div>
              <div class="member-info">
                <h4><?php echo $row_team["nm_team"] ?></h4>
                <span><?php echo $row_team["nm_bagian"] ?></span>
                <div class="social">
                  <a href="https://api.whatsapp.com/send?phone=<?php echo $row_team["whatsapp"] ?>"><i class="bi bi-whatsapp"></i></a>
                  <a href="https://www.instagram.com/<?php echo $row_team["instagram"] ?>"><i class="bi bi-instagram"></i></a>
                  <a href="https://twitter.com/<?php echo $row_team["twitter"] ?>"><i class="bi bi-twitter"></i></a>
                  <a href="mailto: <?php echo $row_team["email_team"] ?>"><i class="bx bx-envelope"></i></a>
                </div>
              </div>
            </div>
          </div>

        <?php
        }
        ?>
      </div>


    </div>
  </section><!-- End Team Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Contact</h2>
        <p>Jangan ragu untuk menghubungi kami. Kami siap untuk menjawab pertanyaan Anda dan membantu Anda mencapai tujuan Karier Impian Anda. </p>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="info-box mb-4">
            <i class="bx bx-map"></i>
            <h3>Alamat</h3>
            <p>Komplek Fanama Jl. Pondok Banjar Indah Permai No. 29, Pemurus Dalam, Kec. Banjarmasin Sel., Kota Banjarmasin, Kalimantan Selatan 70238</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="info-box  mb-4">
            <i class="bx bx-envelope"></i>
            <h3>Email Us</h3>
            <a href="mailto:sultanberuntungcentre@gmail.com">
              sultanberuntungcentre@gmail.com
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="info-box  mb-4">
            <i class="bx bx-phone-call"></i>
            <h3>Call Us</h3>
            <a href="https://wa.me/6287814649469"> +62 878 1464 9469</a>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-lg-6 ">
          <div class="mapouter">
            <div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=lkp sultan beruntung centre&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://connectionsgame.org/">Connections Unlimited</a></div>
            <style>
              .mapouter {
                position: relative;
                text-align: right;
                width: 100%;
                height: 400px;
              }

              .gmap_canvas {
                overflow: hidden;
                background: none !important;
                width: 100%;
                height: 400px;
              }

              .gmap_iframe {
                height: 400px !important;
              }
            </style>
          </div>
        </div>
        <?php
        $id_user =  $_SESSION["id_user"];
        $query_testi = "SELECT * FROM user WHERE id_user = $id_user";
        $result_testi = mysqli_query($conn, $query_testi);
        $row_testi = mysqli_fetch_assoc($result_testi);

        if (isset($_POST["submit"])) {

          $id_user = htmlspecialchars($_POST["id_user"]);
          $komentar = htmlspecialchars($_POST["komentar"]);

          $query = "INSERT INTO testimonial VALUES (NULL, '$id_user', '$komentar')";
          $simpan = mysqli_query($conn, $query);

          if ($simpan) {
            echo "<script>
          alert('Terima Kasih atas Komentar Anda!');
          document.location.href = 'index.php#testimonials';
        </script>";
          } else {
            echo "<script>
          alert('Data gagal disimpan');
          history.go(-1);
        </script>";
          }
        }
        ?>

        <div class="col-lg-6">
          <div class="row">
            <div class="col-xl-12 mx-auto">
              <div class="card border-top border-0">
                <div class="card-body px-5 pb-5">
                  <form target="" method="post" role="form">
                    <div class="section-title">
                      <h2>Leave Your Testimonials Here!</h2>
                      <div class="form-group mt-3">
                        <textarea class="form-control" name="komentar" rows="5" style="height: 110px;" placeholder="Your Message" required></textarea>
                        <!-- Atur tinggi textarea di atas (contoh: 150px) -->
                      </div>
                      <input type="hidden" name="id_user" value="<?php echo $row_testi["id_user"] ?>">
                      <div class="text-center">
                        <button class="btn btn-outline-info" type="submit" name="submit" style="margin-bottom: 0 !important;">Send Message</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
  </section><!-- End Contact Section -->

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