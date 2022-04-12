<body>
    <!-- Start Sidebar -->
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class=" navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                        </li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" style="margin-bottom:4px !important;" src="<?= base_url() ?>/assets/profile_picture/null.svg" class="rounded-circle mr-1 my-auto border-white">
                            <div class="d-sm-none d-lg-inline-block" style="font-size:15px;">Hello, <?php echo $this->session->userdata('nama'); ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Admin - Sales University</div>
                            <a href="<?= base_url('welcome/logout') ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand text-danger">
                        <div>
                            <a href="<?= base_url('admin') ?>" style="font-size: 21px;font-weight:900;font-family: 'Poppins', sans-serif;" class="text-success text-center"><i style="font-size: 30px;" class="fas fa-graduation-cap"></i> |
                                Sales University</a>
                        </div>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="<?= base_url('admin') ?>">SU</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header ">Dashboard</li>
                        <li class="nav-item dropdown active">
                            <a href="<?= base_url('admin') ?>" class="nav-link"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
                        </li>
                        <li class="menu-header">Management User</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i>
                                <span>User</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= base_url('admin/data_siswa') ?>">Data User</a></li>
                            </ul>
                        </li>
                        <li class="menu-header">Management Mentor</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-chalkboard-teacher"></i>
                                <span>Mentor</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= base_url('admin/data_guru') ?>">Data Mentor</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-header">Management Kursus</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-book"></i>
                                <span>Kursus</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= base_url('admin/data_mapel') ?>">Data Course</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= base_url('admin/data_materi') ?>">Data Materi</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= base_url('admin/data_enroll') ?>">Enroll User</a>
                                </li>
                            </ul>
                        </li>
                </aside>
            </div>
            <!-- End Sidebar -->