<?php $this->load->view('user/template_user/header'); ?>
<?php $this->load->view('user/template_user/navbar'); ?>

<!-- Start Greetings Card -->
<div class="container">
    <div class="bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
        <div class="row" style="color: black; font-family: 'poppins';">
            <div class="col-md-12 mt-1">
                <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="1400">Materi Course <?= $mapel->nama_mapel ?>
                </h1>
                <p>Hello Students!, Ini merupakan halaman Materi Silahkan pilih materi yang dapat kamu
                    akses </p>
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
            <div class="card">
                <div class="card-header">
                    <h4>Materi</h4>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <?php foreach ($materi as $m) { ?>
                            <a href="<?= base_url('user/materi/' . $m->id_materi) ?>" class="list-group-item list-group-item-action"><?= $m->nama_materi ?><span class="badge badge-primary badge-pill float-right">belum selesai</span></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <ul class="list-group">

            </ul>
        </div>
    </div>
</div>
</div>
<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>