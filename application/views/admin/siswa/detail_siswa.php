<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="">
            <div class="card" style="width:100%;">
                <div class="card-body">
                    <h2 class="card-title" style="color: black;">Detail Siswa | <?= $detail->nama ?> </h2>
                    <hr>
                    <!-- <p class="card-text"> After I ran into Helen at a restaurant, I realized she was just office pretty drop-dead date put in in a deck for our standup today. Who's responsible for the ask for this request? who's responsible for the ask for this request? but moving the goalposts gain traction.
                    </p>
                    <a href="#detail" class="btn btn-success">Saya paham dan
                        ingin melanjutkan ⭢</a> -->
                </div>
            </div>
            <div class="">
                <div class="hero text-white hero-bg-image" data-background="<?= base_url('assets/') ?>stisla-assets/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg">
                    <div class="col-md-4 mx-auto rounded-circle bg-white p-3" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                        <img src="<?= base_url() . 'assets/profile_picture/' . $detail->image_user; ?>" class="card-img-top  rounded-circle img-responsive" alt="...">
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-12 bg-white p-3" id="detail" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                <h1 class="font-weight-bold card-title text-center" style="color: black;">Detail Siswa </h1>
                <p class="text-center" style="line-height: 5px;">Berikut data detail yang terdapat di
                    database, meliputi Nama, Email,
                    Photo, alamat, tanggal lahir, jenis kelamin
                    dan Date Created.</p>
                <hr>
                <table style="width: 100%" class="container text-center">
                    <tbody>
                        <tr style="border-bottom: 0.5px solid #6c757d;">
                            <td><span class="font-weight-bold">Nama Siswa :</span></td>
                            <td> <?= $detail->nama ?></td>
                        </tr>
                        <tr style="border-bottom: 0.5px solid #6c757d;">
                            <td><span class="font-weight-bold">Alamat Email :</span></td>
                            <td> <?= $detail->email ?></td>
                        </tr>
                        <tr style="border-bottom: 0.5px solid #6c757d;">
                            <td><span class="font-weight-bold">Jenis Kelamin :</span></td>
                            <td> <?= $detail->jk ?></td>
                        </tr>
                        <tr style="border-bottom: 0.5px solid #6c757d;">
                            <td><span class="font-weight-bold">Tanggal Lahir :</span></td>
                            <td> <?= $detail->ttl ?></td>
                        </tr>
                        <tr style="border-bottom: 0.5px solid #6c757d;">
                            <td><span class="font-weight-bold">Alamat:</span></td>
                            <td> <?= $detail->alamat ?></td>
                        </tr>
                        <tr style="border-bottom: 0.5px solid #6c757d;">
                            <td><span class="font-weight-bold">Password : </span></td>
                            <td>Terenkripsi</td>
                        </tr>
                        <tr style="border-bottom: 0.5px solid #6c757d;">
                            <td><span class="font-weight-bold">Terdaftar pada :</span></td>
                            <td><?= $detail->created_at ?></td>
                        </tr>
                    </tbody>
                </table>
                <p style="font-weight:500px!important;font-size:18px;text-align:justify;" class="text-justify">
                </p>
                <a href="<?= base_url('admin/data_siswa') ?>" class="btn btn-success btn-block">Kembali</a>
            </div>
        </div>
    </section>
</div>
</div>
</div>
<!-- End Main Content -->

<?php
$this->load->view('admin/template_admin/footer');
?>