    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="<?= site_url('arsip') ?>">Berita</a>
                    <a class="btn btn-link" href="<?= site_url('statistik') ?>">Statistik</a>
                    <a class="btn btn-link" href="<?= site_url('maps') ?>">Peta</a>
                    <a class="btn btn-link" href="<?= site_url('first/gallery_youtube') ?>">Video</a>
                    <a class="btn btn-link" href="<?= site_url('insidega') ?>">Login</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i><?= $desa['alamat_kantor']; ?></p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i><?= $desa['telepon']; ?></p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i><?= $desa['email_desa']; ?></p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3"><a class="btn btn-link" href="<?= site_url('first/gallery') ?>">Gallery Foto</a></h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-1.jpg")?>" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-2.jpg")?>" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-3.jpg")?>" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-2.jpg")?>" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-3.jpg")?>" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-1.jpg")?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Pengunjung</h4>
                    <div class="row g-2 pt-2">

                <?php $this->load->view($folder_themes . '/widgets/statistik_pengunjung') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#"><?= $this->setting->website_title ?> Versi <?= AmbilVersi() ?> | Tema <?= $this->setting->web_theme ?> <?= THEME_VERSION ?></a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="<?= site_url('') ?>">Home</a>
                            <a href="<?= site_url('arsip') ?>">Berita</a>
                            <a href="<?= site_url('statistik') ?>">Statistik</a>
                            <a href="<?= site_url('maps') ?>">Peta</a>
                            <a href="<?= site_url('first/gallery_youtube') ?>">Video</a>
                            <a href="<?= site_url('first/gallery') ?>">Foto</a>
                            <a href="<?= site_url('insidega') ?>">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/wow/wow.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/easing/easing.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/waypoints/waypoints.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/owlcarousel/owl.carousel.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/counterup/counterup.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/easing/easing.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/lightbox/js/lightbox.min.js")?>"></script>
    <!-- Template Javascript -->
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/js/main.js")?>"></script>