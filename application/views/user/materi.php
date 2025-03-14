<?php $this->load->view('user/template_user/header'); ?>


<!-- Start Greetings Card -->
<div class="container">
    <div class="card shadow bg-white mx-auto p-4 buat-text " data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;background-image: linear-gradient(to right, #2c3e50, #4ca1af)">
        <div class="row" style="color: white; font-family: 'poppins';">

            <?php if ($mapel->is_zoom == 1) {
                $date_mulai = date_create($mapel->tgl_mulai);
                $date_selesai = date_create($mapel->tgl_selesai);

            ?>
                <div class="col-md-8 mt-1">
                    <h1 class="display-4" style="color: white; font-family:'poppins';" data-aos="fade-down" data-aos-duration="1400"><?= $mapel->nama_mapel ?>
                    </h1>
                    <h4>Hello Students!, Ini merupakan halaman Live Kelas</h4>
                    <h3><a href="<?= base_url('user/semester/' . $semester->semester) ?>" class="badge badge-info"><i class="fa fa-arrow-left"></i> Kembali ke List Course</a></h3>
                </div>
                <?php if (strtotime(date('Y-m-d')) >= strtotime(date_format($date_mulai, 'Y-m-d')) && strtotime(date('Y-m-d')) <= strtotime(date_format($date_selesai, 'Y-m-d'))) { ?>
                    <?php if (strtotime(date('H:i:s')) >= strtotime(date_format($date_mulai, 'H:i:s')) - 600 && strtotime(date('H:i:s')) <= strtotime(date_format($date_selesai, 'H:i:s'))) { ?>
                        <?php if ($check_absensi == 0) { ?>
                            <div class="col-md-4 mt-1 text-center">
                                <p>Silahkan Absen Untuk Gabung Live Kelas</p>
                                <img class="img-fluid" width="200px" alt="100x100" src="<?= base_url() . $user->qr_code ?>" data-holder-rendered="true">
                                <h5>QR absensi</h5>
                                <!-- <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="400"> </h1> -->
                                <!-- <a href="<?= site_url('user/regenerate_qrcode') ?>" class="btn btn-sm btn-warning">Generate Ulang</a>
                        <a href="<?= base_url($user->qr_code) ?>" class="btn btn-sm btn-info" download>Download</a> -->
                                <button type="button" class="btn btn-sm btn-primary" onclick="absen()">Absen</button>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <div class="col-md-8 mt-1">
                    <h1 class="display-4" style="color: white; font-family:'poppins';" data-aos="fade-down" data-aos-duration="1400"><?= $mapel->nama_mapel ?>
                    </h1>
                    <p>Hello Students!, Ini merupakan halaman Materi Silahkan pilih materi yang dapat kamu
                        akses </p>
                    <h3><a href="<?= base_url('user/semester/' . $semester->semester) ?>" class="badge badge-info"><i class="fa fa-arrow-left"></i> Kembali ke List Course</a></h3>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- End Greetings Card -->
<br>
<?php if ($mapel->is_zoom == 1) { ?>
    <?php if ($check_absensi == 0) { ?>
        <div class="container">
            <div class="bg-white mx-auto p-4 buat-text mt-5 mb-5" style="width: 100%; border-radius:10px;">
                <div class="row" style="color: black; font-family: 'poppins';">
                    <div class="col-md-12 mt-1">
                        <?php
                        $date_mulai = date_create($live->tgl_mulai);
                        $date_selesai = date_create($live->tgl_selesai);
                        if (strtotime(date('Y-m-d H:i:s')) >= strtotime(date_format($date_mulai, 'Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) <= strtotime(date_format($date_selesai, 'Y-m-d H:i:s'))) { ?>
                            <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos-duration="1400" border-radius:10px;">
                                <div class="row" style="color: black; font-family: 'poppins';">
                                    <!-- <div class="list-group"> -->
                                    <div class="col-2 text-center">
                                        <img src="<?= base_url('assets/img/icon/ban.png') ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-10 text-center mt-5">
                                        <h2>
                                            Silahkan absen terlebih dahulu untuk bergabung Live Kelas
                                        </h2>
                                    </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                        <?php } else { ?>
                            <h3 class="card-title display-5">Rekaman <?= $live->nama_mapel ?></h3>
                            <hr style="background-color: white;">
                            <?php if ($live->video == null) { ?>
                                <div class="card shadow bg-white mx-auto p-4 buat-text text-center" data-aos-duration="1400" style="width: 100%; border-radius:10px; height: 100%;">
                                    <div class="card-body">
                                        <h4>Rekaman Belum Tersedia</h4>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <!-- <div class="card shadow bg-white mx-auto p-4 buat-text text-center" data-aos-duration="1400" style="width: 100%; border-radius:10px; height: 100%;">
                                <div class="card-body"> -->
                                <div class="plyr__video-embed" id="rekaman" style="width: 100%;">
                                    <!-- <div id="vid"></div> -->
                                    <div class="embed-responsive embed-responsive-9by16">
                                        <iframe allowfullscreen allowtransparency allow="autoplay" class="embed-responsive-item" src="https://www.youtube-nocookie.com/embed/<?= $live->video ?>"></iframe>
                                        <!-- <iframe id="existing-iframe-example" src="https://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1" frameborder="0"></iframe> -->
                                    </div>
                                    <!-- </div>
                                </div> -->
                                </div>
                            <?php  } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <!-- Start Class Card -->
        <div class="container">
            <div class="bg-white mx-auto p-4 buat-text mt-5 mb-5" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
                <div class="row" style="color: black; font-family: 'poppins';">
                    <?php
                    $date_mulai = date_create($live->tgl_mulai);
                    $date_selesai = date_create($live->tgl_selesai);
                    if (strtotime(date('Y-m-d H:i:s')) >= strtotime(date_format($date_mulai, 'Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) <= strtotime(date_format($date_selesai, 'Y-m-d H:i:s'))) { ?>
                        <div class="col-md-12 mt-3">
                            <div class="list-group">
                                <div class="card shadow bg-white mx-auto p-4 buat-text text-center" data-aos-duration="1400" style="width: 100%; border-radius:10px; height: 100%;">
                                    <div class="card-body">
                                        <h2 class="card-title" style="color: black;"><?= $live->nama_mapel ?></h2>
                                        <a class="btn btn-primary" href="<?= $live->link ?>"><b style="color: white;">Link Zoom</b></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php  } else { ?>
                        <h3 class="card-title display-5">Rekaman <?= $live->nama_mapel ?></h3>
                        <hr style="background-color: white;">
                        <?php if ($live->video == null) { ?>
                            <div class="card shadow bg-white mx-auto p-4 buat-text text-center" data-aos-duration="1400" style="width: 100%; border-radius:10px; height: 100%;">
                                <div class="card-body">
                                    <h4>Rekaman Belum Tersedia</h4>
                                </div>
                            </div>
                        <?php } else { ?>
                            <!-- <div class="card shadow bg-white mx-auto p-4 buat-text text-center" data-aos-duration="1400" style="width: 100%; border-radius:10px; height: 100%;">
                                <div class="card-body"> -->
                            <div class="plyr__video-embed" id="rekaman" style="width: 100%;">
                                <!-- <div id="vid"></div> -->
                                <div class="embed-responsive embed-responsive-9by16">
                                    <iframe allowfullscreen allowtransparency allow="autoplay" class="embed-responsive-item" src="https://www.youtube-nocookie.com/embed/<?= $live->video ?>"></iframe>
                                    <!-- <iframe id="existing-iframe-example" src="https://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1" frameborder="0"></iframe> -->
                                </div>
                                <!-- </div>
                                </div> -->
                            </div>
                        <?php  } ?>
                    <?php  } ?>


                </div>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="container">
        <div class="bg-white mx-auto p-4 buat-text mt-5 mb-5" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
            <div class="row" style="color: black; font-family: 'poppins';">
                <?php
                $no = 1;
                foreach ($materi as $m) {
                    $id_mapel = $m->id_mapel;
                ?>
                    <div class="col-md-4 mt-3">
                        <div class="list-group">
                            <?php if ($m->kunci == 1) { ?>
                                <a href="<?= base_url('user/materi/' . $m->id_mapel . '/' . $m->slug_materi)
                                            ?>">
                                <?php } else { ?>
                                    <a class="disabled" href="#">
                                    <?php } ?>
                                    <div class="card shadow bg-white mx-auto p-4 buat-text text-center" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
                                        <h3>
                                            <?php if ($m->status == 0 && $m->kunci == 0) { ?>
                                                <i class="fa fa-lock float-right" title="Terkunci" style="color:red"></i>
                                                <!-- <span class="badge badge-warning badge-pill float-right">Belum selesai</span> -->
                                            <?php } elseif ($m->status == 1 && $m->kunci == 1) { ?>
                                                <i class="fa fa-check-circle float-right" title="Selesai" style="color:#33b5e5"></i>
                                                <!-- <span class="badge badge-primary badge-pill float-right">Selesai</span> -->
                                            <?php } elseif ($m->status == 0 && $m->kunci == 1) { ?>
                                                <i class="fa fa-circle-o float-right" title="Sedang Dipelajari" style="color:green"></i>
                                            <?php } ?>
                                        </h3>
                                        <div class="card-body">
                                            <h2 class="card-title" style="color: black;"><?= $m->nama_materi ?></h2>
                                            <p class="card-text" style="color: black;"><?= substr($m->desk_materi, 0, 20) ?></p>
                                        </div>
                                    </div>
                                    </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

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
                            // $('#kehadiran').html('76/100');

                            // console.log(decodedText);

                            $.ajax({
                                url: "<?= base_url('user/absensi_input') ?>",
                                type: 'POST',
                                data: {
                                    qr_code: decodedText,
                                    id_mapel: "<?= $mapel->id_mapel ?>",
                                    id_user: "<?= $this->session->userdata('id_user') ?>",
                                    status_absensi: 1,
                                },
                                error: function() {
                                    alert('Something is wrong');
                                },
                                success: function(data) {
                                    // console.log(data)
                                    if (data == 'error') {
                                        Swal.fire('Gagal', 'gagal', 'error');
                                    } else {
                                        Swal.fire('Berhasil', 'Berhasil Absen', 'success');
                                        // location.reload();
                                        window.location.href = "<?= $mapel->link ?>";
                                    }

                                }
                            });

                            html5QrCode.stop().then((ignore) => {
                                // QR Code scanning is stopped.
                            }).catch((err) => {
                                // Stop failed, handle it.
                            });

                            // Swal.fire('Berhasil', 'Berhasil Absen', 'success');
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