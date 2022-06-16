<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">List Tugas User</h2>
                <hr>
                <!-- <p class="card-text"> After I ran into Helen at a restaurant, I realized she was just office pretty drop-dead date put in in a deck for our standup today. Who's responsible for the ask for this request? who's responsible for the ask for this request? but moving the goalposts gain traction. </p> -->
                <!-- <a href="<?= base_url('admin/add_siswa') ?>" class="btn btn-success">Tambah
                    Data Siswa ⭢ </a> -->
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
                                    <th scope="col">Nama User</th>
                                    <th scope="col">Nama Course</th>
                                    <th scope="col">Nama Materi</th>
                                    <th scope="col">Nama Tugas</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($tugas_list as $u) {
                                ?>
                                    <tr class="text-center">

                                        <th scope="row">
                                            <?= $no++ ?>
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
                                            <?php echo $u->nama_tugas ?>
                                        </td>
                                        <td>
                                            <?php if ($u->approve == 1) { ?>
                                                <span class="badge badge-info">Disetujui</span>
                                            <?php } else { ?>
                                                <span class="badge badge-warning">Menunggu Disetujui</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a target="_blank" class="btn btn-primary" href="<?= $u->link ?>" role="button">File</a>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($u->approve == 1) { ?>
                                                <a onclick="tolak('<?php echo site_url('admin/delete_approve_tugas/' . $u->id_file . '/' . $u->id_materi . '/' . $u->id_user) ?>')" href="#" class="btn btn-danger">Delete Approve ⭢</a>
                                            <?php } else { ?>
                                                <a onclick="terima('<?php echo site_url('admin/approve_tugas/' . $u->id_file . '/' . $u->id_materi . '/' . $u->id_user) ?>')" href="#" class="btn btn-info">Approve ⭢</a>
                                            <?php } ?>
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
<?php if ($this->session->flashdata('success-approve')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= $this->session->flashdata('success-approve') ?>',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('error-approve')) : ?>
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


<!-- End Sweetalert -->

<script type="text/javascript">
    function tolak(link) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Menghapus approve untuk tugas ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, hapus!'
        }).then((result) => {
            console.log(result)
            if (result.value) {
                window.location = link;
            }
        })
    }
</script>
<script type="text/javascript">
    function terima(link) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Menyetujui tugas ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, setuju!'
        }).then((result) => {
            console.log(result)
            if (result.value) {
                window.location = link;
            }
        })
    }
</script>

<?php
$this->load->view('admin/template_admin/footer');
?>