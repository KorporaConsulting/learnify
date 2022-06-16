<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="">
            <div class="card" style="width:100%;">
                <div class="card-body">
                    <h2 class="card-title" style="color: black;">Edit Course</h2>
                    <hr>
                    <!-- <p class="card-text">After I ran into Helen at a restaurant, I realized she was just office pretty drop-dead date put in in a deck for our standup today. Who's responsible for the ask for this request? who's responsible for the ask for this request? but moving the goalposts gain traction.
                    </p>
                    <a href="#detail" class="btn btn-success">Saya paham dan
                        ingin melanjutkan ⭢</a> -->
                </div>
            </div>
        </div>
        <form action="<?= base_url('admin/mapel_edit') ?>" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id_mapel" value="<?= $user->id_mapel ?>">
            <input type="hidden" name="image" value="<?= $user->image ?>">
            <div id="detail" class="col-md-12 bg-white p-3" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                <h1 class="font-weight-bold card-title text-center" style="color: black;">Update Data
                    Courses
                </h1>
                <p class="text-center" style="line-height: 5px;">Silahkan isi data dibawah untuk update
                    data, dan upload file diatas untuk update data profile picture</p>
                <hr>
                <div class="">
                    <div class="hero text-white hero-bg-image" data-background="<?= base_url('assets/') ?>stisla-assets/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg">
                        <div class="col-md-4 mx-auto rounded-circle bg-white p-3" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                            <img src="<?= base_url() . 'assets/img/courses/' . $user->image; ?>" class="card-img-top  rounded-circle img-responsive" alt="...">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="section-title">Gambar Course</div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="customFile">
                        <label class="custom-file-label" for="customFile">Ganti Gambar</label>
                    </div>
                    <?= form_error('image', '<small class="text-danger">', '</small>'); ?>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Course</label>
                    <input id="nama" type="text" class="form-control" value="<?php echo $user->nama ?>" name="nama">
                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="desk" id="desk" cols="30" rows="10"><?php echo $user->desk ?></textarea>
                    <?= form_error('desk', '<small class="text-danger">', '</small>'); ?>
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label>Mentor Course</label>
                        <select class="form-control select2" name="guru">
                            <option disabled selected>Pilih Mentor</option>
                            <?php foreach ($mentor as $m) { ?>
                                <option <?php if ($m->id_guru == $user->id_guru) {
                                            echo 'selected="selected"';
                                        } ?> value="<?php echo $m->id_guru ?>"><?= $m->nama_guru ?></option>
                            <?php } ?>
                        </select>
                        <?= form_error('guru', '<small class="text-danger">', '</small>'); ?>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Semester</label>
                    <div class="section-title">Terpilih</div>
                    <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input type="radio" name="semester" value="1" <?php
                                                                            echo set_value('semester', $user->semester) == 1 ? "checked" : "";
                                                                            ?> class="selectgroup-input">
                            <span class="selectgroup-button">1 (SATU)</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="semester" value="2" <?php
                                                                            echo set_value('semester', $user->semester) == 2 ? "checked" : "";
                                                                            ?> class="selectgroup-input">
                            <span class="selectgroup-button">2 (DUA)</span>
                        </label>
                    </div>
                    <?= form_error('semester', '<small class="text-danger">', '</small>'); ?>
                    <div class="invalid-feedback">
                    </div>
                </div>

                <input type="submit" value="Update ⭢" class="btn btn-success btn-block">
            </div>
        </form>
    </section>
</div>
</div>
</div>
<!-- End Main Content -->
<?php if ($this->session->flashdata('gagal-reg')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Data Course gagal diupdate!',
            text: 'Silahkan coba lagi',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php
$this->load->view('admin/template_admin/footer');
?>