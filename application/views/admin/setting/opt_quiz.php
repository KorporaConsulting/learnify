<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Quiz Setting</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/update_opt_quiz') ?>" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="max_post_test">Maksimal Kesempatan Post Test</label>
                    <input type="number" required min="1" class="form-control" name="max_post_test" id="max_post_test" value="<?= $opt_quiz->max_post_test ?? '' ?>">
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
<?php if ($this->session->flashdata('success-opt-quiz')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?= $this->session->flashdata('success-opt-quiz') ?>',
            text: 'Selamat data berubah!',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>

<?php
$this->load->view('admin/template_admin/footer');
?>