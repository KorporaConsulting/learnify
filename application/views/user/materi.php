<?php $this->load->view('user/template_user/header'); ?>

<!-- Start Greetings Card -->
<div class="container">
    <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
        <div class="row" style="color: black; font-family: 'poppins';">
            <div class="col-md-12 mt-1">
                <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="1400">Materi Course <?= $mapel->nama_mapel ?>
                </h1>
                <p>Hello Students!, Ini merupakan halaman Materi Silahkan pilih materi yang dapat kamu
                    akses </p>
                <h3><a href="<?= base_url('user/semester/' . $semester->semester) ?>" class="badge badge-info"><i class="fa fa-arrow-left"></i> Kembali ke List Course</a></h3>
            </div>
        </div>
    </div>
</div>
<!-- End Greetings Card -->


<br>


<!-- Start Class Card -->
<div class="container">

    <div class="bg-white mx-auto p-4 buat-text mt-5 mb-5" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
        <div class="row" style="color: black; font-family: 'poppins';">
            <?php
            $no = 1;
            foreach ($materi as $m) { ?>
                <div class="col-md-12 mt-1">
                    <div class="list-group">
                        <a href="<?= base_url('user/materi/' . $m->id_mapel . '/' . $m->slug_materi) ?>">
                            <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos-duration="1400" border-radius:10px;">
                                <div class="row" style="color: black; font-family: 'poppins';">
                                    <div class="col-md-12 mt-1">
                                        <h2><?php if ($m->status == 0) { ?>
                                                <i class="fa fa-circle-thin float-right" style="color:green"></i>
                                                <!-- <span class="badge badge-warning badge-pill float-right">Belum selesai</span> -->
                                            <?php } elseif ($m->status == 1) { ?>
                                                <i class="fa fa-check-circle float-right" title="Selesai" style="color:green"></i>
                                                <!-- <span class="badge badge-primary badge-pill float-right">Selesai</span> -->
                                            <?php } ?>
                                        </h2>
                                        <h1 class="display-5" style="color: black; font-family:'poppins';" data-aos-duration="1400"><?= $m->nama_materi ?>
                                        </h1>
                                        <p><?= $m->desk_materi ?></p>
                                    </div>
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