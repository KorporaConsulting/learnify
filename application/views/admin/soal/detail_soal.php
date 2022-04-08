<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Detail Soal</h3></div>
        <div class="card-body">
            <div class="mb-4" id="soal">
                <h5>Soal</h5>
                <?= $soal->soal ?>
            </div>
            <div class="mb-4" id="opsi">
                <h5>Opsi</h5>
                A. <?= $soal->opsi_a ?>
                B. <?= $soal->opsi_b ?>
                C. <?= $soal->opsi_c ?>
                D. <?= $soal->opsi_d ?>
            </div>
            <div class="mb-4" id="jawaban">
                <h5>Jawaban <?= $soal->jawaban ?></h5>
                
            </div>
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