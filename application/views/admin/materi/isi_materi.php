<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Isi Materi <?= $materi->nama_materi ?></h2>
                <!-- <hr> -->
                <!-- <p class="card-text"> After I ran into Helen at a restaurant, I realized she was just office pretty drop-dead date put in in a deck for our standup today. Who's responsible for the ask for this request? who's responsible for the ask for this request? but moving the goalposts gain traction. </p> -->
                <!-- <a href="<?= base_url('admin/add_materi') ?>" class="btn btn-success">Tambah
                    Materi ⭢ </a> -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4>Tab <code>.nav-pills</code></h4>
                    </div> -->
                    <div class="card-body">
                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true">Video</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false">Modul/File</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false">Quiz</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                                <button type="button" class="btn btn-outline-success mt-5" data-toggle="modal" data-target=".video">Tambah Video ⭢</button>

                                <div class="row mt-5">
                                    <div class="col-12 col-sm-6 col-lg-12">
                                        <h4>List Video</h4>
                                        <div class="row">
                                            <?php foreach ($video as $v) { ?>
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="embed-responsive embed-responsive-4by3">
                                                                <iframe class="embed-responsive-item" <?php if ($v->video == null) { ?> src="https://www.youtube.com/embed/<?= $v->link ?>" <?php } else { ?>src="<?= base_url('assets/materi_video/' . $v->video) ?>" <?php } ?>></iframe>
                                                            </div>
                                                            <div class="text-center mt-2">
                                                                <h5><?= $v->nama_video ?></h5>
                                                                <p><?= $v->desk_video ?></p>
                                                            </div>
                                                            <div class="text-center mt-2">
                                                                <a href="<?php echo site_url('admin/update_video/' . $v->id_video); ?>" class="btn btn-info">Edit ⭢</a>
                                                                <a onclick="video_delete(<?= $v->id_video ?>,<?= $v->id_materi ?>);" href="javascript:void(0);" class="btn btn-danger">Delete ✖</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                <button type="button" class="btn btn-outline-success mt-5" data-toggle="modal" data-target=".modul">Tambah Modul/File ⭢</button>
                                <div class="row mt-5">
                                    <div class="col-12 col-sm-6 col-lg-12">
                                        <h4>List Modul/File</h4>
                                        <div class="row">
                                            <?php foreach ($file as $m) { ?>
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <a href="<?= $m->link ?>" target="_blank" class="btn btn-icon btn-success w-100"><i class="fas fa-file-download w-100"></i></a>
                                                            <div class="text-center mt-2">
                                                                <h5><?= $m->nama_file ?></h5>
                                                                <p><?= $m->desk_file ?></p>
                                                            </div>
                                                            <div class="text-center mt-2">
                                                                <a href="<?php echo site_url('admin/update_file/' . $m->id_file); ?>" class="btn btn-info">Edit ⭢</a>
                                                                <a onclick="file_delete(<?= $m->id_file ?>,<?= $m->id_materi ?>);" href="javascript:void(0);" class="btn btn-danger">Delete ✖</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                                <button type="button" class="btn btn-outline-success mt-5" data-toggle="modal" data-target="#quiz">Tambah Soal ⭢</button>
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
                                                    <a href="<?php echo site_url('admin/edit_soal/' . $u->id_soal); ?>" class="btn btn-info">Update ⭢</a>

                                                    <a onclick="deletesoal(<?= $u->id_soal ?>, '<?= $materi->id_materi ?>');" href="javascript:void(0);" class="btn btn-danger">Delete ✖</a>
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
            </div>
        </div>
    </section>
</div>
</div>
</div>
<!-- End Main Content -->
<!-- Modal Video -->
<div class="modal fade video" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4">
                        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="true">Upload</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="false">Embed</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8">
                        <div class="tab-content no-padding" id="myTab2Content">
                            <div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                                <form action="<?= base_url('admin/upload_video') ?>" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="id_materi" value="<?= $materi->id_materi ?>">

                                    <div class="form-group">
                                        <div class="section-title">Upload Video</div>
                                        <div class="custom-file">
                                            <input required type="file" accept="video/mp4,video/mkv,video/mov" class="custom-file-input" id="customFile" name="video">
                                            <label class="custom-file-label" for="customFile">Pilih Video</label>
                                        </div>
                                        <?= form_error('video', '<small class="text-danger">', '</small>'); ?>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_video">Judul Video</label>
                                        <input required id="nama_video" type="text" class="form-control" value="<?php echo set_value('nama_video') ?>" name="nama_video">
                                        <?= form_error('nama_video', '<small class="text-danger">', '</small>'); ?>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi (Optional)</label>
                                        <textarea class="form-control" name="desk_video" id="desk_video" cols="30" rows="10"><?php echo set_value('desk_video') ?></textarea>
                                        <?= form_error('desk_video', '<small class="text-danger">', '</small>'); ?>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">
                                            Submit ⭢
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                                <form action="<?= base_url('admin/upload_video') ?>" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="id_materi" value="<?= $materi->id_materi ?>">
                                    <div class="form-group">
                                        <label for="link">Youtube ID Video</label>
                                        <input required id="link" type="text" class="form-control" value="<?php echo set_value('link') ?>" name="link">
                                        <?= form_error('link', '<small class="text-danger">', '</small>'); ?>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_video">Judul Video</label>
                                        <input required id="nama_video" type="text" class="form-control" value="<?php echo set_value('nama_video') ?>" name="nama_video">
                                        <?= form_error('nama_video', '<small class="text-danger">', '</small>'); ?>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi (Optional)</label>
                                        <textarea class="form-control" name="desk_video" id="desk_video" cols="30" rows="10"><?php echo set_value('desk_video') ?></textarea>
                                        <?= form_error('desk_video', '<small class="text-danger">', '</small>'); ?>
                                        <div class="invalid-feedback">
                                        </div>
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
            </div>

        </div>
    </div>
</div>
<!-- Modal Modul -->
<div class="modal fade modul" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Modul/File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/insert_file') ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id_materi" value="<?= $materi->id_materi ?>">
                    <input type="hidden" name="modal" value="quiz">
                    <div class="form-group">
                        <label for="nama_file">Judul Modul/File</label>
                        <input required id="nama_file" type="text" class="form-control" value="<?php echo set_value('nama_file') ?>" name="nama_file">
                        <?= form_error('nama_file', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi (Optional)</label>
                        <textarea class="form-control" name="desk_file" id="desk_file" cols="30" rows="10"><?php echo set_value('desk_file') ?></textarea>
                        <?= form_error('desk_file', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="link">Link Modul/File</label>
                        <input required id="link" type="text" class="form-control" value="<?php echo set_value('link') ?>" name="link">
                        <?= form_error('link', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
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
<!-- Modal Modul -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="quiz">
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
                    <input type="hidden" name="id_materi" value="<?= $materi->id_materi ?>" required>
                    <!-- <div class="form-group">
                        <label for="nama_file">Judul Modul/File</label>
                        <input required id="nama_file" type="text" class="form-control" value="<?php echo set_value('nama_file') ?>" name="nama_file">
                        <?= form_error('nama_file', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="soal">Soal</label>
                        <textarea name="soal" id="soal" class="form-control" cols="30" rows="10" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control-file" name="file" id="file" require>
                        <?php if($this->session->flashdata('fileValidate')) : ?>
                            <small class="text-danger"><?= $this->session->flashdata('fileValidate') ?></small>
                        <?php endif; ?>
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
                    <!-- <div class="form-group">
                        <label>Deskripsi (Optional)</label>
                        <textarea class="form-control" name="desk_file" id="desk_file" cols="30" rows="10"><?php echo set_value('desk_file') ?></textarea>
                        <?= form_error('desk_file', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="link">Link Modul/File</label>
                        <input required id="link" type="text" class="form-control" value="<?php echo set_value('link') ?>" name="link">
                        <?= form_error('link', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div> -->
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
<?php if ($this->session->flashdata('success-video')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Video Berhasil Ditambah!',
            text: 'Selamat data bertambah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('success-file')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data File Berhasil Ditambah!',
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
            title: 'Data Materi gagal Ditambah!',
            text: 'Silahkan coba kembali!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('success-video-edit')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Video Telah Dirubah!',
            text: 'Selamat data berubah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('success-file-edit')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data File Telah Dirubah!',
            text: 'Selamat data berubah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('video-delete')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Video Telah Dihapus!',
            text: 'Selamat data telah Dihapus!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('file-delete')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data File Telah Dihapus!',
            text: 'Selamat data telah Dihapus!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<!-- End Sweetalert -->

<script type="text/javascript">
    function video_delete(id, id_materi) {
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
                window.location = "<?= base_url('admin/delete_video/') ?>" + id + "/" + id_materi;
            }
        })
    }
</script>
<script type="text/javascript">
    function file_delete(id, id_materi) {
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
                window.location = "<?= base_url('admin/delete_file/') ?>" + id + "/" + id_materi;
            }
        })
    }
</script>
<script type="text/javascript">
    function deletesoal(id, id_materi) {
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
                window.location = "<?= base_url('admin/delete_soal/') ?>" + id + "/" + id_materi;
            }
        })
    }
</script>
<?php
$this->load->view('admin/template_admin/footer');
?>
<?php if($this->session->flashdata('modal')) : ?>
    <script>
        $('#<?= $this->session->flashdata('modal') ?>').modal('show')
    </script>
<?php endif; ?>

<?php if($this->session->flashdata('tab')) : ?>
    <script>
        $(function(){
            $('.tab-pane').removeClass('show active');
            $('.nav-link').removeClass('active');
            $('#<?= $this->session->flashdata('tab') ?>').addClass('active show');
            $('#<?= $this->session->flashdata('nav-link') ?>').addClass('active');
        });
    </script>
<?php endif; ?>