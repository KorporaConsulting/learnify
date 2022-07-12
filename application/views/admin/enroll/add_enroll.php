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
                    Tambah Enroll User</p>
                <p style="line-height:-30px;margin-top:-20px;">Silahkan isi data data yang diperlukan
                    dibawah </p>
                <hr>
            </div>

            <div class="card-body">
                <form method="POST" action="<?= base_url('admin/insert_enroll') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="form-label">Semester</label>
                        <select class="form-control select2" name="semester">
                            <option disabled selected>Pilih Semester</option>
                            <?php foreach ($semester as $m) { ?>
                                <option value="<?= $m->id_semester ?>" <?php echo set_select('semester', $m->id_semester); ?>><?= $m->semester ?></option>
                            <?php } ?>
                        </select>
                        <?= form_error('semester', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label>User</label>
                            <select class="form-control select2" name="user">
                                <option disabled selected>Pilih User</option>
                                <?php foreach ($user as $u) { ?>
                                    <option value="<?= $u->id_user ?>" <?php echo set_select('user', $u->id_user); ?>><?= $u->nama ?> (<?= $u->email ?>)</option>
                                <?php } ?>
                            </select>
                            <?= form_error('user', '<small class="text-danger">', '</small>'); ?>
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
<?php if ($this->session->flashdata('valid_enroll')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Data telah tersedia',
            text: 'Silahkan coba lagi!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('error-enroll')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Tidak Ada Course pada Semester tersebut',
            text: 'Silahkan coba lagi!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php
$this->load->view('admin/template_admin/footer');
?>