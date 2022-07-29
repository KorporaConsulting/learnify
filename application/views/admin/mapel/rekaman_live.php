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
                    <h2 class="card-title" style="color: black;">Input Rekaman Live Kelas</h2>
                    <hr>
                    <!-- <p class="card-text">After I ran into Helen at a restaurant, I realized she was just office pretty drop-dead date put in in a deck for our standup today. Who's responsible for the ask for this request? who's responsible for the ask for this request? but moving the goalposts gain traction.
                    </p>
                    <a href="#detail" class="btn btn-success">Saya paham dan
                        ingin melanjutkan ⭢</a> -->
                </div>
            </div>
        </div>
        <form action="<?= base_url('admin/insert_video') ?>" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id_mapel" value="<?= $user->id_mapel ?>">
            <input type="hidden" name="image" value="<?= $user->image ?>">
            <div id="detail" class="col-md-12 bg-white p-3" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                <h1 class="font-weight-bold card-title text-center" style="color: black;">Rekaman Live Kelas
                </h1>
                <!-- <p class="text-center" style="line-height: 5px;">Silahkan isi data dibawah untuk update
                    data, dan upload file diatas untuk update data profile picture</p> -->
                <hr>
                <div class="form-group">
                    <label for="video">ID Youtube</label>
                    <input required id="video" type="text" value="<?= $user->video ?>" class="form-control" name="video">
                    <?= form_error('video', '<small class="text-danger">', '</small>'); ?>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <input type="submit" value="submit ⭢" class="btn btn-success btn-block">
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