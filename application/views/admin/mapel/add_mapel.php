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
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control select2" name="zoom" id="zoom">
                                <option disabled selected>Pilih Type</option>
                                <option value="0">Course</option>
                                <option value="1">Live Class</option>
                            </select>
                            <?= form_error('type', '<small class="text-danger">', '</small>'); ?>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-group tgl" style="display:none ;">
                        <label>Tanggal Mulai</label>
                        <input type="datetime-local" class="form-control" name="tgl_mulai">
                        <?= form_error('tgl_mulai', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group tgl" style="display:none ;">
                        <label>Tanggal Selesai</label>
                        <input type="datetime-local" class="form-control" name="tgl_selesai">
                        <?= form_error('tgl_selesai', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="form-group tgl" style="display:none ;">
                        <label for="link">Link Zoom</label>
                        <input id="link" type="text" class="form-control" value="<?php echo set_value('link') ?>" name="link">
                        <?= form_error('link', '<small class="text-danger">', '</small>'); ?>
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
                        <select class="form-control select2" name="semester">
                            <option disabled selected>Pilih Semester</option>
                            <?php foreach ($semester as $m) { ?>
                                <option value="<?= $m->id_semester ?>" <?php echo set_select('semester', $m->id_semester); ?>><?= $m->semester ?></option>
                            <?php } ?>
                        </select>
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

<script>
    $(document).ready(function() {
        $('#zoom').on('change', function() {
            if (this.value == 1) {
                $(".tgl").show();
            } else {
                $(".tgl").hide();
            }
        });
    });
</script>
<?php
$this->load->view('admin/template_admin/footer');
?>