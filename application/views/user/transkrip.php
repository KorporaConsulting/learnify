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
                <h3 class="text-center"><u style="color: black;">TRANSKRIP PRESTASI NILAI</u></h3>
            </div>
        </div>
    </div>
</div>
<!-- Start Class Card -->
<div class="container">
    <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
        <div class="row mt-5">
            <div class="col-md-3 text-center">
                <img class="rounded-circle" width="200px" alt="100x100" src="<?= base_url('assets/profile_picture/') . $user->image_user ?>" data-holder-rendered="true">
            </div>
            <div class="col-md-9">
                <table class="table">
                    <tbody>
                        <tr>
                            <td scope="row" class="noBorder text-center">Nama</td>
                            <td class="noBorder"> : </td>
                            <td class="noBorder"><?= $user->nama ?> </td>
                        </tr>
                        <tr>
                            <td scope="row" class="noBorder text-center">NIS</td>
                            <td class="noBorder"> : </td>
                            <td class="noBorder"><?= $user->nis ?></td>
                        </tr>
                        <tr>
                            <td scope="row" class="noBorder text-center">Tanggal Lahir</td>
                            <td class="noBorder"> : </td>
                            <td class="noBorder"><?= $user->ttl ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-5 justify-content-center align-items-center">
            <div class="col-md-12 ">
                <a class="btn btn-sm btn-info float-right mb-3" href="<?= base_url('user/detail_transkrip') ?>">Detail</a>
                <a class="btn btn-sm btn-primary float-left mb-3" href="<?= base_url('user/print_transkrip') ?>"><i class="fa fa-print"></i> Cetak</a>
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



<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>