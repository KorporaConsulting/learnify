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
                    <h2 class="card-title" style="color: black;">Tambah Course</h2>
                    <hr>
                    <!-- <p class="card-text"> Anda akan menambah siswa baru, mohon untuk diisi secara lengkap.
                    </p>
                    <a href="#detail" class="btn btn-success">Saya paham dan
                        ingin melanjutkan ⭢</a> -->
                </div>
            </div>
        </div>

        <div id="detail" class="card card-success">
            <div class="col-md-12 text-center">
                <p class="registration-title font-weight-bold display-4 mt-4" style="color:black; font-size: 50px;">
                    Tambah Course</p>
                <p style="line-height:-30px;margin-top:-20px;">Silahkan isi data data yang diperlukan
                    dibawah </p>
                <hr>
            </div>

            <div class="card-body">
                <form method="POST" action="<?= base_url('admin/insert_mapel') ?>" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="nama_mapel">Nama Course</label>
                        <input id="nama_mapel" type="text" class="form-control" value="<?php echo set_value('nama_mapel') ?>" name="nama_mapel">
                        <?= form_error('nama_mapel', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="desk" id="desk" cols="30" rows="10"><?php echo set_value('desk') ?></textarea>
                        <?= form_error('desk', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Gambar Course</div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <?= form_error('image', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label>Mentor Course</label>
                            <select class="form-control select2" name="guru">
                                <option disabled selected>Pilih Mentor</option>
                                <?php foreach ($mentor as $m) { ?>
                                    <option value="<?= $m->id_guru ?>" <?php echo set_select('guru', $m->id_guru); ?>><?= $m->nama_guru ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('guru', '<small class="text-danger">', '</small>'); ?>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Semester</label>
                        <div class="section-title">Terpilih</div>
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="semester" value="1" <?php echo set_radio('semester', '1'); ?> class="selectgroup-input">
                                <span class="selectgroup-button">1 (SATU)</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="semester" value="2" <?php echo set_radio('semester', '2'); ?> class="selectgroup-input">
                                <span class="selectgroup-button">2 (DUA)</span>
                            </label>
                        </div>
                        <?= form_error('semester', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            Submit ⭢
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