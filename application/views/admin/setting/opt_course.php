<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Course Setting</h3>
        </div>
        <div class="row">
            <div class="card-body">
                <form action="<?= base_url('admin/update_opt_course') ?>" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="post_test">Persentase Post Test</label>
                        <input type="number" required min="1" class="form-control" name="post_test" id="post_test" value="<?= $opt_course->post_test ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="test_quiz">Persentase Test Quiz</label>
                        <input type="number" required min="1" class="form-control" name="test_quiz" id="test_quiz" value="<?= $opt_course->test_quiz ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="tugas">Persentase Tugas</label>
                        <input type="number" required min="1" class="form-control" name="tugas" id="tugas" value="<?= $opt_course->tugas ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="absensi">Persentase absen</label>
                        <input type="number" required min="1" class="form-control" name="absensi" id="absensi" value="<?= $opt_course->absensi ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            Simpan ⭢
                        </button>
                    </div>
                </form>

                <h4 class="mt-5">Tanpa Tugas</h4>
                <form action="<?= base_url('admin/update_opt_course') ?>" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="post_test">Persentase Post Test</label>
                        <input type="number" required min="1" class="form-control" name="post_test" id="post_test" value="<?= $opt_course_tugas->post_test ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="test_quiz">Persentase Test Quiz</label>
                        <input type="number" required min="1" class="form-control" name="test_quiz" id="test_quiz" value="<?= $opt_course_tugas->test_quiz ?? '' ?>">
                    </div>
                    <input type="hidden" required min="1" class="form-control" name="tugas" id="tugas" value="<?= $opt_course_tugas->tugas ?? '' ?>">
                    <div class="form-group">
                        <label for="absensi">Persentase absen</label>
                        <input type="number" required min="1" class="form-control" name="absensi" id="absensi" value="<?= $opt_course_tugas->absensi ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            Simpan ⭢
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Main Content -->


<!-- Start Sweetalert -->
<?php if ($this->session->flashdata('success-opt-course')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?= $this->session->flashdata('success-opt-course') ?>',
            text: 'Selamat data berubah!',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('error-opt-course')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: '<?= $this->session->flashdata('error-opt-course') ?>',
            text: 'Pastikan total adalah 100!',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>

<?php
$this->load->view('admin/template_admin/footer');
?>