<?php $this->load->view('user/template_user/header'); ?>

<!-- Start Greetings Card -->
<div class="container">
    <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
        <div class="row" style="color: black; font-family: 'poppins';">
            <div class="col-md-12 mt-1">
                <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="1400">Course Semester <?= $this->uri->segment(3); ?>
                </h1>
                <p>Hello Students! , Ini merupakan halaman course Sales University! Silahkan pilih course yang dapat kamu
                    akses
                    dan taddaa video dan materi siap disaksikan! Course yang terkunci akan terbuka setelah students menyelesaikan course yang terbuka </p>
                <hr>
                <h4 data-aos="fade-down" data-aos-duration="1700"><?php echo $this->session->userdata('nama'); ?> - Sales University Students</h3>
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
                <div class="card-deck">
                    <?php
                    foreach ($course as $c) {
                    ?>
                        <a href="<?= base_url('user/course/' . $c->id_mapel) ?>">
                            <div class="col-sm-4 mb-2 d-flex justify-content-center" data-aos-duration="1900" data-aos="fade-left">
                                <div class="card mt-4 text-center">
                                    <img class="card-img-top" src="<?= base_url('assets/img/courses/' . $c->image) ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title" style="color: black;"><?= $c->nama_mapel ?></h5>
                                        <p class="card-text" style="color: black;"><?= substr($c->desk, 0, 20) ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="<?= base_url('user/course/' . $c->id_mapel) ?>">Pilih Course</a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>