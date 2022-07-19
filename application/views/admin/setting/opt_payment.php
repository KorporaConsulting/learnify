<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#addSetting">
                        Tambah Opsi
                    </button>
                </div>
                <div>
                    <?php if ($setting[0]->is_development == 0) : ?>
                        <span class="badge badge-primary">Development</span>
                    <?php else : ?>
                        <span class="badge badge-primary">Production</span>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Button trigger modal -->

            <table class="table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Merchant Code</th>
                        <th>Merchant Key</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($setting as $key => $val) : ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $val->merchant_code ?></td>
                            <td><?= $val->merchant_key ?></td>
                            <td><?= $val->is_active == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' ?></td>
                            <td>
                                <a href="<?= site_url('admin/payment_active/' . $val->id) ?>" class="btn btn-primary">Aktifkan</a>
                                <button class="btn btn-danger" onclick="confirmDelete('<?= $val->id ?>')">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End Main Content -->


<!-- Modal -->
<div class="modal fade" id="addSetting" tabindex="-1" aria-labelledby="addSettingLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= site_url('admin/add_payment_setting') ?>" method="post" id="form_add_opt">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Opsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="merchant_code">Merchant Code</label>
                        <input type="text" name="merchant_code" id="merchant_code" placeholder="Merchant Code" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="merchant_key">Merchant Key</label>
                        <input type="text" name="merchant_key" id="merchant_key" placeholder="Merchant Key" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $('#form_add_opt').submit(function() {
        event.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(res) {
                if (res.success) {
                    location.reload();
                }
            },
            error: function(err) {

            }
        })
    })

    function confirmDelete(id) {

        Swal.fire({
            title: 'Apa anda yakin?',
            text: "Anda akan menghapus opsi ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = '<?= site_url("admin/delete_opt_payment") ?>/' + id
            }
        })
    }
</script>

<?php
$this->load->view('admin/template_admin/footer');
?>