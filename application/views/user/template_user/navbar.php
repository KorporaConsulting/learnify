<header class="header_area" style="background-color: white !important;">
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
                        <li class="nav-item "><a class="nav-link" href="javascript:void(0)">Hai, <?php echo $this->session->userdata('nama'); ?></a>
                        </li>
                        <li class="nav-item active"><a class="nav-link" href="<?= base_url('user') ?>">Beranda</a>
                        </li>
                        <li class=" nav-item "><a class=" nav-link text-danger" href="<?= base_url('welcome/logout') ?>">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
 <header class="header_area">
        <div class="top_menu row m0">
            <div class="container">
                <div class="float-left">
                    <ul class="list header_social">
                        <li><a href="https://www.facebook.com/syaaauqi"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/syaaauqi"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://dribbble.com/syaufy"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="https://www.behance.net/syaufy"><i class="fa fa-behance"></i></a></li>
                        <li><a href="https://www.github.com/syauqi"><i class="fa fa-github"></i></a></li>
                        <li><a href="https://www.instagram.com/syaufy"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="float-right">
                    <a class="dn_btn" href="mailto:apps.learnify@gmail.com">apps.learnify@gmail.com</a>
                </div>
            </div>
        </div>

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
                            <li class="nav-item" id="nav"><a class="nav-link" href="<?= base_url('welcome') ?>">Beranda</a></li>
                            <li class="nav-item" id="navtentang"><a class="nav-link" href="<?= base_url('welcome/tentang') ?>">Tentang</a>
                            </li>
                            <li class="nav-item submenu dropdown" id="navpelajaran">
                                <a href="<?= base_url('welcome/pelajaran') ?>" class="nav-link dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">Pelajaran</a>
                            </li>
                            <li class="nav-item" id="navkontak"><a class="nav-link" href="<?= base_url('welcome/kontak') ?>">Kontak</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModalCenter">Masuk</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
<!-- End Navigation Bar -->