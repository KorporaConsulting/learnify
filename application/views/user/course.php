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
                    dan taddaa materi dan video materi siap disaksikan! Dan jangan lupa kerjakan ujian agar kamu lulus 😉 </p>
                <hr>
                <h4 data-aos="fade-down" data-aos-duration="1700"><?php echo $this->session->userdata('nama'); ?> - Sales University Students</h3>
                    <h3><a href="<?= base_url('user/all_semester') ?>" class="badge badge-info"><i class="fa fa-arrow-left"></i> Kembali ke List Semester</a></h3>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row mt-4 mb-5 justify-content-center">
        <?php
        foreach ($course as $c) {
        ?>
            <div class="col-md-4 ">
                <a href="<?= base_url('user/course/' . $c->slug_mapel) ?>">
                    <div class="card shadow bg-white mx-auto p-4 buat-text text-center" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
                        <img class="card-img-top" src="<?= base_url('assets/img/courses/' . $c->image) ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title" style="color: black;"><?= $c->nama_mapel ?></h5>
                            <p class="card-text" style="color: black;"><?= substr($c->desk, 0, 20) ?></p>
                        </div>
                        <a class="btn btn-block card-footer" href="<?= base_url('user/course/' . $c->slug_mapel) ?>">Pilih Course</a>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
</div>
<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>