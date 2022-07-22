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
                    <h2 class="card-title" style="color: black;">Tambah Data Mentor</h2>
                    <hr>
                    <!-- <p class="card-text"> After I ran into Helen at a restaurant, I realized she was just office pretty drop-dead date put in in a deck for our standup today. Who's responsible for the ask for this request? who's responsible for the ask for this request? but moving the goalposts gain traction.
                    </p>
                    <a href="#detail" class="btn btn-success">Saya paham dan
                        ingin melanjutkan ⭢</a> -->
                </div>
            </div>
        </div>

        <div id="detail" class="card card-success">
            <div class="col-md-12 text-center">
                <p class="registration-title font-weight-bold display-4 mt-4" style="color:black; font-size: 50px;">
                    Pendaftaran Mentor</p>
                <p style="line-height:-30px;margin-top:-20px;">Silahkan isi data data yang diperlukan
                    dibawah </p>
                <hr>
            </div>

            <div class="card-body">
                <form method="POST" action="<?= base_url('admin/add_guru') ?>">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input id="nama" type="text" class="form-control" value="<?= $nama; ?>" name="nama">
                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" value="<?= $email; ?>" name="email">
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="ttl" value="<?php echo $ttl ?>" class="form-control">
                        <?= form_error('ttl', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <div class="section-title">Terpilih</div>
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="jk" value="Laki-laki" class="selectgroup-input" checked="">
                                <span class="selectgroup-button">Laki - laki</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="jk" value="Perempuan" class="selectgroup-input">
                                <span class="selectgroup-button">Perempuan</span>
                            </label>
                        </div>
                        <?= form_error('jk', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10"><?= $alamat; ?></textarea>
                        <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="password" class="d-block">Password</label>
                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                            <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="password2" class="d-block">Konfirmasi Password</label>
                            <input id="password2" type="password" class="form-control" name="password2">
                            <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            Daftar ⭢
                        </button>
                    </div>

                </form>
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