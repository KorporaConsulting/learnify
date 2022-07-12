<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Management Course</h2>
                <hr>
                <!-- <p class="card-text"> After I ran into Helen at a restaurant, I realized she was just office pretty drop-dead date put in in a deck for our standup today. Who's responsible for the ask for this request? who's responsible for the ask for this request? but moving the goalposts gain traction. </p> -->
                <!-- <a href="<?= base_url('admin/data_mapel') ?>" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali </a> -->
                <a href="<?= base_url('admin/add_mapel') ?>" class="btn btn-success">Tambah
                    Data Course</a>
                <!-- <a href="<?= base_url('admin/data_sort_semester') ?>" class="btn btn-primary">
                    Sort Course</a> -->
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12">
                <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                    <h4>Course</h4>
                    <div class="table-responsive">
                        <table id="example" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Course</th>
                                    <th scope="col">Nama Mentor</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Materi</th>
                                    <th scope="col">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($user as $u) {
                                ?>
                                    <tr class="text-center">

                                        <th scope="row">
                                            <?php echo $no++ ?>
                                        </th>

                                        <td>
                                            <?php echo $u->nama_mapel ?>
                                        </td>
                                        <td>
                                            <?php echo $u->nama_guru ?>
                                        </td>
                                        <td>
                                            <?php echo $u->semester ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('admin/data_materi_course/' . $u->id_mapel); ?>" class="btn btn-success">Materi ⭢</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('admin/update_mapel/' . $u->id_mapel); ?>" class="btn btn-info">Edit ⭢</a>

                                            <a onclick="yourConfirm(<?= $u->id_mapel ?>,<?= $u->id_semester ?>);" href="javascript:void(0);" class="btn btn-danger">Delete ✖</a>
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
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                    <h4>Live Kelas</h4>
                    <div class="table-responsive">
                        <table id="example" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Course</th>
                                    <th scope="col">Mulai</th>
                                    <th scope="col">Selesai</th>
                                    <th scope="col">Nama Mentor</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Materi</th>
                                    <th scope="col">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($live as $u) {
                                ?>
                                    <tr class="text-center">

                                        <th scope="row">
                                            <?php echo $no++ ?>
                                        </th>

                                        <td>
                                            <?php echo $u->nama_mapel ?>
                                        </td>
                                        <td>
                                            <?php echo $u->tgl_mulai ?>
                                        </td>
                                        <td>
                                            <?php echo $u->tgl_selesai ?>
                                        </td>
                                        <td>
                                            <?php echo $u->nama_guru ?>
                                        </td>
                                        <td>
                                            <?php echo $u->semester ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('admin/data_materi_course/' . $u->id_mapel); ?>" class="btn btn-success">Materi ⭢</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('admin/update_mapel/' . $u->id_mapel); ?>" class="btn btn-info">Edit ⭢</a>

                                            <a onclick="yourConfirm(<?= $u->id_mapel ?>,<?= $u->id_semester ?>);" href="javascript:void(0);" class="btn btn-danger">Delete ✖</a>
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
            title: 'Data Course Berhasil Ditambah!',
            text: 'Selamat data bertambah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('gagal-reg')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Data Course gagal Ditambah!',
            text: 'Silahkan coba kembali!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('success-edit')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Course Telah Dirubah!',
            text: 'Selamat data berubah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('mapel-delete')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Course Telah Dihapus!',
            text: 'Selamat data telah Dihapus!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<!-- End Sweetalert -->

<script type="text/javascript">
    function yourConfirm(id, semester) {
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
                window.location = "<?= base_url('admin/delete_mapel/') ?>" + id + '/' + semester;
            }
        })
    }
</script>

<?php
$this->load->view('admin/template_admin/footer');
?>