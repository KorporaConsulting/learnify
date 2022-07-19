<!--================ Start footer Area  =================-->
<footer class="footer-area p_60">
    <div class="container">
        <div class="row footer-bottom d-flex justify-content-between align-items-center">
            <p class="col-lg-8 col-md-8 footer-text m-0">
                Copyright &copy;<script>
                    document.write(new Date().getFullYear());
                </script> Sales University Powered by <a style="color: white;" href="https://pastiprestasi.com/">Pasti Prestasi</a>
            </p>
            <div class="col-lg-4 col-md-4 footer-social">
                <a href="https://www.facebook.com/syaaauqi"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/syaaauqi"><i class="fa fa-twitter"></i></a>
                <a href="https://dribbble.com/syaufy"><i class="fa fa-dribbble"></i></a>
                <a href="https://www.behance.net/syaufy"><i class="fa fa-behance"></i></a>
                <a href="https://www.github.com/syauqi"><i class="fa fa-github"></i></a>
                <a href="https://www.instagram.com/syaufy"><i class="fa fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>
<!--================ End footer Area  =================-->


<!-- Start Login Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-dark font-weight-bold" style="color:#212529 !important;" id="exampleModalCenterTitle">
                    Sales University - Masuk Sekarang</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <br>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <img src="<?= base_url('assets/'); ?>img/modal-login-2.svg" class="img-fluid img-responsive mx-auto " style="height: 350px;">
                        </div>
                        <div class=" col-md-6">
                            <form action="<?= base_url('welcome/validateLogin') ?>" method="post">
                                <div class="form-group">
                                    <label class="label-font" for="
                                        exampleFormControlInput1">
                                        Email</label>
                                    <input required type="text" value="<?= set_value('email'); ?>" class="form-control" name="email" autocomplete="off" id="email" placeholder="Masukan email mu disini ..">
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
                                <p class="terms">Dengan login anda
                                    menyetujui
                                    <i>privasi dan persyaratan ketentuan
                                        hukum kami </i> .
                                    belum punya akun? daftar <a href=" <?= base_url('user/registration') ?>">
                                        disini.</a>
                                </p>
                                <button class="btn btn-block font-weight-bold" style="background-color: #193c7f;color:white;font-size:18px;">Login
                                    Sekarang!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Login Modal -->


<!-- Sweetaler Flashdata -->
<?php if ($this->session->flashdata('success-reg')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Kamu berhasil daftar!',
            text: 'Sekarang kamu boleh login!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>


<?php if ($this->session->flashdata('login-success')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Kamu berhasil daftar!',
            text: 'Sekarang login yuk!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>


<?php if ($this->session->flashdata('success-verify')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Email Telah Diverifikasi!',
            text: 'Sekarang login yuk!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>


<?php if ($this->session->flashdata('success-logout')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Kamu berhasil logout!',
            text: 'Selamat tinggal, Sampai jumpa lagi!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>


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


<?php if ($this->session->flashdata('fail-email')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Email Belum Diverifikasi!',
            text: 'Silahkan Cek Email Kamu Dahulu!',
            showConfirmButton: false,
            timer: 2500
        })
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

<?php if ($this->session->flashdata('false-login')) : ?>
    <script>
        $("#exampleModalCenter").modal("show")
    </script>
<?php endif; ?>

<script src="<?= base_url('assets/') ?>js/stellar.js"></script>
<script src="<?= base_url('assets/') ?>vendors/lightbox/simpleLightbox.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/isotope/imagesloaded.pkgd.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/isotope/isotope.pkgd.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/popup/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url('assets/') ?>js/jquery.ajaxchimp.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/counter-up/jquery.waypoints.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/counter-up/jquery.counterup.js"></script>
<script src="<?= base_url('assets/') ?>js/mail-script.js"></script>
<script src="<?= base_url('assets/') ?>js/theme.js"></script>
<script>
    var animateButton = function(e) {
        e.preventDefault;
        e.target.classList.remove('animate');
        e.target.classList.add('animate');
        setTimeout(function() {
            e.target.classList.remove('animate');
        }, 700);
    };

    var bubblyButtons = document.getElementsByClassName("bubbly-button");

    for (var i = 0; i < bubblyButtons.length; i++) {
        bubblyButtons[i].addEventListener('click', animateButton, false);
    }
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/62cfd1a17b967b1179997997/1g7tslomh';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
</body>

</html>