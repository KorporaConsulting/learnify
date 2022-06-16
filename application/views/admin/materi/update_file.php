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
                    <h2 class="card-title" style="color: black;">Edit File</h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/file_edit') ?>" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id_file" value="<?= $file->id_file ?>">
                <input type="hidden" name="id_materi" value="<?= $file->id_materi ?>">
                <div class="form-group">
                    <label for="nama_file">Judul Modul/File</label>
                    <input required id="nama_file" type="text" class="form-control" value="<?= $file->nama_file ?>" name="nama_file">
                    <?= form_error('nama_file', '<small class="text-danger">', '</small>'); ?>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi (Optional)</label>
                    <textarea class="form-control" name="desk_file" id="desk_file" cols="30" rows="10"><?= $file->desk_file ?></textarea>
                    <?= form_error('desk_file', '<small class="text-danger">', '</small>'); ?>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label for="link">Link Modul/File</label>
                    <input required id="link" type="text" class="form-control" value="<?= $file->link ?>" name="link">
                    <?= form_error('link', '<small class="text-danger">', '</small>'); ?>
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