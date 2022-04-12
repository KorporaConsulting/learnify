<?php $this->load->view('user/template_user/header'); ?>
<?php $this->load->view('user/template_user/navbar'); ?>

<!-- Start Greetings Card -->
<div class="container">
    <div class="bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
        <div class="row" style="color: black; font-family: 'poppins';">
            <div class="col-md-12 mt-1">
                <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="1400">Selamat Datang
                    di Sales University <span style="font-size: 40px;">👋🏻
                    </span> </h1>
                <p>Hello Students! , Ini merupakan halaman utama Sales University ! Selamat belajar ya students!</p>
                <hr>

            </div>
        </div>
    </div>
</div>
<!-- End Greetings Card -->


<br>


<!-- Start Class Card -->
<div class="container">
    <div class="row mt-4 mb-5 justify-content-center">
        <div class="col-md-12 ">
            <div class="row justify-content-center">
                <div class="col-sm-4 mb-2 d-flex justify-content-center " data-aos-duration="1900" data-aos="fade-right">
                    <a href="<?= base_url('user/semester/1') ?>">
                        <div class="card-kelas text-center">
                            <img src="<?= base_url('assets/') ?>img/semester1.jpg" style="object-fit: cover;" class="card-img-top img-fluid" alt="...">
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mb-2 d-flex justify-content-center" data-aos-duration="1900" data-aos="fade-left">
                    <a href="<?= base_url('user/semester/2') ?>">
                        <div class="card-kelas">
                            <img src="<?= base_url('assets/') ?>img/semester2.jpg" class="card-img-top" alt="...">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>