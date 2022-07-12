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
    <div class="accordion" id="accordionExample">
        <div class="card shadow bg-white mx-auto p-4 buat-text">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button id="course" class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h4>Course <i id="icon-course" class="fa fa-arrow-down"></i></h4>
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row mt-4 mb-5 justify-content-center">
                        <?php
                        foreach ($course as $c) {
                        ?>
                            <div class="col-md-4 ">
                                <?php if ($c->kunci == 1) { ?>
                                    <a href="<?= base_url('user/course/' . $c->slug_mapel) ?>">
                                    <?php } else { ?>
                                        <a class="disabled" href="#">
                                        <?php } ?>
                                        <div class="card shadow bg-white mx-auto p-4 buat-text text-center" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
                                            <h2><?php if ($c->status == 0 && $c->kunci == 0) { ?>
                                                    <i class="fa fa-lock float-right" title="Terkunci" style="color:red"></i>
                                                    <!-- <span class="badge badge-warning badge-pill float-right">Belum selesai</span> -->
                                                <?php } elseif ($c->status == 1 && $c->kunci == 1) { ?>
                                                    <i class="fa fa-check-circle float-right" title="Selesai" style="color:#33b5e5"></i>
                                                    <!-- <span class="badge badge-primary badge-pill float-right">Selesai</span> -->
                                                <?php } elseif ($c->status == 0 && $c->kunci == 1) { ?>
                                                    <i class="fa fa-circle-o float-right" title="Dikerjakan" style="color:green"></i>
                                                <?php } ?>
                                            </h2>
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
        </div>
        <div class="card shadow bg-white mx-auto p-4 buat-text">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button id="live-class" class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h4>Live Class <i id="icon-live-class" class="fa fa-arrow-down"></i></h4>
                    </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row mt-4 mb-5 justify-content-center">
                        <?php
                        foreach ($zoom as $c) {
                            $date_mulai = date_create($c->tgl_mulai);
                            $date_selesai = date_create($c->tgl_selesai);
                        ?>
                            <div class="col-md-4 ">
                                <a href="<?= base_url('user/course/' . $c->slug_mapel) ?>">
                                    <div class="card shadow bg-white mx-auto p-4 buat-text text-center" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
                                        <div class="d-flex justify-content-between">
                                            <?php
                                            if (strtotime(date('Y-m-d H:i:s')) >= strtotime(date_format($date_mulai, 'Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) <= strtotime(date_format($date_selesai, 'Y-m-d H:i:s'))) { ?>
                                                <h5 style="color:green"> Sedang Berlangsung </h5>
                                            <?php  } elseif (strtotime(date('Y-m-d H:i:s')) >= strtotime(date_format($date_mulai, 'Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) >= strtotime(date_format($date_selesai, 'Y-m-d H:i:s'))) { ?>
                                                <h5 style="color:red"> Sudah lewat </h5>
                                            <?php  } elseif (strtotime(date('Y-m-d H:i:s')) <= strtotime(date_format($date_mulai, 'Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) <= strtotime(date_format($date_selesai, 'Y-m-d H:i:s'))) { ?>
                                                <h5 style="color:#33b5e5"><i class="fa fa-calendar-o" title="Selesai" style="color:#33b5e5"></i> <?= date_format($date_mulai, 'd F Y')  ?></h5>
                                                <h5 style="color:#33b5e5"><i class="fa fa-clock-o" title="Selesai" style="color:#33b5e5"></i> <?= date_format($date_mulai, 'H:i')  ?></h5>
                                            <?php  }
                                            ?>

                                        </div>
                                        <img class="card-img-top" src="<?= base_url('assets/img/courses/' . $c->image) ?>" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title" style="color: black;"><?= $c->nama_mapel ?></h5>
                                            <p class="card-text" style="color: black;"><?= substr($c->desk, 0, 20) ?></p>
                                        </div>
                                        <a class="btn btn-block card-footer btn-info" href="<?= base_url('user/course/' . $c->slug_mapel) ?>"><b style="color: black;">Gabung Live Class</b></a>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('#course').on('click', function() {
            $("#icon-course").hide();
        });
    });
    $(document).ready(function() {
        $('#live-class').on('click', function() {
            $("#icon-live-class").hide();
        });
    });
</script>
<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>