<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Soal Quiz</h2>
                <a href="<?= base_url('admin/isi_materi/' . $materi->id_materi) ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali </a>
                <hr>
                <button type="button" class="btn btn-outline-success mt-5" data-toggle="modal" data-target="#soal">Tambah Soal ⭢</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                    <div class="table-responsive">
                        <table id="example" class="table align-items-center table-flush mt-5">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Soal</th>
                                    <th scope="col">Tanggal dibuat</th>
                                    <th scope="col">Detail</th>
                                    <th scope="col">Option</th>
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
                                            <?php echo $u->soal ?>
                                        </td>
                                        <td>
                                            <?php echo $u->created_at ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('admin/detail_soal/' . $u->id_soal); ?>" class="btn btn-success">Detail ⭢</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('admin/edit_soal/' . $u->id_soal); ?>" class="btn btn-info">Edit ⭢</a>
                                            <a onclick="deletesoal(<?= $u->id_soal ?>,<?= $u->id_quiz ?>);" href="javascript:void(0);" class="btn btn-danger">Delete ✖</a>
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
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="soal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/tambah_soal') ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="modal" value="quiz">
                    <input type="hidden" name="tab" value="contact3">
                    <input type="hidden" name="nav-link" value="contact-tab3">
                    <input type="hidden" name="id_quiz" value="<?= $this->uri->segment(3); ?>" required>
                    <div class="form-group">
                        <label for="soal">Soal</label>
                        <textarea name="soal" id="soal" class="form-control" cols="30" rows="10" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="opsi_a">Opsi A</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">A</div>
                            </div>
                            <input type="text" name="opsi_a" class="form-control" id="opsi_a" placeholder="Input Opsi B" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="opsi_b">Opsi B</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">B</div>
                            </div>
                            <input type="text" name="opsi_b" class="form-control" id="opsi_b" placeholder="Input Opsi B" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="opsi_c">Opsi C</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">C</div>
                            </div>
                            <input type="text" name="opsi_c" class="form-control" id="opsi_c" placeholder="Input Opsi C" require>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="opsi_d">Opsi D</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">D</div>
                            </div>
                            <input type="text" name="opsi_d" class="form-control" id="opsi_d" placeholder="Input Opsi D" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jawaban">Jawaban</label>
                        <select name="jawaban" class="form-control" id="jawaban" required>
                            <option value="a">Opsi A</option>
                            <option value="b">Opsi B</option>
                            <option value="c">Opsi C</option>
                            <option value="d">Opsi D</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            Submit ⭢
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Start Sweetalert -->
<?php if ($this->session->flashdata('success')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Soal Berhasil Ditambah!',
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
            title: 'Soal Telah Dirubah!',
            text: 'Selamat data berubah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('success-delete')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Soal Telah Dihapus!',
            text: 'Selamat data telah Dihapus!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<!-- End Sweetalert -->

<script type="text/javascript">
    function deletesoal(id, quiz) {
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
                window.location = "<?= base_url('admin/delete_soal/') ?>" + id + '/' + quiz;
            }
        })
    }
</script>

<?php
$this->load->view('admin/template_admin/footer');
?>