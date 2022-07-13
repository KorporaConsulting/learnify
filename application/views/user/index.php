<?php $this->load->view('user/template_user/header'); ?>
<!-- Start Greetings Card -->
<!-- <div class="container">
    <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
        <div class="row" style="color: black; font-family: 'poppins';">
            <div class="col-md-12 mt-1">
                <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="400">Selamat Datang
                    di Sales University <span style="font-size: 40px;">
                    </span> </h1>
                <p>Hello Students! , Ini merupakan halaman utama Sales University ! Selamat belajar ya students!</p>
                <hr>
            </div>
        </div>
    </div>
</div> -->



<div class="container pt-3" style="min-height: 100vh;">
    <div class="card mb-3 shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
        <h1 class="display-4">Selamat Datang <?= $this->session->userdata('nama') ?> 👋🏻</h1>
        <p class="lead">Semoga aktivitas belajarmu disini menyenangkan.</p>
        <hr class="my-4">
        <p>Ingin menemukan course yang tepat dan terbaik untuk anda? Pilih course dan cari yang sesuai dengan kebutuhan kamu</p>
        <a class="btn btn-primary btn-lg" href="<?= base_url('user/all_semester') ?>" role="button">Course</a>
    </div>
    <div class="row">
        <?php if (isset($aktifitas_belajar)) : ?>
            <div class="col-lg-6">
                <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                    <div class="card-header">
                        Aktivitas Belajar
                    </div>
                    <div class="card-body">
                        <div class="alert bg-light">
                            <div><small><b>Sedang dipelajari</b></small></div>
                            <div class="d-flex justify-content-between">
                                <span>
                                    <?= $aktifitas_belajar->data->nama_mapel ?>
                                </span>
                                <span>
                                    <a href="<?= $aktifitas_belajar->url ?>">Lanjutkan</a>
                                </span>
                            </div>
                        </div>
                        <div class="text-right mt-5">
                            <a href="<?= site_url('user/detail_activity_learn') ?>" class="text-dark" style="text-decoration: underline;">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-lg-6">
            <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                <div class="card-header">
                    Absensi
                </div>
                <div class="card-body">
                    <div class="row mb-3 justify-content-center" style="color: black; font-family: 'poppins';">
                        <div class="col-md-6 mt-1 text-center">
                            <img class="rounded-circle" width="100px" alt="100x100" src="<?= base_url('assets/profile_picture/') . $user->image_user ?>" data-holder-rendered="true">
                            <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="400"> </h1>
                            <h5><?= $user->nama ?></h5>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 row">
                            <div class="col-md-12 mt-1">
                                <h5 class="text-center">Kehadiran</h5>
                                <div class="progress">
                                    <?php
                                    if ($total_absen <= 0) $total_absen = 1;
                                    $absen_progres  = ($absen / $total_absen) * 100;
                                    ?>
                                    <div class="progress-bar" role="progressbar" style="width:<?= $absen_progres ?>%" aria-valuenow="<?= $absen_progres ?>" aria-valuemin="0" aria-valuemax="100" id="kehadiran"><?= $absen ?>/<?= $total_absen ?></div>
                                </div>
                                <!-- <img class="img-fluid" width="100px" alt="100x100" src="<?= base_url('assets/img/qr-code-login/qr_icon.svg') ?>" data-holder-rendered="true"> -->
                            </div>
                            <div class="col-md-12 mt-1">
                                <h5 class="text-center">Ketepatan Absen</h5>
                                <?php
                                if ($total_absen <= 0) $total_absen = 1;
                                $ketepatan  = ($akurasi->akurasi / $total_absen);
                                ?>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width:<?= $ketepatan ?>%" aria-valuenow="<?= $ketepatan ?>" aria-valuemin="0" aria-valuemax="100"><?= $ketepatan ?>%</div>
                                </div>
                                <!-- <img class="img-fluid" width="100px" alt="100x100" src="<?= base_url('assets/img/qr-code-login/qr_icon.svg') ?>" data-holder-rendered="true"> -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>