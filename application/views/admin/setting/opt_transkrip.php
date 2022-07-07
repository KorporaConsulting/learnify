<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Transkrip Setting</h3>
        </div>
        <div class="card-body">
            <h4>Mutu</h4>
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Grade</th>
                        <th>Nilai</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $no = 1;
                    foreach ($opt_transkrip as $t) { ?>
                        <tr>
                            <td scope="row"><?= $no++ ?></td>
                            <td><b><?= $t->mutu ?></b></td>
                            <td><?= $t->nilai ?></td>
                            <td>
                                <a href="<?php echo site_url('admin/edit_transkrip/' . $t->id_mutu); ?>" class="btn btn-info">Edit ⭢</a>
                            </td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End Main Content -->


<!-- Start Sweetalert -->
<?php if ($this->session->flashdata('success-opt-transkrip')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?= $this->session->flashdata('success-opt-transkrip') ?>',
            text: 'Selamat data berubah!',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>

<?php
$this->load->view('admin/template_admin/footer');
?>