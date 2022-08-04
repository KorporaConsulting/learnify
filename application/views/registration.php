<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Learnify dibuat ditujukan agar para siswa dan guru dapat terus belajar dan mengajar dimana saja dan kapan saja." name="Description" />
    <meta content="Learnify, E-learning, Open Source, Syauqi Zaidan Khairan Khalaf, github, programmer indonesia" name="keywords" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/') ?>img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/') ?>img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/') ?>img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url('assets/') ?>img/favicon/site.webmanifest">
    <title>Sales University - Sekolah para TOP achiver !</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/linericon/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/animate-css/animate.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/popup/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/popup/product.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.4/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/popper.js"></script>
    <script src="<?= base_url('assets/') ?>js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.1/lottie.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/lottie.js"></script>
    <script type="text/javascript">
        $(document).ready(() => {
            $("#nav<?= $this->uri->segment(2); ?>").addClass('active')
        })
    </script>

</head>

<body>
    <!-- Home Banner Area  -->
    <section class="banner_area">
        <!-- Registration Form Area -->
        <div class="container mt-5 mb-5" id="registration">
            <div class="row bg-registration p-3">
                <div class="col-md-12 text-center">
                    <p class="registration-title font-weight-bold display-4 mt-4" style="font-size: 50px;">
                        Pendaftaran Sales University</p>
                    <p style="line-height:-30px;margin-top:-20px;">Silahkan isi data data yang diperlukan dibawah ini </p>
                    <hr>
                </div>
                <div class="col-md-6 mx-auto text-center">
                    <div class="bodymovin" data-icon="<?= base_url('assets/') ?>json/registration-animation.json"></div>
                </div>
                <div class="col-md-6 mx-auto my-auto mt--5">
                    <form action="<?= base_url('auth/regis_act') ?>" method="post">
                        <div class="form-group">
                            <label for="nama" class="label-font-register">Nama lengkap</label>
                            <input type="text" autocomplete="off" class="form-control effect-9" name="nama" id="nama" value="<?= set_value('nama'); ?>">
                            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="email" class="label-font-register">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="no_telp" class="label-font-register">Nomer Telepon</label>
                            <input type="number" autocomplete="off" class="form-control effect-9" name="no_telp" id="no_telp" value="<?= set_value('no_telp'); ?>">
                            <?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password" class="label-font-register">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="retype_password" class="label-font-register">Retype password</label>
                                <input type="password" class="form-control" name="retype_password" id="retype_password">
                                <?= form_error('retype_password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input checkbox" type="checkbox" id="defaultCheck1" onchange="document.getElementById('btnsubmit').disabled = !this.checked;">
                            <label class=" form-check-label" for="defaultCheck1">
                                Saya setuju dan ingin melanjutkan
                            </label>
                        </div>
                        <p class="terms">Dengan mendaftar anda menyetujui <i>privasi dan persyaratan ketentuan
                                hukum kami </i>
                            baca selengkapnya <a href="#"> disini</a></p>

                        <p><a href="<?= base_url('login') ?>"> Login</a></p>
                        <button type="submit" name="submit" id="btnsubmit" disabled class="btn btn-block btn-modal btn-submit">Daftar
                            Sekarang!</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Registration Form Area -->
    </section>
    <!-- End Home Banner Area  -->



    <!-- Start Checkbox Scripts -->
    <script>
        $('.tab1_btn').prop('disabled', !$('.tab1_chk:checked')
            .length);
        $('input[type=checkbox]').click(function() {
            if ($('.tab1_chk:checkbox:checked').length > 0) {
                $('.btn-submit').prop('disabled', false);
            } else {
                $('.btn-submit').prop('disabled', true);
            }
        });
    </script>
    <!-- End Checkbox Scripts -->
    <!--================ Start footer Area  =================-->
    <!-- <footer class="footer-area p_60">
        <div class="container">
            <div class="row footer-bottom d-flex justify-content-between align-items-center">
                <p class="col-lg-8 col-md-8 footer-text m-0">
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> Sales University Powered by <a style="color: white;" href="https://pastiprestasi.com/">Pasti Prestasi</a>
                </p>
                <div class="col-lg-4 col-md-4 footer-social">
                    <a href="https://www.youtube.com/channel/UCRTaGfH5CiCYa9dmKVHxX6w"><i class="fa fa-youtube-play"></i></a>
                    <a href="https://www.instagram.com/sahabatsales/"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer> -->
    <!--================ End footer Area  =================-->



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