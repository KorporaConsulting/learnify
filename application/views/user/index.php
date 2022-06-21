<?php $this->load->view('user/template_user/header'); ?>
<!-- Start Greetings Card -->
<!-- <div class="container">
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
</div> -->

<div class="container">
    <div class="row mt-1">
        <div class="col-md-4">
            <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                <div class="row" style="color: black; font-family: 'poppins';">
                    <div class="col-md-12 mt-1 text-center">
                        <img class="rounded-circle" width="100px" alt="100x100" src="<?= base_url('assets/profile_picture/') . $user->image_user ?>" data-holder-rendered="true">
                        <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="400"> </h1>
                        <h5><?= $user->nama ?></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                <div class="row" style="color: black; font-family: 'poppins';">
                    <div class="col-md-12 mt-1 text-center">
                        <img class="img-fluid" width="100px" alt="100x100" src="<?= base_url() . $user->qr_code ?>" data-holder-rendered="true">
                        <!-- <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="400"> </h1> -->
                        <h5>QR absensi</h5>
                        <!-- <a href="<?= site_url('user/regenerate_qrcode') ?>" class="btn btn-sm btn-warning">Generate Ulang</a>
                        <a href="<?= base_url($user->qr_code) ?>" class="btn btn-sm btn-info" download>Download</a> -->
                        <button type="button" class="btn btn-sm btn-primary" onclick="absen()">Absen</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                <div class="row" style="color: black; font-family: 'poppins';">
                    <div class="col-md-6 mt-1">
                        <h5 class="text-center">Kehadiran</h5>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="kehadiran">75/100</div>
                        </div>
                        <!-- <img class="img-fluid" width="100px" alt="100x100" src="<?= base_url('assets/img/qr-code-login/qr_icon.svg') ?>" data-holder-rendered="true"> -->
                    </div>
                    <div class="col-md-6 mt-1">
                        <h5 class="text-center">Ketepatan Absen</h5>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">90%</div>
                        </div>
                        <!-- <img class="img-fluid" width="100px" alt="100x100" src="<?= base_url('assets/img/qr-code-login/qr_icon.svg') ?>" data-holder-rendered="true"> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Greetings Card -->


<br>


<!-- Start Class Card -->
<div class="container">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="col-md-12 ">
            <div class="row justify-content-center">
                <?php foreach ($semester as $s) { ?>
                    <div class="col-sm-4 mb-2 d-flex justify-content-center " data-aos-duration="400" data-aos="fade-right">
                        <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                            <a href="<?= base_url('user/semester/' . $s->semester) ?>">
                                <div class="card text-warning">
                                    <img class="card-img" src="<?= base_url('assets/img/' . $s->image_semester) ?>" alt="Card image">
                                    <div class="card-img-overlay">
                                        <h2 class="card-title align-items-center d-flex justify-content-center py-5 mt-5 pt-5">Semester <?= $s->semester ?></h2>
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


<!-- Modal Absen-->
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
                            $('#kehadiran').html('76/100');
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