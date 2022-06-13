<?php $this->load->view('user/template_user/header'); ?>
<!-- Start Greetings Card -->
<!-- <div class="container">
    <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
        <div class="row" style="color: black; font-family: 'poppins';">
            <div class="col-md-12 mt-1">
                <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="400">Selamat Datang
                    di Sales University <span style="font-size: 40px;">👋🏻
                    </span> </h1>
                <p>Hello Students! , Ini merupakan halaman utama Sales University ! Selamat belajar ya students!</p>
                <hr>
            </div>
        </div>
    </div>
</div> -->
<div class="container">
    <div class="row mt-1">
        <div class="col-md-4">
            <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                <div class="row" style="color: black; font-family: 'poppins';">
                    <div class="col-md-12 mt-1 text-center">
                        <img class="rounded-circle" width="100px" alt="100x100" src="<?= base_url('assets/profile_picture/' . $this->session->userdata('image_user')) ?>" data-holder-rendered="true">
                        <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="400"> </h1>
                        <h5><?= $this->session->userdata('nama') ?></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                <div class="row" style="color: black; font-family: 'poppins';">
                    <div class="col-md-12 mt-1 text-center">
                        <img class="img-fluid" width="100px" alt="100x100" src="<?= base_url('assets/img/qr-code-login/qr_icon.svg') ?>" data-holder-rendered="true">
                        <!-- <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="400"> </h1> -->
                        <h5>QR absensi</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                <div class="row" style="color: black; font-family: 'poppins';">
                    <div class="col-md-6 mt-1">
                        <h5 class="text-center">Kehadiran</h5>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">75/100</div>
                        </div>
                        <!-- <img class="img-fluid" width="100px" alt="100x100" src="<?= base_url('assets/img/qr-code-login/qr_icon.svg') ?>" data-holder-rendered="true"> -->
                    </div>
                    <div class="col-md-6 mt-1">
                        <h5 class="text-center">Ketepatan Absen</h5>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">90%</div>
                        </div>
                        <!-- <img class="img-fluid" width="100px" alt="100x100" src="<?= base_url('assets/img/qr-code-login/qr_icon.svg') ?>" data-holder-rendered="true"> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Greetings Card -->


<br>


<!-- Start Class Card -->
<div class="container">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="col-md-12 ">
            <div class="row justify-content-center">
                <?php foreach ($semester as $s) { ?>
                    <div class="col-sm-4 mb-2 d-flex justify-content-center " data-aos-duration="400" data-aos="fade-right">
                        <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                            <a href="<?= base_url('user/semester/' . $s->semester) ?>">
                                <div class="card text-warning">
                                    <img class="card-img" src="<?= base_url('assets/img/' . $s->image_semester) ?>" alt="Card image">
                                    <div class="card-img-overlay">
                                        <h2 class="card-title align-items-center d-flex justify-content-center py-5 mt-5 pt-5">Semester <?= $s->semester ?></h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>