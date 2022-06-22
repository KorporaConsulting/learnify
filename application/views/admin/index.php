<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 style="font-size: 27px; letter-spacing:-0.5px; color:black;">Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>User</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $this->db->count_all('user'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Mentor</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $this->db->count_all('guru'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Course</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $this->db->count_all('mapel'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-clipboard"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Materi</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $this->db->count_all('materi'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="card" style="width:100%;">
                <div class="card-body">
                    <h2 class="card-title" style="color: black;">Tambah Materi?</h2>
                    <hr>
                    <p class="card-text">Anda dapat mnembah materi disini.</p>
                    <a href="<?= base_url('admin/add_materi') ?>" class="btn btn-success">Tambah Materi ⭢</a>
                </div>
            </div>
        </div>
        <div class="">
            <div class="hero text-white hero-bg-image" data-background="<?= base_url('assets/') ?>stisla-assets/img/unsplash/admin.jpg">
                <div class=" hero-inner">
                    <h1>Selamat Datang, <?php echo $this->session->userdata('nama'); ?>!</h1>
                    <p class="lead">Anda dapat melihat data siswa disini</p>
                    <div class="mt-4">
                        <a href="<?= base_url('admin/data_siswa') ?>" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i>
                            Data User</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
$this->load->view('admin/template_admin/footer');
?>