<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Quiz</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/update_quiz/' . $quiz->id_quiz) ?>" enctype="multipart/form-data" method="post">
                <!-- <input type="hidden" name="oldFile" value="<?= $quiz->file ?? '' ?>"> -->
                <input type="hidden" name="id_quiz" value="<?= $quiz->id_quiz ?? '' ?>">
                <input type="hidden" name="id_materi" value="<?= $quiz->id_materi ?>" required>
                <div class="form-group">
                    <label for="judul">Judul Quiz</label>
                    <input type="text" class="form-control" name="judul" id="judul" value="<?= $quiz->judul ?? '' ?>">
                </div>
                <div class="form-group">

                    <div class="form-group">
                        <label for="type">Type Quiz</label>
                        <select required class="form-control" name="type" id="type">
                            <option value="" <?= ($quiz->type == "") ? "selected" : "" ?>>Pilih Type Quiz</option>
                            <option value="0" <?= ($quiz->type == "0") ? "selected" : "" ?>>Test Quiz</option>
                            <option value="1" <?= ($quiz->type == "1") ? "selected" : "" ?>>Final Quiz</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="min_nilai">Minimum Nilai Quiz</label>
                    <input type="text" class="form-control" name="min_nilai" id="min_nilai" value="<?= $quiz->min_nilai ?? '' ?>">
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