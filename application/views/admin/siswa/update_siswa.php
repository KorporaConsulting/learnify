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
                    <h2 class="card-title" style="color: black;">Edit data siswa</h2>
                    <hr>
                    <!-- <p class="card-text">After I ran into Helen at a restaurant, I realized she was just office pretty drop-dead date put in in a deck for our standup today. Who's responsible for the ask for this request? who's responsible for the ask for this request? but moving the goalposts gain traction.
                    </p> -->
                    <!-- <a href="#detail" class="btn btn-success">Saya paham dan
                        ingin melanjutkan ⭢</a> -->
                </div>
            </div>
        </div>
        <form action="<?= base_url('admin/user_edit') ?>" enctype="multipart/form-data" method="post">
            <?php foreach ($user as $u) { ?>
                <div class="">
                    <div class="hero text-white hero-bg-image" data-background="<?= base_url('assets/') ?>stisla-assets/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg">
                        <div class="col-md-4 mx-auto rounded-circle bg-white p-3" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                            <img src="<?= base_url() . 'assets/profile_picture/' . $u->image_user; ?>" class="card-img-top  rounded-circle img-responsive" alt="...">
                        </div>
                    </div>
                </div>
                <br>
                <div id="detail" class="col-md-12 bg-white p-3" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                    <h1 class="font-weight-bold card-title text-center" style="color: black;">Update Data
                        Siswa
                    </h1>
                    <p class="text-center" style="line-height: 5px;">Silahkan isi data dibawah untuk update
                        data, dan upload file diatas untuk update data profile picture</p>
                    <hr>
                    <div class="form-group">
                        <label for="nis">Nomer Induk Siswa</label>
                        <input id="nis" readonly type="number" class="form-control" value="<?= $u->nis ?>" name="nis">
                        <?= form_error('nis', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id_user" value="<?= $u->id_user ?>">
                        <input type="hidden" name="password" value="<?= $u->password ?>">
                        <input type="hidden" name="date_created" value="<?= $u->created_at ?>">
                        <label for="exampleInputEmail1" class="font-weight-bold" style="font-size: 20px;">Nama</label>
                        <input type=" text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required name="nama" value="<?= $u->nama ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="font-weight-bold" style="font-size: 20px;">Email</label>
                        <input type="email" class="form-control" readonly name="email" value="<?= $u->email ?>" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="font-weight-bold" style="font-size: 20px;">Nomer Telepon</label>
                        <input type="number" class="form-control" name="no_telp" required value="<?= $u->no_telp ?>" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <div class="section-title">Terpilih</div>
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="jk" value="Laki-laki" class="selectgroup-input" <?php if ($u->jk == 'Laki-laki') echo 'checked' ?>>
                                <span class="selectgroup-button">Laki - laki</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="jk" value="Perempuan" class="selectgroup-input" <?php if ($u->jk == 'Perempuan') echo 'checked' ?>>
                                <span class="selectgroup-button">Perempuan</span>
                            </label>
                        </div>
                        <?= form_error('jk', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="ttl" value="<?= $u->ttl ?>" required class="form-control">
                        <?= form_error('ttl', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" required cols="30" rows="10"><?= $u->alamat  ?></textarea>
                        <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <input type="submit" value="Update ⭢" class="btn btn-success btn-block">
                </div>
            <?php } ?>
        </form>
    </section>
</div>
</div>
</div>
<!-- End Main Content -->

<?php
$this->load->view('admin/template_admin/footer');
?>