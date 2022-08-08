<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Absensi <?= $nama_siswa->nama ?></h2>
                <hr>
                <!-- <p class="card-text"> After I ran into Helen at a restaurant, I realized she was just office pretty drop-dead date put in in a deck for our standup today. Who's responsible for the ask for this request? who's responsible for the ask for this request? but moving the goalposts gain traction. </p> -->
                <!-- <a href="<?= base_url('admin/add_siswa') ?>" class="btn btn-success">Tambah
                    Data Siswa ⭢ </a> -->
                <a href="<?= base_url('admin/progres_data_siswa') ?>" class="btn btn-info">Kembali </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                    <div class="table-responsive">
                        <table id="absensi" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Course</th>
                                    <th>Waktu Absensi</th>
                                    <th>Waktu Kelas Live</th>
                                    <th>Persentase ketepatan waktu</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($absensi as $t) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $t->nama_mapel ?></td>
                                        <td><?= $t->waktu_masuk ?></td>
                                        <td><?= $t->tgl_mulai ?></td>
                                        <td><?= $t->ketepatan_absensi ?>%</td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total persentase ketepatan waktu</td>
                                    <?php
                                    if ($total_absen <= 0) $total_absen = 1;
                                    $total = $akurasi->akurasi / $total_absen;
                                    ?>
                                    <td><b style="color:black"><?= $total ?>%</b></td>
                                </tr>
                            </tfoot>
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
        $('#absensi').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    title: 'Absensi <?= $nama_siswa->nama ?>',
                    footer: true
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Absensi <?= $nama_siswa->nama ?>',
                    footer: true
                },
                // 'colvis'
            ]
        });
    });
</script>

<?php
$this->load->view('admin/template_admin/footer');
?>