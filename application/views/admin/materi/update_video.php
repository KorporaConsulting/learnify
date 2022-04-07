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
                    <h2 class="card-title" style="color: black;">Update Video</h2>
                    <hr>
                </div>
            </div>
            <?php if ($this->session->flashdata('error-update')) : ?>
                <div class="alert alert-danger alert-has-icon">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <div class="alert-title">Gagal!</div>
                        Urutan telah digunakan
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($video->video != null) { ?>
            <div class="card-body">
                <form action="<?= base_url('admin/video_edit') ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id_materi" value="<?= $video->id_materi ?>">
                    <input type="hidden" name="id_video" value="<?= $video->id_video ?>">
                    <div class="form-group">
                        <label for="video">Upload Video (Kosongkan jika tidak mengubah video)</label>
                        <div class="custom-file">
                            <input type="file" accept="video/mp4,video/mkv,video/mov" class="custom-file-input" id="customFile" name="video">
                            <label class="custom-file-label" for="customFile">Pilih Video</label>
                        </div>
                        <?= form_error('video', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_video">Judul Video</label>
                        <input required id="nama_video" type="text" class="form-control" value="<?= $video->nama_video ?>" name="nama_video">
                        <?= form_error('nama_video', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi (Optional)</label>
                        <textarea class="form-control" name="desk_video" id="desk_video" cols="30" rows="10"><?= $video->desk_video ?></textarea>
                        <?= form_error('desk_video', '<small class="text-danger">', '</small>'); ?>
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
        <?php } else { ?>
            <div class="card-body">
                <form action="<?= base_url('admin/video_edit') ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id_materi" value="<?= $video->id_materi ?>">
                    <input type="hidden" name="id_video" value="<?= $video->id_video ?>">
                    <div class="form-group">
                        <label for="link">Youtube ID Video</label>
                        <input required id="link" type="text" class="form-control" value="<?= $video->link ?>" name="link">
                        <?= form_error('link', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_video">Judul Video</label>
                        <input required id="nama_video" type="text" class="form-control" value="<?= $video->nama_video ?>" name="nama_video">
                        <?= form_error('nama_video', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi (Optional)</label>
                        <textarea class="form-control" name="desk_video" id="desk_video" cols="30" rows="10"><?= $video->desk_video ?></textarea>
                        <?= form_error('desk_video', '<small class="text-danger">', '</small>'); ?>
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
        <?php } ?>
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