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
                    <h2 class="card-title" style="color: black;">Tambah Materi</h2>
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
                <form method="POST" action="<?= base_url('admin/insert_materi') ?>" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="nama_materi">Nama Materi</label>
                        <input id="nama_materi" type="text" class="form-control" value="<?php echo set_value('nama_materi') ?>" name="nama_materi">
                        <?= form_error('nama_materi', '<small class="text-danger">', '</small>'); ?>
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
                            <label>Course</label>
                            <select class="form-control select2" name="mapel">
                                <option disabled selected>Pilih Course</option>
                                <?php foreach ($mapel as $m) { ?>
                                    <option value="<?= $m->id_mapel ?>" <?php echo set_select('mapel', $m->id_mapel); ?>><?= $m->nama_mapel . ' - ' . $m->nama_guru ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('mapel', '<small class="text-danger">', '</small>'); ?>
                            <div class="invalid-feedback">
                            </div>
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