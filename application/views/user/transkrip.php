<?php $this->load->view('user/template_user/header'); ?>
<style>
    .noBorder {
        border: none !important;
    }
</style>
<div class="container mt-5 pt-5 mb-5">
    <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
        <div class="row  justify-content-center align-items-center">
            <div class="col-md-12 ">
                <h3 class="text-center"><u style="color: black;">PENILAIAN</u></h3>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Ujian</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Tugas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Transkrip</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row mt-5 justify-content-center align-items-center">
                    <div class="col-md-12 ">
                        <div class="d-flex">
                            <!-- <a class="btn btn-sm btn-info justify-content-between mb-3" href="<?= base_url('user/detail_transkrip') ?>">Detail</a> -->
                            <!-- <a class="btn btn-sm btn-primary justify-content-between mb-3" href="<?= base_url('user/print_transkrip') ?>"><i class="fa fa-print"></i> Cetak</a> -->
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-center">
                                    <tr>
                                        <th>Nama Quiz</th>
                                        <th>Course</th>
                                        <th>Nilai Minimum</th>
                                        <th>Nilai tertinggi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php foreach ($ujian as $t) { ?>
                                        <tr>
                                            <td><?= $t->judul ?></td>
                                            <td><?= $t->nama_mapel ?></td>
                                            <td><?= $t->min_nilai ?></td>
                                            <td><?= $t->nilai_final ?></td>
                                            <?php
                                            if ($t->nilai_final < $t->min_nilai) { ?>
                                                <td><span class="badge badge-danger badge-lg">Tidak Lulus</span></td>
                                            <?php } else { ?>
                                                <td><span class="badge badge-success badge-lg">Lulus</span></td>
                                            <?php }
                                            ?>
                                        </tr>
                                    <?php  } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama File</th>
                            <th>Notes</th>
                            <th>File</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($tugas as $t) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $t->nama_file ?></td>
                                <td><?= $t->desk_file ?></td>
                                <td><a target="_blank" class="btn btn-primary" href="<?= base_url('user/download_file/') . $t->nama_file ?>" role="button">File</a></td>
                                <td>
                                    <?php
                                    if ($t->approve == 0) { ?>
                                        <span class="badge badge-warning">Menunggu diperiksa</span>
                                    <?php } else { ?>
                                        <span class="badge badge-success">Telah Diperiksa</span>
                                    <?php  } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="row mt-5 justify-content-center align-items-center">
                    <div class="col-md-12 ">
                        <div class="d-flex">
                            <!-- <a class="btn btn-sm btn-info justify-content-between mb-3" href="<?= base_url('user/detail_transkrip') ?>">Detail</a> -->
                            <a class="btn btn-sm btn-primary justify-content-between mb-3" href="<?= base_url('user/print_transkrip') ?>"><i class="fa fa-print"></i> Cetak</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-center">
                                    <tr>
                                        <th>Semester</th>
                                        <th>Kode Course</th>
                                        <th>Course</th>
                                        <th>Nilai</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php foreach ($transkrip as $t) { ?>
                                        <tr>
                                            <td scope="row"><?= $t->id_semester ?></td>
                                            <td><?= $t->kode_mapel ?></td>
                                            <td><?= $t->nama_mapel ?></td>
                                            <td><?= $t->nilai_final ?></td>
                                            <?php foreach ($mutu as $mu) { ?>
                                                <?php
                                                $pisah = explode("-", $mu->nilai);
                                                ?>
                                                <?php if ($t->nilai_final >= $pisah[0] && $t->nilai_final <= $pisah[1]) { ?>
                                                    <td><b style="color: black;"><?= $mu->mutu ?></b></td>
                                                <?php
                                                    break;
                                                } ?>
                                            <?php } ?>
                                        </tr>
                                    <?php  } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>