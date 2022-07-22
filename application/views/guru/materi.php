<?php $this->load->view('guru/template_guru/header'); ?>


<!-- Start Greetings Card -->
<div class="container">
    <div class="card shadow bg-white mx-auto p-4 buat-text " data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
        <div class="row" style="color: black; font-family: 'poppins';">

            <div class="col-md-8 mt-1">
                <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="1400"><?= $mapel->nama_mapel ?>
                </h1>
                <p>Hello!, Ini merupakan halaman akses link zoom, Anda dapat klik <b> link zoom </b>untuk bergabung Kelas Live</p>
                <!-- <h3><a href="<?= base_url('user/semester/' . $semester->semester) ?>" class="badge badge-info"><i class="fa fa-arrow-left"></i> Kembali ke List Course</a></h3> -->
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
            foreach ($live as $m) {
                $id_mapel = $m->id_mapel;
                $date_mulai = date_create($m->tgl_mulai);
                $date_selesai = date_create($m->tgl_selesai);
            ?>
                <div class="col-md-12 mt-3">
                    <div class="list-group">
                        <div class="card shadow bg-white mx-auto p-4 buat-text text-center" data-aos-duration="1400" style="width: 100%; border-radius:10px; height: 100%;">
                            <div class="card-body">

                                <div class="d-flex justify-content-between">
                                    <?php
                                    if (strtotime(date('Y-m-d H:i:s')) >= strtotime(date_format($date_mulai, 'Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) <= strtotime(date_format($date_selesai, 'Y-m-d H:i:s'))) { ?>
                                        <h5 style="color:green"> Sedang Berlangsung </h5>
                                    <?php  } elseif (strtotime(date('Y-m-d H:i:s')) >= strtotime(date_format($date_mulai, 'Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) >= strtotime(date_format($date_selesai, 'Y-m-d H:i:s'))) { ?>
                                        <h5 style="color:red">Berakhir</h5>
                                    <?php  } elseif (strtotime(date('Y-m-d H:i:s')) <= strtotime(date_format($date_mulai, 'Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) <= strtotime(date_format($date_selesai, 'Y-m-d H:i:s'))) { ?>
                                        <h5 style="color:#33b5e5"><i class="fa fa-calendar-o" title="Selesai" style="color:#33b5e5"></i> <?= date_format($date_mulai, 'd F Y')  ?></h5>
                                        <h5 style="color:#33b5e5"><i class="fa fa-clock-o" title="Selesai" style="color:#33b5e5"></i> <?= date_format($date_mulai, 'H:i')  ?> WIB</h5>
                                    <?php  }
                                    ?>
                                </div>
                                <h2 class="card-title" style="color: black;"><?= $m->nama_mapel ?></h2>
                                <a class="btn btn-primary" href="<?= $m->link ?>"><b style="color: white;">Link Zoom</b></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- End Class Card -->
<?php $this->load->view('guru/template_guru/footer'); ?>