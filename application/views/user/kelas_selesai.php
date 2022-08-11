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
                <h3 class="text-center"><u style="color: black;">Kelas yang berhasil Anda selesaikan</u></h3>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
        <div class="d-flex">
            <!-- <a class="btn btn-sm btn-info justify-content-between mb-3" href="<?= base_url('user/detail_transkrip') ?>">Detail</a> -->
            <!-- <a class="btn btn-sm btn-primary justify-content-between mb-3" href="<?= base_url('user/print_jadwal') ?>"><i class="fa fa-print"></i> Cetak</a> -->
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Course</th>
                        <!-- <th>Mentor</th> -->
                        <th>Status</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $no = 1;
                    foreach ($kelas_selesai as $t) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $t->nama_mapel ?></td>
                            <!-- <td><?= $t->nama_guru ?></td> -->
                            <td>
                                <?php if ($t->status == 0 && $t->kunci == 0) { ?>
                                    <i class="fa fa-lock float-right" title="Terkunci" style="color:red"></i>
                                    <!-- <span class="badge badge-warning badge-pill float-right">Belum selesai</span> -->
                                <?php } elseif ($t->status == 1 && $t->kunci == 1) { ?>
                                    <i class="fa fa-check-circle float-right" title="Selesai" style="color:#33b5e5"></i>
                                    <!-- <span class="badge badge-primary badge-pill float-right">Selesai</span> -->
                                <?php } elseif ($t->status == 0 && $t->kunci == 1) { ?>
                                    <i class="fa fa-circle-o float-right" title="Dikerjakan" style="color:green"></i>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($t->status == 0 && $t->kunci == 0) { ?>
                                    <a class="btn btn-info disabled" href="#">Lihat Course</a>
                                    <!-- <span class="badge badge-warning badge-pill float-right">Belum selesai</span> -->
                                <?php } else { ?>
                                    <a class="btn btn-info" href="<?= base_url('user/course/') . $t->slug_mapel ?>">Lihat Course</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>


<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>