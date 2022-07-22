<?php $this->load->view('guru/template_guru/header'); ?>

<div class="container pt-3" style="min-height: 100vh;">
    <div class="card mb-3 shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
        <h2>Selamat Datang <?= $this->session->userdata('nama_guru') ?> 👋🏻</h2>
        <p class="lead">Semoga aktivitas mengajarmu disini menyenangkan.</p>
        <hr class="my-4">
        <!-- <p>Akses Course disini</p> -->
        <!-- <a class="btn btn-primary btn-lg" href="<?= base_url('user/all_semester') ?>" role="button">Course</a> -->
    </div>
    <!-- <div class="masonry"> -->
    <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px; ">
        <div class="card-header" style="border-radius:20px;background-image: linear-gradient(to right, #2c3e50, #4ca1af);
">
            <h6 style="color: white;">Jadwal Live Kelas Hari Ini</h6>
        </div>
        <div class="card-body">
            <?php foreach ($jadwal as $value) : ?>
                <?php
                $date = date_create($value->tgl_mulai);
                $tgl = date_format($date, 'd F Y H:i');
                ?>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img class="img-fluid" src="<?= base_url('assets/img/courses/' . $value->image) ?>" alt="<?= $value->nama_mapel ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= $value->nama_mapel ?></h5>
                                    <p class="card-text"><span class="badge badge-primary"><i class="fa fa-calendar"></i></span> <?= $tgl ?></p>
                                    <a class="btn btn-info" href="<?= base_url('mentor/course/') . $value->slug_mapel ?>">Gabung Live Kelas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="text-right mt-5">
                <a href="<?= site_url('mentor/jadwal') ?>" class="text-dark" style="text-decoration: underline;">Selengkapnya</a>
            </div>
        </div>
    </div>
    <!-- </div> -->
</div>


<!-- End Class Card -->
<?php $this->load->view('guru/template_guru/footer'); ?>