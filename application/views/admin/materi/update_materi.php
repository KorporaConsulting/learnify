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
                    <h2 class="card-title" style="color: black;">Update Materi</h2>
                    <hr>
                </div>
            </div>
        </div>
        <form action="<?= base_url('admin/edit_materi') ?>" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id_materi" value="<?= $user->id_materi ?>">
            <div id="detail" class="col-md-12 bg-white p-3" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                <h1 class="font-weight-bold card-title text-center" style="color: black;">Update Data
                    Courses
                </h1>
                <p class="text-center" style="line-height: 5px;">Silahkan isi data dibawah untuk update
                    data, dan upload file diatas untuk update data profile picture</p>
                <hr>

                <div class="form-group">
                    <label for="nama_materi">Nama Materi</label>
                    <input id="nama_materi" type="text" class="form-control" value="<?php echo $user->nama_materi ?>" name="nama_materi">
                    <?= form_error('nama_materi', '<small class="text-danger">', '</small>'); ?>
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="desk_materi" id="desk_materi" cols="30" rows="10"><?php echo $user->desk_materi ?></textarea>
                    <?= form_error('desk_materi', '<small class="text-danger">', '</small>'); ?>
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label>Pilih Course</label>
                        <select class="form-control select2" name="mapel">
                            <option disabled selected>Pilih Course</option>
                            <?php foreach ($mapel as $m) { ?>
                                <option <?php if ($m->id_mapel == $user->id_mapel) {
                                            echo 'selected="selected"';
                                        } ?> value="<?php echo $m->id_mapel ?>"><?= $m->nama ?></option>
                            <?php } ?>
                        </select>
                        <?= form_error('mapel', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
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
<?php if ($this->session->flashdata('gagal-reg')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Data Course gagal diupdate!',
            text: 'Silahkan coba lagi',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php
$this->load->view('admin/template_admin/footer');
?>