<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tugas Setting</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/update_opt_tugas') ?>" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="kurang_due_date">Nilai Sebelum Tenggat Waktu</label>
                    <input type="number" required min="1" class="form-control" name="kurang_due_date" id="kurang_due_date" value="<?= $opt_tugas->kurang_due_date ?? '' ?>">
                    <small id="helpId" class="form-text text-muted">Nilai ketika siswa mengumpulkan tugas sebelum waktu yang ditentukan</small>
                </div>
                <div class="form-group">
                    <label for="pas_due_date">Nilai Tepat Tenggat Waktu</label>
                    <input type="number" required min="1" class="form-control" name="pas_due_date" id="pas_due_date" value="<?= $opt_tugas->pas_due_date ?? '' ?>">
                    <small id="helpId" class="form-text text-muted">Nilai ketika siswa mengumpulkan tugas tepat waktu yang ditentukan</small>
                </div>
                <div class="form-group">
                    <label for="lebih_due_date">Nilai lebih dari Tenggat Waktu</label>
                    <input type="number" required min="1" class="form-control" name="lebih_due_date" id="lebih_due_date" value="<?= $opt_tugas->lebih_due_date ?? '' ?>">
                    <small id="helpId" class="form-text text-muted">Nilai ketika siswa mengumpulkan tugas lebih dari waktu yang ditentukan</small>
                </div>
                <!-- <div class="form-group">
                    <label for="max_post_test">Maksimal Kesempatan Post Test</label>
                    <input type="text" class="form-control" name="max_post_test" id="max_post_test" value="<?= $quiz->max_post_test ?? '' ?>">
                </div> -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block">
                        Simpan ⭢
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Main Content -->


<!-- Start Sweetalert -->
<?php if ($this->session->flashdata('success-opt-tugas')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?= $this->session->flashdata('success-opt-tugas') ?>',
            text: 'Selamat data berubah!',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>

<?php
$this->load->view('admin/template_admin/footer');
?>