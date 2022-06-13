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
                    <h2 class="card-title" style="color: black;">Update data siswa</h2>
                    <hr>
                    <a href="#detail" class="btn btn-success">Saya paham dan
                        ingin melanjutkan ⭢</a>
                </div>
            </div>
        </div>
        <form action="<?= base_url('admin/semester_edit') ?>" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id_semester" value="<?= $semester->id_semester ?>">
            <input type="hidden" name="image" value="<?= $semester->image_semester ?>">
            <div class="">
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input id="semester" type="number" class="form-control" value="<?php echo $semester->semester ?>" name="semester">
                    <?= form_error('semester', '<small class="text-danger">', '</small>'); ?>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <div class="section-title">Gambar Semester</div>
                    <p>Biarkan jika tidak mengubah gambar</p>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="customFile">
                        <label class="custom-file-label" for="customFile">Ganti Gambar</label>
                    </div>
                    <?= form_error('image', '<small class="text-danger">', '</small>'); ?>
                    <div class="invalid-feedback">
                    </div>
                </div>


                <input type="submit" value="Update ⭢" class="btn btn-success btn-block">
            </div>
        </form>
    </section>
</div>
</div>
</div>
<!-- End Main Content -->

<?php
$this->load->view('admin/template_admin/footer');
?>