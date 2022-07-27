<!--================Home Banner Area =================-->
<section class="home_banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background="">
        </div>
        <div class="container">
            <div class="banner_content text-center">
                <h3 data-aos="fade-up" style="opacity: 1.0;" data-aos-duration="1600">Belajar Dimana Saja & Kapan Saja <br /> Mudah Dengan Sales University</h3>
                <p data-aos="fade-up" data-aos-duration="1900">Dengan Sales University kemudahan kegiatan belajar mengajar dapat terpenuhi. Para guru dan siswa dapat
                    belajar meski banyak halangan atau rintangan. Nikmati Pembelajaran terstruktur dan efektif menggunakan Sales University serta kemudahan belajar dengan menggunakan aplikasi kami. </p>
                <a data-aos="fade-up" data-aos-duration="2000" class="main_btn" href="<?= base_url('user/registration') ?>#registration">Bergabung Sekarang <span class="lnr lnr-arrow-right"></span></a>
            </div>
        </div>
    </div>
</section>
<!-- ================End Home Banner Area ================= -->

<!--================Finance Area =================-->
<section class="finance_area">
    <div class="container">
        <div class="finance_inner row">
            <div class="col-lg-4 col-sm-6">
                <div class="finance_item">
                    <div class="media">
                        <div class="d-flex">
                            <i class="lnr lnr-users"></i>
                        </div>
                        <div class="media-body">
                            <h5>Mentor Berkualitas</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="finance_item">
                    <div class="media">
                        <div class="d-flex">
                            <i class="lnr lnr-file-empty"></i>
                        </div>
                        <div class="media-body">
                            <h5>Dokumentasi lengkap & Jelas</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="finance_item">
                    <div class="media">
                        <div class="d-flex">
                            <i class="lnr lnr-camera-video"></i>
                        </div>
                        <div class="media-body">
                            <h5>E-Learning Berbasis Video dan Live Class</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Finance Area =================-->

<!--================ Illustrations Area =================-->
<section class="Sales University-for-indonesia p_20">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <img data-aos="fade-up" data-aos-duration="1800" src="<?= base_url('assets/') ?>img/illustrations/index-study.svg" alt="" srcset="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="main_title">
                    <h2 data-aos="fade-up" data-aos-duration="2000">Sales University Dibuat Untuk Meningkatkan Kualitas Pembelajaran Di Indonesia</h2>
                    <p data-aos="fade-up" data-aos-duration="2200">Merciful revaluation burying love ultimate value inexpedient ubermensch. Holiest madness victorious morality hope endless christian madness. Love dead fearful transvaluation marvelous. Oneself right ideal abstract endless faith deceptions zarathustra grandeur law ubermensch free.</p>
                    <!-- <a href="https://github.com/syauqi/Sales University"><button data-aos="fade-up" data-aos-duration="2400" class="bubbly-button">Download Sales University <span class="lnr lnr-arrow-right"></span></button></a> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Illustrations Area =================-->

<!--================Courses Area =================-->
<section class="courses_area p_40">
    <div class="container">
        <div class="main_title">
            <h2 data-aos="fade-up" data-aos-duration="1600">Pelajaran Yang Tersedia di Sales University</h2>
            <p data-aos="fade-up" data-aos-duration="1800">Merciful revaluation burying love ultimate value inexpedient ubermensch. Holiest madness victorious morality hope endless christian madness. Love dead fearful transvaluation marvelous. Oneself right ideal abstract endless faith deceptions zarathustra grandeur law ubermensch free.</p>
        </div>
        <div class="row mt-4 mb-5 justify-content-center">
            <?php foreach ($course as $c) { ?>
                <div class="col-md-4 ">
                    <div class="card shadow bg-white mx-auto p-4 buat-text text-center mb-3" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
                        <img class="card-img-top" src="<?= base_url('assets/img/courses/' . $c->image) ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title" style="color: black;"><?= $c->nama_mapel ?></h5>
                            <p class="card-text" style="color: black;"><?= substr($c->desk, 0, 20) ?></p>
                        </div>
                    </div>
                </div>
            <?php  } ?>
        </div>
    </div>
