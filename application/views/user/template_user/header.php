<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Learnify dibuat ditujukan agar para siswa dan guru dapat terus belajar dan mengajar dimana saja dan kapan saja." name="Description" />
    <meta content="Learnify, E-learning, Open Source, Syauqi Zaidan Khairan Khalaf, github, programmer indonesia" name="keywords" />
    <link rel="icon" href="<?= base_url('assets/') ?>img/favicon.png" type="image/png">
    <title>Sales University - Sekolah para TOP achiver !</title>
    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/linericon/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/animate-css/animate.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/popup/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/file_drop.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/scroll-custom.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css" /> -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plyr/plyr.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.4/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/popper.js"></script>
    <script src="<?= base_url('assets/') ?>js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- or -->
    <script type="text/javascript">
        $(document).ready(() => {
            $("#nav<?= $this->uri->segment(2); ?>").addClass('active')

        })
    </script>


    <!-- <style>
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: red;
            border-radius: 10px;
        }
    </style> -->
</head>

<body>

    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="<?= base_url('welcome') ?>"><img src="<?= base_url('assets/') ?>img/logo.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <!-- <li class="nav-item "><a class="nav-link" href="javascript:void(0)">Hai, <?php echo $this->session->userdata('nama'); ?></a>
                            </li> -->
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('user') ?>">Beranda</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('user/all_semester') ?>">Course</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('user/penilaian') ?>">Penilaian</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('user/pembayaran') ?>">Pembayaran</a>
                            </li>
                            <!-- <li class="nav-item"><a class="nav-link" href="<?= base_url('user/profile') ?>">Profile</a>
                            </li> -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                    Hai, <?php echo $this->session->userdata('nama'); ?> <i class="fa fa-caret-down" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <!-- <a class="dropdown-item" href="javascript:void(0)">Hai, <?php echo $this->session->userdata('nama'); ?></a> -->
                                    <a class="dropdown-item" href="<?= base_url('user/profile') ?>"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                                    <a class=" dropdown-item text-danger" href="<?= base_url('welcome/logout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a>
                                </div>
                            </li>
                            <!-- <li class="nav-item "><a class=" nav-link text-danger" href="<?= base_url('welcome/logout') ?>">Log Out</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================ END Header Menu Area =================-->