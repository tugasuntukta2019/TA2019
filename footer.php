<style>
    Footer {
        position: relative;
        bottom: 0;
        width: 100%;
    }
</style>

<section>
    <!-- Footer -->
    <footer class="bg-secondary text-white text-center text-md-start">
        <!-- Grid container -->
        <div class="container p-4">
            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Kontak Kami</h5>
                    <a href="https://wa.me/0895365253632" class="btn btn-primary">WhatsApp</a>
                    <p>
                        Jalan Tipar Timur
                    </p>
                    <p>Telepon: (089) 5365253632</p>
                </div>
                <!-- Grid column -->

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Sosial Media</h5>

                    <div class="foto">
                        <a href="https://www.facebook.com/"><img src="asets/gambar/footer/facebook.png" width="40px" height="40px"></a>
                        <a href="https://www.instagram.com/mhmmdazhari24/"><img src="asets/gambar/footer/instagram.png" width="40px" height="40px"></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-0">Bengkel Virly Motor</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="sparepart.php" class="text-white">Sparepart</a>
                        </li>
                        <li>
                            <a href="mobil.php" class="text-white">Mobil</a>
                        </li>
                        <li>
                            <a href="service.php" class="text-white">Service</a>
                        </li>
                    </ul>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
        <!-- Grid container -->

        <!-- FAQ -->
        <div class="container p-4">
            <h5 class="text-uppercase">FAQ</h5>
            <ul class="list-unstyled">
                <?php
                    $ambil = $koneksi->query("SELECT * FROM faq");
                    while ($faq = $ambil->fetch_assoc()) {
                ?>
                <li>
                <p><?php echo $faq['pertanyaan']; ?></p>
                <p><?php echo $faq['jawaban']; ?></p>
                </li>
                <?php
            }
                ?>
            </ul>
        </div>
        <!-- FAQ -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            <p> 2023 &copy; Muhammad Azhari</p>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</section>
