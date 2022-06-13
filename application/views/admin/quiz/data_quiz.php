<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Test Attemp</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                    <div class="table-responsive">
                        <table id="example" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Nama Course</th>
                                    <th scope="col">Nama Test</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($quiz as $u) {
                                ?>
                                    <tr class="text-center">
                                        <th scope="row">
                                            <?php echo $no++ ?>
                                        </th>
                                        <td>
                                            <?php echo $u->nama ?>
                                        </td>
                                        <td>
                                            <?php echo $u->nama_mapel ?>
                                        </td>
                                        <td>
                                            <?php echo $u->nama_materi ?>
                                        </td>
                                        <td>
                                            <?php echo $u->nilai ?>
                                        </td>
                                        <?php
                                        if ($u->nilai < 70) { ?>
                                            <td><span class="badge badge-danger badge-lg">Tidak Lulus</span></td>
                                        <?php } else { ?>
                                            <td><span class="badge badge-success badge-lg">Lulus</span></td>
                                        <?php }
                                        ?>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('admin/histori_quiz/' . $u->id_materi . '/' . $u->id_user . '/' . $u->id_mapel); ?>" class="btn btn-success">Detail History ⭢</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</div>
<!-- End Main Content -->

<!-- Start Sweetalert -->
<?php if ($this->session->flashdata('success-reg')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Siswa Berhasil Ditambah!',
            text: 'Selamat data bertambah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('success-edit')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Siswa Telah Dirubah!',
            text: 'Selamat data berubah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('user-delete')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Siswa Telah Dihapus!',
            text: 'Selamat data telah Dihapus!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<!-- End Sweetalert -->

<script type="text/javascript">
    function yourConfirm(id) {
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
                window.location = "<?= base_url('admin/delete_siswa/') ?>" + id;
            }
        })
    }
</script>

<?php
$this->load->view('admin/template_admin/footer');
?>