</section>
<!--================End Courses Area =================-->

<!--================Team Area =================-->
<section class="team_area p_20">
    <div class="container">
        <div class="main_title">
            <h2 data-aos="fade-up" data-aos-duration="1800">Testimonial Para Siswa Sales University</h2>
            <p data-aos="fade-up" data-aos-duration="2000">Merciful revaluation burying love ultimate value inexpedient ubermensch. Holiest madness victorious morality hope endless christian madness. Love dead fearful transvaluation marvelous. Oneself right ideal abstract endless faith deceptions zarathustra grandeur law ubermensch free.</p>
        </div>
        <section class="testimonials_area p_20">
            <div class="container">
                <div class="testi_slider owl-carousel">
                    <div class="item">
                        <div class="testi_item">
                            <img src="<?= base_url('assets/') ?>img/testimonials/testi-3.png" alt="">
                            <h4>Syauqi Zaidan Khairan Khalaf</h4>
                            <ul class="list">
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                            </ul>
                            <p>Merciful revaluation burying love ultimate value inexpedient ubermensch. Holiest madness victorious morality hope endless christian madness. Love dead fearful transvaluation marvelous. Oneself right ideal abstract endless faith deceptions zarathustra grandeur law ubermensch free. Abstract chaos snare play truth ultimate good self. God overcome sexuality pious abstract good decieve revaluation aversion good. Virtues chaos overcome society holiest truth.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testi_item">
                            <img src="<?= base_url('assets/') ?>img/testimonials/testi-2.png" alt="">
                            <h4>Taupik Hidayat</h4>
                            <ul class="list">
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                            </ul>
                            <p>Merciful revaluation burying love ultimate value inexpedient ubermensch. Holiest madness victorious morality hope endless christian madness. Love dead fearful transvaluation marvelous. Oneself right ideal abstract endless faith deceptions zarathustra grandeur law ubermensch free. Abstract chaos snare play truth ultimate good self. God overcome sexuality pious abstract good decieve revaluation aversion good. Virtues chaos overcome society holiest truth.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testi_item">
                            <img src="<?= base_url('assets/') ?>img/testimonials/testi-1.png" alt="">
                            <h4>Diki Ramdani</h4>
                            <ul class="list">
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                            </ul>
                            <p>Merciful revaluation burying love ultimate value inexpedient ubermensch. Holiest madness victorious morality hope endless christian madness. Love dead fearful transvaluation marvelous. Oneself right ideal abstract endless faith deceptions zarathustra grandeur law ubermensch free. Abstract chaos snare play truth ultimate good self. God overcome sexuality pious abstract good decieve revaluation aversion good. Virtues chaos overcome society holiest truth.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<!--================End Team Area =================-->

<!--================Impress Area =================-->
<!-- <section class="impress_area p_120">
    <div class="container">
        <div class="impress_inner text-center">
            <h2 data-aos="fade-up" data-aos-duration="1800">LOGIN SEBAGAI GURU DAN UPLOAD MATERI & VIDEO SEKARANG</h2>
            <p data-aos="fade-up" data-aos-duration="2000">Merciful revaluation burying love ultimate value inexpedient ubermensch. Holiest madness victorious morality hope endless christian madness. Love dead fearful transvaluation marvelous. Oneself right ideal abstract endless faith deceptions zarathustra grandeur law ubermensch free. Abstract chaos snare play truth ultimate good self. God overcome sexuality pious abstract good decieve revaluation aversion good. Virtues chaos overcome society holiest truth.
            </p>
            <a data-aos="fade-up" data-aos-duration="2200" class="main_btn" href="<?= base_url('welcome/guru') ?>">Login Sebagai Guru <span class="lnr lnr-arrow-right text-black"></span></a>
        </div>
    </div>
</section> -->
<!--================End Impress Area =================-->