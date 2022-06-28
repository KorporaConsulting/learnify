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
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Semester</th>
                                <th>Kode Course</th>
                                <th>Course</th>
                                <th>Nilai</th>
                                <th>Mutu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>