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
                <h3 class="text-center"><u style="color: black;">JADWAL KELAS LIVE</u></h3>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
        <div class="d-flex">
            <!-- <a class="btn btn-sm btn-info justify-content-between mb-3" href="<?= base_url('user/detail_transkrip') ?>">Detail</a> -->
            <a class="btn btn-sm btn-primary justify-content-between mb-3" href="<?= base_url('user/print_jadwal') ?>"><i class="fa fa-print"></i> Cetak</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Topik</th>
                        <th>Mentor</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $no = 1;
                    foreach ($jadwal as $t) {
                        $mulai = date_create($t->tgl_mulai);
                        $selesai = date_create($t->tgl_selesai);
                    ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $t->nama_file ?></td>
                            <td><?= $t->nama_guru ?></td>
                            <td><b style="color: black;"> <?= date_format($mulai, 'd F Y H:i')  ?></b></td>
                            <td><b style="color: black;"><?= date_format($selesai, 'd F Y H:i') ?></b></td>
                            <td>
                                <?php
                                if (strtotime(date('Y-m-d H:i:s')) >= strtotime(date_format($mulai, 'Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) <= strtotime(date_format($selesai, 'Y-m-d H:i:s'))) { ?>
                                    <span class="badge badge-success">
                                        <h6>Sedang Berlangsung</h6>
                                    </span>
                                <?php  } elseif (strtotime(date('Y-m-d H:i:s')) >= strtotime(date_format($mulai, 'Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) >= strtotime(date_format($selesai, 'Y-m-d H:i:s'))) { ?>
                                    <span class="badge badge-danger">
                                        <h6>Berakhir</h6>
                                    </span>
                                <?php  } elseif (strtotime(date('Y-m-d H:i:s')) <= strtotime(date_format($mulai, 'Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) <= strtotime(date_format($selesai, 'Y-m-d H:i:s'))) { ?>
                                    <span class="badge badge-info">
                                        <h6>Terjadwal</h6>
                                    </span>
                                <?php  }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (strtotime(date('Y-m-d H:i:s')) >= strtotime(date_format($mulai, 'Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) <= strtotime(date_format($selesai, 'Y-m-d H:i:s'))) { ?>
                                    <a class="btn btn-info" href="<?= base_url('user/course/' . $t->slug_mapel) ?>">Gabung Kelas</a>
                                <?php  } elseif (strtotime(date('Y-m-d H:i:s')) >= strtotime(date_format($mulai, 'Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) >= strtotime(date_format($selesai, 'Y-m-d H:i:s'))) { ?>
                                    <a class="btn btn-info disabled" href="<?= base_url('user/course/' . $t->slug_mapel) ?>">Gabung Kelas</a>
                                <?php  } elseif (strtotime(date('Y-m-d H:i:s')) <= strtotime(date_format($mulai, 'Y-m-d H:i:s')) && strtotime(date('Y-m-d H:i:s')) <= strtotime(date_format($selesai, 'Y-m-d H:i:s'))) { ?>
                                    <a class="btn btn-info" href="<?= base_url('user/course/' . $t->slug_mapel) ?>">Gabung Kelas</a>
                                <?php  }
                                ?>
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