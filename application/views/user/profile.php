<?php $this->load->view('user/template_user/header'); ?>
<!-- Start Greetings Card -->
<!-- <div class="container">
    <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
        <div class="row" style="color: black; font-family: 'poppins';">
            <div class="col-md-12 mt-1">
                <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="400">Selamat Datang
                    di Sales University <span style="font-size: 40px;">👋🏻
                    </span> </h1>
                <p>Hello Students! , Ini merupakan halaman utama Sales University ! Selamat belajar ya students!</p>
                <hr>
            </div>
        </div>
    </div>
</div> -->
<div class="container">
    <div class="row mt-1 mb-5">
        <div class="col-md-12">
            <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                <div class="row" style="color: black; font-family: 'poppins';">
                    <div class="col-md-12 mt-1">
                        <h1 class="text-center">Profile</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-6">
            <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                <div class="row" style="color: black; font-family: 'poppins';">
                    <div class="col-md-12 mt-1 text-center">
                        <img class="rounded-circle" width="100px" alt="100x100" src="<?= base_url('assets/profile_picture/' . $profile->image_user) ?>" data-holder-rendered="true">
                        <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="400"> </h1>
                        <h5><?= $profile->nama ?></h5>
                    </div>
                </div>
            </div>
            <div class="card mt-2 mb-2 shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                <h6>Ganti Foto Profile</h6>
                <form action="<?= base_url('user/image_profile') ?>" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" id="profile" required class="custom-file-input" name="image_user" accept="image/*" id="customFileLang" lang=in">
                            <label class="custom-file-label" id="profile-pilih" for="customFileLang">Pilih Gambar</label>
                        </div>
                    </div>
                    <div class="form-grup">
                        <button type="submit" class="btn btn-primary float-right" btn-sm btn-block">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                <div class="row" style="color: black; font-family: 'poppins';">
                    <div class="col-md-12 mt-1 text-center">
                        <img class="img-fluid" width="250px" alt="300x300" src="<?= base_url('assets/img/qr-code-login/qr_icon.svg') ?>" data-holder-rendered="true">
                        <!-- <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="400"> </h1> -->
                        <h5>QR absensi</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Greetings Card -->


<br>


<!-- Start Class Card -->
<div class="container">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="col-md-12 ">
            <div class="row justify-content-center">
                <div class="col-sm-12 mb-2 d-flex justify-content-center " data-aos-duration="400" data-aos="fade-right">
                    <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                        <form action="<?= base_url('user/update_profile') ?>" method="post">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" required name="nama" value="<?= $profile->nama ?>" id="nama" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" value="<?= $profile->email ?>" required class="form-control" name="email" id="email" placeholder="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">No Telepon</label>
                                <input type="number" required value="<?= $profile->no_telp ?>" pattern="^\d{3}-\d{3}-\d{4}$" class="form-control" name="no_telp" id="no_telp" placeholder="">
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="jk">Jenis Kelamin</label> <br>
                                        <select required class="form-control " name="jk" id="">
                                            <option value="" <?= ($profile->jk == "") ? "selected" : "" ?>>Pilih Jenis Kelamin</option>
                                            <option value="Perempuan" <?= ($profile->jk == "Perempuan") ? "selected" : "" ?>>Perempuan</option>
                                            <option value="Laki-laki" <?= ($profile->jk == "Laki-laki") ? "selected" : "" ?>>Laki-laki</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ttl">Tanggal Lahir</label>
                                <input type="date" required class="form-control" value="<?= $profile->ttl ?>" name="ttl" id="ttl" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea class="form-control" required name="alamat" id="alamat" rows="3"><?= $profile->alamat ?></textarea>
                            </div>
                            <div id="password" style="display: none;">
                                <div class="form-group">
                                    <label for="">Password Baru</label>
                                    <input type="text" class="form-control" name="password_baru" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Ulangi Password Baru</label>
                                    <input type="text" class="form-control" name="conf_password" placeholder="">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" id="button-password" class="btn btn-outline-primary" aria-describedby="helpId"><i class="fa fa-arrow-down"></i> Ubah Password</button>
                            </div>
                            <div class="float-right mt-5 pt-5">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Class Card -->
<script>
    $("#button-password").click(function() {
        $("#password").show();
        $("#button-password").hide("slow");
    });
</script>
<?php if ($this->session->flashdata('success-password')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?= $this->session->flashdata('success-password') ?>',
            text: 'Password berhasil diubah',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('error-password')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: '<?= $this->session->flashdata('error-password') ?>',
            text: 'Password tidak sama',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('success-profile')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?= $this->session->flashdata('success-profile') ?>',
            text: 'Password berhasil diubah',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('error-profile')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: '<?= $this->session->flashdata('error-profile') ?>',
            // text: 'Password tidak sama',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<script>
    $('#profile').change(function(e) {
        var filename = this.files[0].name;
        $('#profile-pilih').text(filename);
    });
</script>
<?php $this->load->view('user/template_user/footer'); ?>