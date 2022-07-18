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
                <a href="<?= base_url('admin/data_materi_course/' . $materi->id_mapel) ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali </a>
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
                            <?php if ($file_row == null && $quiz_row == null && $tugas_row == null && $zoom_row == null) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true">Video</a>
                                </li>
                            <?php } ?>
                            <?php if ($video_row == null && $quiz_row == null && $tugas_row == null && $zoom_row == null) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false">Modul</a>
                                </li>
                            <?php } ?>
                            <?php if ($file_row == null && $video_row == null && $tugas_row == null && $zoom_row == null) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false">Quiz</a>
                                </li>
                            <?php } ?>
                            <?php if ($file_row == null && $video_row == null && $quiz_row == null && $zoom_row == null) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact2" aria-selected="false">Tugas</a>
                                </li>
                            <?php } ?>
                        </ul>
                        <div class="tab-content" id="myTabContent2">
                            <?php if ($file_row == null && $quiz_row == null && $tugas_row == null && $zoom_row == null) { ?>
                                <div class="tab-pane fade show" id="home3" role="tabpanel" aria-labelledby="home-tab3">
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
                            <?php } ?>
                            <?php if ($video_row == null && $quiz_row == null && $tugas_row == null && $zoom_row == null) { ?>
                                <div class="tab-pane fade show" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                    <button type="button" class="btn btn-outline-success mt-5" data-toggle="modal" data-target=".modul">Tambah Modul/File ⭢</button>
                                    <div class="row mt-5">
                                        <div class="col-12 col-sm-6 col-lg-12">
                                            <h4>List Modul</h4>
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
                            <?php } ?>
                            <?php if ($file_row == null && $video_row == null && $tugas_row == null && $zoom_row == null) { ?>
                                <div class="tab-pane fade show" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                                    <?php if ($quiz_row == null) { ?>
                                        <button type="button" class="btn btn-outline-success mt-5" data-toggle="modal" data-target="#quiz">Tambah Quiz ⭢</button>
                                        <!-- <button type="button" class="btn btn-outline-success mt-5" data-toggle="modal" data-target="#soal">Tambah Soal ⭢</button> -->
                                    <?php } ?>
                                    <div class="row mt-5">
                                        <div class="col-12 col-sm-6 col-lg-12">
                                            <table id="example" class="table align-items-center table-flush mt-5">
                                                <thead class="thead-light">
                                                    <tr class="text-center">
                                                        <th scope="col">No</th>
                                                        <th scope="col">Judul Quiz</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Soal</th>
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
                                                                <?php echo $u->judul ?>
                                                            </td>
                                                            <?php
                                                            if ($u->type == 0) { ?>
                                                                <td>
                                                                    <?php echo "Test Quiz" ?>
                                                                </td>
                                                            <?php  } else { ?>
                                                                <td>
                                                                    <?php echo "Final Quiz" ?>
                                                                </td>
                                                            <?php  } ?>
                                                            <td class="text-center">
                                                                <a href="<?php echo site_url('admin/view_soal/' . $u->id_quiz); ?>" class="btn btn-primary">Tambah Soal ⭢</a>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="<?php echo site_url('admin/edit_quiz/' . $u->id_quiz); ?>" class="btn btn-info">Edit ⭢</a>
                                                                <a onclick="deletesoal(<?= $u->id_quiz ?>, '<?= $materi->id_materi ?>');" href="javascript:void(0);" class="btn btn-danger">Delete ✖</a>
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
                            <?php } ?>
                            <?php if ($file_row == null && $video_row == null && $quiz_row == null && $zoom_row == null) { ?>
                                <div class="tab-pane fade show" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                                    <?php if ($tugas_row == null) { ?>
                                        <button type="button" class="btn btn-outline-success mt-5" data-toggle="modal" data-target=".tugas">Tambah Tugas ⭢</button>
                                    <?php } ?>

                                    <div class="row mt-5">
                                        <div class="col-12 col-sm-6 col-lg-12">
                                            <h4>List Tugas</h4>
                                            <table id="example" class="table align-items-center table-flush mt-5">
                                                <thead class="thead-light">
                                                    <tr class="text-center">
                                                        <th scope="col">Tugas</th>
                                                        <th scope="col">Deskripsi</th>
                                                        <th scope="col">Due Date</th>
                                                        <th scope="col">Option</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($tugas as $t) {
                                                    ?>
                                                        <tr class="text-center">
                                                            <td>
                                                                <?php echo $t->nama_tugas ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $t->desk_tugas ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $t->due_date ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="<?php echo site_url('admin/edit_tugas/' . $t->id_tugas); ?>" class="btn btn-info">Edit ⭢</a>
                                                                <a onclick="deletetugas(<?= $t->id_tugas ?>, '<?= $materi->id_materi ?>');" href="javascript:void(0);" class="btn btn-danger">Delete ✖</a>
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
                            <?php } ?>
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
<!-- Modal Tugas -->
<div class="modal fade tugas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/insert_tugas') ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id_materi" value="<?= $materi->id_materi ?>">
                    <input type="hidden" name="modal" value="quiz">
                    <div class="form-group">
                        <label for="link_template">Link Template</label>
                        <input required id="link_template" type="text" class="form-control" value="<?php echo set_value('link_template') ?>" name="link_template">
                        <?= form_error('link_template', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_tugas">Nama Tugas</label>
                        <input required id="nama_tugas" type="text" class="form-control" value="<?php echo set_value('nama_tugas') ?>" name="nama_tugas">
                        <?= form_error('nama_tugas', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi (Optional)</label>
                        <textarea class="form-control" name="desk_tugas" id="desk_tugas" cols="30" rows="10"><?php echo set_value('desk_tugas') ?></textarea>
                        <?= form_error('desk_tugas', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input required id="due_date" type="date" class="form-control" value="<?php echo set_value('due_date') ?>" name="due_date">
                        <?= form_error('due_date', '<small class="text-danger">', '</small>'); ?>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Quiz</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/tambah_quiz') ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="modal" value="quiz">
                    <input type="hidden" name="tab" value="contact3">
                    <input type="hidden" name="nav-link" value="contact-tab3">
                    <input type="hidden" name="id_materi" value="<?= $materi->id_materi ?>" required>

                    <div class="form-group">
                        <label for="judul">Judul Quiz</label>
                        <input type="text" class="form-control" name="judul" id="judul">
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="type">Type Quiz</label>
                            <select required class="form-control" name="type" id="type">
                                <option disabled selected>Pilih Type Quiz</option>
                                <option value="0">Test Quiz</option>
                                <option value="1">Final Quiz</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="min_nilai">Minimum nilai Quiz</label>
                        <input type="number" class="form-control" name="min_nilai" id="min_nilai">
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

<div class="modal fade zoom" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Link Zoom</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/insert_zoom') ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id_materi" value="<?= $materi->id_materi ?>">
                    <input type="hidden" name="modal" value="quiz">
                    <div class="form-group">
                        <label for="nama_zoom">Topik</label>
                        <input required id="nama_zoom" type="text" class="form-control" value="<?php echo set_value('nama_zoom') ?>" name="nama_zoom">
                        <?= form_error('nama_zoom', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi (Optional)</label>
                        <textarea class="form-control" name="desk_zoom" id="desk_zoom" cols="30" rows="10"><?php echo set_value('desk_zoom') ?></textarea>
                        <?= form_error('desk_zoom', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="link">Link Zoom</label>
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

<!-- Start Sweetalert -->
<?php if ($this->session->flashdata('success-edit-quiz')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil Diubah!',
            text: 'Selamat data bertambah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
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
<?php if ($this->session->flashdata('success-tugas-edit')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Tugas Telah Dirubah!',
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
<?php if ($this->session->flashdata('tugas-delete')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Tugas Telah Dihapus!',
            text: 'Selamat data telah Dihapus!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('success-delete')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Soal Telah Dihapus!',
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

    function zoom_delete(id, id_materi) {
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
                window.location = "<?= base_url('admin/delete_zoom/') ?>" + id + "/" + id_materi;
            }
        })
    }
</script>
<script type="text/javascript">
    function deletetugas(id, id_materi) {
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
                window.location = "<?= base_url('admin/delete_tugas/') ?>" + id + "/" + id_materi;
            }
        })
    }
</script>
<script type="text/javascript">
    function deletesoal(id, materi) {
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
                window.location = "<?= base_url('admin/delete_quiz/') ?>" + id + '/' + materi;
            }
        })
    }
</script>
<?php
$this->load->view('admin/template_admin/footer');
?>
<?php if ($this->session->flashdata('modal')) : ?>
    <script>
        $('#<?= $this->session->flashdata('modal') ?>').modal('show')
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('tab')) : ?>
    <script>
        $(function() {
            $('.tab-pane').removeClass('show active');
            $('.nav-link').removeClass('active');
            $('#<?= $this->session->flashdata('tab') ?>').addClass('active show');
            $('#<?= $this->session->flashdata('nav-link') ?>').addClass('active');
        });
    </script>
<?php endif; ?>