<!-- ======= Footer ======= -->
<footer id="footer">
	<div class="footer-top">
		<div class="container">
			<div class="row">

				<div class="col-lg-4 col-md-6">
					<div class="footer-info">
						<h3>LKP- SBC KOMPUTER</h3>
						<p class="pb-3"><em>Alamat dan Kontak.</em></p>
						<p>
							Komplek Fanama Jl. Pondok Banjar Indah Permai No. 29, Pemurus Dalam, Kec. Banjarmasin Sel., Kota Banjarmasin, Kalimantan Selatan 70238 <br>
							<br>
							<strong>Phone:</strong> <a href="https://wa.me/6287814649469"> +62 878 1464 9469</a><br>
							<strong>Email:</strong> <a href="mailto:sultanberuntungcentre@gmail.com"> sultanberuntungcentre@gmail.com</a><br>
						</p>
						<div class="social-links mt-3">
							<a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
							<a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
							<a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
							<a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
							<a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
						</div>
					</div>
				</div>

				<div class="col-lg-2 col-md-6 footer-links">
					<h4>Useful Links</h4>
					<ul>
						<li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
						<li><i class="bx bx-chevron-right"></i> <a href="index.php#about">About us</a></li>
						<li><i class="bx bx-chevron-right"></i> <a href="index.php#service">Services</a></li>
						<li><i class="bx bx-chevron-right"></i> <a href="index.php#team">Team</a></li>
						<li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
					</ul>
				</div>
				<div class="col-lg-2 col-md-6 footer-links">
					<h4>Our Services</h4>

					<h4>Reguler</h4>
					<?php
					$reguler_query = "SELECT * FROM program WHERE jenis_kelas = 'Reguler'";
					$reguler_run_query = mysqli_query($conn, $reguler_query);
					if (mysqli_num_rows($reguler_run_query) > 0) {
						while ($row = mysqli_fetch_array($reguler_run_query)) {
							$pro_id = $row['id_program'];
							$pro_nm = $row['nama_kelas'];
					?>
							<ul>
								<li><i class="bx bx-chevron-right"></i> <a href="program-details.php?id=<?php echo $pro_id; ?>"><?php echo $pro_nm; ?></a></li>
							</ul>
					<?php
						}
					}
					?>
					<h4>Private</h4>
					<?php
					$private_query = "SELECT * FROM program WHERE jenis_kelas = 'Private'";
					$private_run_query = mysqli_query($conn, $private_query);
					if (mysqli_num_rows($private_run_query) > 0) {
						while ($row = mysqli_fetch_array($private_run_query)) {
							$pro_id = $row['id_program'];
							$pro_nm = $row['nama_kelas'];
					?>
							<ul>
								<li><i class="bx bx-chevron-right"></i> <a href="program-details.php?id=<?php echo $pro_id; ?>"><?php echo $pro_nm; ?></a></li>
							</ul>
					<?php
						}
					}
					?>
				</div>



				<div class="col-lg-4 col-md-6 footer-newsletter">
					<h4>HUBUNGI KAMI</h4>
					<p>Tanyakan atau Konsultasi tentang Layanan Kami.</p>

					<div class="subscribe-form">
						<a href="https://web.whatsapp.com/send?phone=6288242739374&text=Halo%20Sultan%20Beruntung%20Centre%20Komputer,%20saya%20sangat%20tertarik%20dengan%20program%20kursus%20dan%20pelatihan%20Anda.%20Bisakah%20Anda%20memberikan%20saya%20informasi%20lebih%20lanjut?" target="_blank" rel="noopener noreferrer">
							<button type=" submit" class="btn btn-secondary" value="Konsultasi dengan Kami via WhatsApp" style="width: 350px; height: 40px;">
								Konsultasi dengan Kami via WhatsApp
							</button>
						</a>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="container">
		<div class="copyright">
			&copy; Copyright <strong><span>sbckomputer</span></strong>. All Rights Reserved
		</div>
		<div class="credits">
			<!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/squadfree-free-bootstrap-template-creative/ -->
			Designed by <a href="#">Admin</a>
		</div>
	</div>
</footer><!-- End Footer -->