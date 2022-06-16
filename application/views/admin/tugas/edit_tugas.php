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
                    <h2 class="card-title" style="color: black;">Edit Tugas</h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="card" style="width:100%;">
            <div class="card-body">
                <form action="<?= base_url('admin/update_tugas') ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id_tugas" value="<?= $tugas->id_tugas ?>">
                    <input type="hidden" name="id_materi" value="<?= $tugas->id_materi ?>">
                    <div class="form-group">
                        <label for="nama_tugas">Nama Tugas</label>
                        <input required id="nama_tugas" type="text" class="form-control" value="<?= $tugas->nama_tugas ?>" name="nama_tugas">
                        <?= form_error('nama_tugas', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="desk_tugas" id="desk_tugas" cols="30" rows="10"><?= $tugas->desk_tugas ?></textarea>
                        <?= form_error('desk_tugas', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due date</label>
                        <input required id="due_date" type="date" class="form-control" value="<?= $tugas->due_date ?>" name="due_date">
                        <?= form_error('due_date', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            Update ⭢
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