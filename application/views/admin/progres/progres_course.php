<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Progress <?= $nama_siswa->nama ?></h2>
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
                        <table id="progress" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Course</th>
                                    <th scope="col">Progress</th>
                                    <!-- <th scope="col">Akun Aktif *</th> -->
                                    <th scope="col">Detail</th>
                                    <!-- <th scope="col">Option</th> -->
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($progres as $u) {
                                ?>
                                    <tr class="text-center">
                                        <th scope="row">
                                            <?= $no++ ?>
                                        </th>
                                        <td>
                                            <b><?php echo $u->nama_mapel ?></b>
                                        </td>
                                        <td>
                                            <?php
                                            $pro = ((int)$u->done * 100) / (int)$u->jumlah;

                                            ?>
                                            <div class="progress">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $pro ?>%;" aria-valuenow="<?= $pro ?>%" aria-valuemin="0" aria-valuemax="100"> <?= $pro ?>%</div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="<?php echo site_url('admin/progres_siswa/' . $u->id_user . '/' . $u->slug_mapel); ?>" class="btn btn-primary">Detail ⭢</a>
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
<script>
    $(document).ready(function() {
        $('#progress').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    title: 'Progress <?= $nama_siswa->nama ?>',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Progress <?= $nama_siswa->nama ?>'
                },
                // 'colvis'
            ]
        });
    });
</script>

<?php
$this->load->view('admin/template_admin/footer');
?>