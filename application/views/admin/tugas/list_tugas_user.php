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
                                            <?php if ($u->approve == 0) { ?>
                                                <span class="badge badge-warning">Menunggu Disetujui</span>
                                            <?php } elseif ($u->approve == 1) { ?>
                                                <span class="badge badge-info">Approve</span>
                                            <?php } elseif ($u->approve == 2) { ?>
                                                <span class="badge badge-success">Diperiksa Kembali</span>
                                            <?php } elseif ($u->approve == 3) { ?>
                                                <span class="badge badge-danger">Ditolak</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a target="_blank" class="btn btn-primary" href="<?= $u->link ?>" role="button">File</a>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-nama_tugas="<?php echo $u->nama_tugas ?>" data-id_file="<?= $u->id_file ?>" data-id_materi="<?= $u->id_materi ?>" data-id_user="<?= $u->id_user ?>">Tindak Lanjuti</button>
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url("admin/approve_tugas") ?>">
                <div class="modal-body">
                    <input type="hidden" name="id_materi" id="id_materi">
                    <input type="hidden" name="id_user" id="id_user">
                    <input type="hidden" name="id_file" id="id_file">
                    <div class="form-group">
                        <label for="">Status</label>
                        <select required class="form-control" name="status" id="status">
                            <option disabled selected value="">Pilih Status Tugas</option>
                            <option value="1">Approve</option>
                            <option value="2">Periksa Kembali</option>
                            <option value="3">Tolak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <input required min="0" max="100" type="number" class="form-control" name="nilai" id="nilai">
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Feedback</label>
                        <textarea required name="feedback" id="feedback" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var id_materi = button.data('id_materi') // Extract info from data-* attributes
        var id_user = button.data('id_user') // Extract info from data-* attributes
        var id_file = button.data('id_file') // Extract info from data-* attributes
        var nama_tugas = button.data('nama_tugas') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Penilaian ' + nama_tugas)
        modal.find('#id_file').val(id_file)
        modal.find('#id_user').val(id_user)
        modal.find('#id_materi').val(id_materi)
    })
</script>

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