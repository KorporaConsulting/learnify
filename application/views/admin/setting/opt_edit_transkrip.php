<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Bobot Nilai <?= $opt_edit_transkrip->mutu ?></h3>
            <?php $pisah = explode("-", $opt_edit_transkrip->nilai); ?>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/update_opt_transkrip') ?>" enctype="multipart/form-data" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_menu">Nilai Minimal</label>
                            <input type="hidden" required min="1" class="form-control" name="id_mutu" id="id_mutu" value="<?= $opt_edit_transkrip->id_mutu ?? '' ?>">
                            <input type="number" required min="1" class="form-control" name="min" id="min" value="<?= $pisah[0] ?? '' ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="max">Nilai Maksimal</label>
                            <input type="number" required min="1" class="form-control" name="max" id="max" value="<?= $pisah[1] ?? '' ?>">
                        </div>
                    </div>
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