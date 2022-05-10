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
                    <h2 class="card-title" style="color: black;">Tambah Semester</h2>
                    <hr>
                    <p class="card-text"> Anda akan menambah Semester baru, mohon untuk diisi secara lengkap.
                    </p>
                    <a href="#detail" class="btn btn-success">Saya paham dan
                        ingin melanjutkan ⭢</a>
                </div>
            </div>
        </div>

        <div id="detail" class="card card-success">
            <div class="col-md-12 text-center">
                <p class="registration-title font-weight-bold display-4 mt-4" style="color:black; font-size: 50px;">
                    Semester Sales University</p>
                <p style="line-height:-30px;margin-top:-20px;">Silahkan isi data data yang diperlukan
                    dibawah </p>
                <hr>
            </div>

            <div class="card-body">
                <form method="POST" action="<?= base_url('admin/insert_semester') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input id="semester" type="number" class="form-control" value="<?php echo set_value('semester') ?>" name="semester">
                        <?= form_error('semester', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Gambar Semester (Tampilan User)</div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <?= form_error('image', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
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