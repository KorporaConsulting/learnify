<?php $this->load->view('user/template_user/header'); ?>
<!-- Start Greetings Card -->
<div class="container">
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
</div>
<!-- End Greetings Card -->


<br>


<!-- Start Class Card -->
<div class="container">
    <div class="row mt-4 mb-5 justify-content-center">
        <div class="col-md-12 ">
            <div class="row justify-content-center">
                <?php foreach ($semester as $s) { ?>
                    <div class="col-sm-4 mb-2 d-flex justify-content-center " data-aos-duration="400" data-aos="fade-right">
                        <a href="<?= base_url('user/semester/' . $s->semester) ?>">
                            <div class="card text-warning">
                                <img class="card-img" src="<?= base_url('assets/img/' . $s->image_semester) ?>" alt="Card image">
                                <div class="card-img-overlay">
                                    <h2 class="card-title align-items-center d-flex justify-content-center py-5 mt-5 pt-5">Semester <?= $s->semester ?></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>