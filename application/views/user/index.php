<?php $this->load->view('user/template_user/header'); ?>
<!-- Start Greetings Card -->
<!-- <div class="container">
    <div class="card shadow bg-white mx-auto p-4 buat-text"  style="width: 100%; border-radius:20px;">
        <div class="row" style="color: black; font-family: 'poppins';">
            <div class="col-md-12 mt-1">
                <h1 class="display-4" style="color: black; font-family:'poppins';" >Selamat Datang
                    di Sales University <span style="font-size: 40px;">
                    </span> </h1>
                <p>Hello Students! , Ini merupakan halaman utama Sales University ! Selamat belajar ya students!</p>
                <hr>
            </div>
        </div>
    </div>
</div> -->



<div class="container pt-3" style="min-height: 100vh;">
    <div class="card mb-3 shadow bg-white mx-auto p-4 buat-text" style="width: 100%; border-radius:20px;">
        <div class="row ">
            <h2>Selamat Datang <?= $this->session->userdata('nama') ?></h2>
            <div class="bodymovin" style="width: 50px;" data-icon="<?= base_url('assets/') ?>json/hand.json"></div>
        </div>
        <p class="lead">Semoga aktivitas belajarmu disini menyenangkan.</p>
        <hr class="my-4">
        <p>Akses Course disini</p>
        <a class="btn btn-primary btn-lg" href="<?= base_url('user/all_semester') ?>" role="button">Course</a>
    </div>
    <?php
    if ($cek == false) { ?>
        <div class="shadow alert alert-warning rounded" role="alert">
            <div class="row">
                <div class="col-md-2">
                    <div class="bodymovin" style="width: 100px;" data-icon="<?= base_url('assets/') ?>json/warning.json"></div>
                </div>
                <div class="col-md-8">
                    <strong>Profile Anda belum lengkap</strong>
                    <p>Mohon lengkapi terlebih dahulu profile Anda</p>
                    <a class="btn btn-sm btn-primary" href="<?= base_url('user/profile') ?>" role="button">Lengkapi Profile</a>
                </div>
            </div>

        </div>
    <?php } ?>
    <div class="masonry">
        <div class="card shadow bg-white mx-auto p-4 buat-text item" style="width: 100%; border-radius:20px;">
            <div class="card-header" style="border-radius:20px;background-image: linear-gradient(to right, #2c3e50, #4ca1af);
">
                <h5 style="color: white;">Absensi</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3 justify-content-center" style="color: black; font-family: 'poppins';">
                    <div class="col-md-6 mt-1 text-center">
                        <img class="rounded-circle" width="100px" alt="100x100" src="<?= base_url('assets/profile_picture/') . $user->image_user ?>" data-holder-rendered="true">
                        <h1 class="display-4" style="color: black; font-family:'poppins';"> </h1>
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

        <div class="card shadow bg-white mx-auto p-4 buat-text item" style="width: 100%; border-radius:20px;background-image: linear-gradient(to right, #2c3e50, #4ca1af)">
            <div class="card-header">
                <h6 style="color: white;">Aktivitas Belajar</h6>
            </div>
            <div class="card-body">
                <?php foreach ($aktifitas_belajar as $value) : ?>
                    <div class="alert bg-light">
                        <div><small><b>Sedang dipelajari</b></small></div>
                        <div class="d-flex justify-content-between">
                            <span>
                                <?= $value->nama_activity ?>
                            </span>
                            <span>
                                <a class="btn btn-info" href="<?= $value->url ?>">Lanjutkan</a>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="card shadow bg-white mx-auto p-4 buat-text item" style="width: 100%; border-radius:20px; ">
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
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img class="img-fluid" src="<?= base_url('assets/img/courses/' . $value->image) ?>" alt="<?= $value->nama_mapel ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $value->nama_mapel ?></h5>
                                    <p class="card-text"><span class="badge badge-primary"><i class="fa fa-calendar"></i></span> <?= $tgl ?></p>
                                    <a class="btn btn-info" href="<?= base_url('user/course/') . $value->slug_mapel ?>">Gabung Live Kelas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="text-right mt-5">
                    <a href="<?= site_url('user/jadwal') ?>" class="text-dark" style="text-decoration: underline;">Selengkapnya</a>
                </div>
            </div>
        </div>

        <div class="card shadow bg-white mx-auto p-4 buat-text item" style="width: 100%; border-radius:20px;">
            <div class="card-header" style="border-radius:20px;background-image: linear-gradient(to right, #2c3e50, #4ca1af);
">
                <h6 style="color: white;">Recent Video</h6>
            </div>
            <div class="card-body">
                <?php foreach ($recent_video as $value) : ?>
                    <a href="<?= $value->url ?>">
                        <div class="card w-100 mb-3" style="width: 18rem;">
                            <img src="https://img.youtube.com/vi/<?= $value->link ?>/0.jpg" class="card-img-top" alt="<?= $value->nama_activity ?>">
                            <div class="card-body">
                                <b>Sedang dipelajari</b>
                                <p class="card-text"><?= $value->nama_activity ?></p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Absen -->
<div class="modal fade" id="absenModal" tabindex="-1" aria-labelledby="absenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="absenModalLabel">Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="batalAbsen()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="<?= base_url('assets/loader.svg') ?>" alt="" width="50" class="loader">
                <div id="reader"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="batalAbsen()">Batal</button>
            </div>
        </div>
    </div>
</div>
<?php if ($this->session->flashdata('sukses-login')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Selamat Datang',
            text: 'Anda berhasil Login',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    const html5QrCode = new Html5Qrcode( /* element id */ "reader");
    const absen = function() {
        $('#absenModal').modal('show');

        Html5Qrcode.getCameras().then(devices => {
            /**
             * devices would be an array of objects of type:
             * { id: "id", label: "label" }
             */

            if (devices && devices.length) {
                $('.loader').hide()
                var cameraId = devices[0].id;
                html5QrCode.start(
                        cameraId, {
                            fps: 10, // Optional, frame per seconds for qr code scanning
                            qrbox: {
                                width: 250,
                                height: 250
                            } // Optional, if you want bounded box UI
                        },
                        (decodedText, decodedResult) => {

                            $('#absenModal').modal('hide');
                            $('#kehadiran').html('76/100');

                            $.

                            html5QrCode.stop().then((ignore) => {
                                // QR Code scanning is stopped.
                            }).catch((err) => {
                                // Stop failed, handle it.
                            });
                            Swal.fire('Berhasil', 'Berhasil Absen hari ini', 'success');
                        },
                        (errorMessage) => {
                            // parse error, ignore it.
                        })
                    .catch((err) => {
                        // Start failed, handle it.
                    });
            }
        }).catch(err => {
            // handle err
        });
    }

    const batalAbsen = function() {
        html5QrCode.stop().then((ignore) => {
            // QR Code scanning is stopped.
        }).catch((err) => {
            // Stop failed, handle it.
        });
    }
</script>
<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>