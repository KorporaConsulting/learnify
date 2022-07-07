<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Soal</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/update_soal/' . $soal->id_soal) ?>" enctype="multipart/form-data" method="post">
                <input type="hidden" name="oldFile" value="<?= $soal->file ?? '' ?>">
                <input type="hidden" name="id_materi" value="<?= $soal->id_materi ?? '' ?>">
                <div class="form-group">
                    <label for="soal">Soal</label>
                    <textarea name="soal" id="soal" class="form-control" cols="30" rows="10" required><?= $soal->soal ?></textarea>
                </div>

                <div class="form-group">
                    <label class="sr-only" for="opsi_a">Opsi A</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">A</div>
                        </div>
                        <input type="text" name="opsi_a" class="form-control" id="opsi_a" value="<?= $soal->opsi_a ?>" placeholder="Input Opsi A" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="sr-only" for="opsi_b">Opsi B</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">B</div>
                        </div>
                        <input type="text" name="opsi_b" class="form-control" id="opsi_b" value="<?= $soal->opsi_b ?>" placeholder="Input Opsi B" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="sr-only" for="opsi_c">Opsi C</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">C</div>
                        </div>
                        <input type="text" name="opsi_c" class="form-control" id="opsi_c" value="<?= $soal->opsi_c ?>" placeholder="Input Opsi C" require>
                    </div>
                </div>
                <div class="form-group">
                    <label class="sr-only" for="opsi_d">Opsi D</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">D</div>
                        </div>
                        <input type="text" name="opsi_d" class="form-control" id="opsi_d" value="<?= $soal->opsi_d ?>" placeholder="Input Opsi D" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jawaban">Jawaban</label>
                    <select name="jawaban" class="form-control" id="jawaban" required>
                        <option value="a" <?= $soal->jawaban == 'a' ? 'selected' : '' ?>>Opsi A</option>
                        <option value="b" <?= $soal->jawaban == 'b' ? 'selected' : '' ?>>Opsi B</option>
                        <option value="c" <?= $soal->jawaban == 'c' ? 'selected' : '' ?>>Opsi C</option>
                        <option value="d" <?= $soal->jawaban == 'd' ? 'selected' : '' ?>>Opsi D</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block">
                        Submit ⭢
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Main Content -->


<!-- Start Sweetalert -->
<?php if ($this->session->flashdata('success-video')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Video Berhasil Ditambah!',
            text: 'Selamat data bertambah!',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('success-file')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data File Berhasil Ditambah!',
            text: 'Selamat data bertambah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('gagal-reg')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Data Materi gagal Ditambah!',
            text: 'Silahkan coba kembali!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('success-video-edit')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Video Telah Dirubah!',
            text: 'Selamat data berubah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('success-file-edit')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data File Telah Dirubah!',
            text: 'Selamat data berubah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('video-delete')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Video Telah Dihapus!',
            text: 'Selamat data telah Dihapus!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('file-delete')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data File Telah Dihapus!',
            text: 'Selamat data telah Dihapus!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>



<!-- End Sweetalert -->

<script type="text/javascript">
    function video_delete(id, id_materi) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            console.log(result)
            if (result.value) {
                window.location = "<?= base_url('admin/delete_video/') ?>" + id + "/" + id_materi;
            }
        })
    }
</script>
<script type="text/javascript">
    function file_delete(id, id_materi) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            console.log(result)
            if (result.value) {
                window.location = "<?= base_url('admin/delete_file/') ?>" + id + "/" + id_materi;
            }
        })
    }
</script>
<script type="text/javascript">
    function deletesoal(id, id_materi) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            console.log(result)
            if (result.value) {
                window.location = "<?= base_url('admin/delete_soal/') ?>" + id + "/" + id_materi;
            }
        })
    }
</script>
<?php
$this->load->view('admin/template_admin/footer');
?>