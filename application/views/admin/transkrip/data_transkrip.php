<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Transkrip <?= $nama_siswa->nama ?></h2>
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
                        <table id="transkrip" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th>Semester</th>
                                    <th>Kode Course</th>
                                    <th>Course</th>
                                    <th>Nilai</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php foreach ($transkrip as $t) { ?>
                                    <tr>
                                        <td scope="row"><?= $t->id_semester ?></td>
                                        <td><?= $t->kode_mapel ?></td>
                                        <td><?= $t->nama_mapel ?></td>
                                        <td><?= $t->nilai_final ?></td>
                                        <?php foreach ($mutu as $mu) { ?>
                                            <?php
                                            $pisah = explode("-", $mu->nilai);
                                            ?>
                                            <?php if ($t->nilai_final >= $pisah[0] && $t->nilai_final <= $pisah[1]) { ?>
                                                <td><b style="color: black;"><?= $mu->mutu ?></b></td>
                                            <?php
                                                break;
                                            } ?>
                                        <?php } ?>
                                    </tr>
                                <?php  } ?>
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
        $('#transkrip').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    title: 'Transkrip <?= $nama_siswa->nama ?>'
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Transkrip <?= $nama_siswa->nama ?>'
                }
            ]
        });
    });
</script>

<?php
$this->load->view('admin/template_admin/footer');
?>