<!-- End Home Banner Area  -->

<!-- Registration Form Area -->
<section class="banner_area">
    <div class="container mt-5 pt-5 mb-5" id="registration">
        <div class="row bg-registration p-3">
            <div class="col-md-12 text-center">
                <p class="registration-title font-weight-bold display-4 mt-4" style="font-size: 50px;">
                    Login Sales University</p>
                <p style="line-height:-30px;margin-top:-20px;">Masukan Email dan Password Anda </p>
                <hr>
            </div>
            <div class="col-md-6 mx-auto text-center">
                <div class="bodymovin" data-icon="<?= base_url('assets/') ?>json/login.json"></div>
            </div>
            <div class="col-md-6 mx-auto my-auto mt-5">
                <form action="<?= base_url('auth/validateLogin') ?>" method="post">
                    <div class="form-group">
                        <label class="label-font" for="
                                        exampleFormControlInput1">
                            Email</label>
                        <input required type="email" value="<?= set_value('email'); ?>" class="form-control" name="email" autocomplete="off" id="email" placeholder="Masukan email mu disini ..">
                        <small class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label class="label-font" for="
                                        exampleFormControlInput1">
                            Password</label>
                        <input required type="password" name="password" class="form-control" id="password" placeholder="Masukan password mu disini ..">
                        <small class="text-danger"></small>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Ingat saya.
                        </label>
                    </div>
                    <h6 class="terms mt-2"></a>
                        Belum punya akun? daftar <a href=" <?= base_url('register') ?>">
                            disini.</a>
                    </h6>
                    <button class="btn btn-block font-weight-bold mt-3" style="background-color: #193c7f;color:white;font-size:18px;">Login
                        Sekarang!</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End Registration Form Area -->
<?php if ($this->session->flashdata('fail-login')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal login!',
            text: 'Silahkan Periksa Kembali Email dan Password Kamu!',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>


<?php if ($this->session->flashdata('fail-pass')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Password Salah!',
            text: 'Silahkan Periksa Kembali Password Kamu!',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>


<?php if ($this->session->flashdata('not-login')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Harap Login Terlebih Dahulu !',
            text: 'Silahkan Login Dahulu !',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('sukses-regis')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Silahkan Login untuk melanjuakan sesi Anda',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
<?php endif; ?>