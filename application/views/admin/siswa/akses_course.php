<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Status Course <?= $profile->nama ?></h2>
                <hr>
                <!-- <p class="card-text"> After I ran into Helen at a restaurant, I realized she was just office pretty drop-dead date put in in a deck for our standup today. Who's responsible for the ask for this request? who's responsible for the ask for this request? but moving the goalposts gain traction. </p> -->
                <a href="<?= base_url('admin/akses_siswa') ?>" class="btn btn-info">Kembali </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                    <div class="table-responsive">
                        <table id="example" class="table align-items-center table-flush">
                            <thead class="thead-light text-center">
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Course</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($user as $u) {
                                ?>
                                    <tr class="text-center">
                                        <th scope="row">
                                            <?php echo $no++ ?>
                                        </th>

                                        <td>
                                            <?php echo $u->nama_mapel ?>
                                        </td>

                                        <td>
                                            <?php if ($u->status == 0 && $u->kunci == 0) { ?>
                                                <span class="badge badge-light"><i class="fa fa-lock float-right" title="Terkunci" style="color:red"></i></span>
                                                <!-- <span class="badge badge-light badge-pill float-right">Belum selesai</span> -->
                                            <?php } elseif ($u->status == 1 && $u->kunci == 1) { ?>
                                                <span class="badge badge-light"> <i class="fa fa-check-circle float-right" title="Selesai" style="color:#33b5e5"></i></span>
                                                <!-- <span class="badge badge-primary badge-pill float-right">Selesai</span> -->
                                            <?php } elseif ($u->status == 0 && $u->kunci == 1) { ?>
                                                <span class="badge badge-warning" style="color: black;">Sedang dipelajari</span>
                                            <?php } ?>
                                        </td>

                                        <td class="text-center">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <?php if ($u->status == 0 && $u->kunci == 0) { ?>
                                                        <a id="confirmation" href="<?php echo site_url('admin/buka_akses/' . $u->id_user . '/' . $u->id_mapel); ?>" class="btn btn-success">Buka Akses ⭢</a>

                                                        <!-- <span class="badge badge-warning badge-pill float-right">Belum selesai</span> -->
                                                    <?php } elseif ($u->status == 1 && $u->kunci == 1) { ?>

                                                        <a id="confirmation" href="<?php echo site_url('admin/tutup_akses/' . $u->id_user . '/' . $u->id_mapel); ?>" class="btn btn-danger">Tutup Akses ⭢</a>
                                                    <?php } elseif ($u->status == 0 && $u->kunci == 1) { ?>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <a id="confirmation" href="<?php echo site_url('admin/selesai_akses/' . $u->id_user . '/' . $u->id_mapel); ?>" class="btn btn-primary">Selesai Akses ⭢</a>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <a id="confirmation" href="<?php echo site_url('admin/tutup_akses/' . $u->id_user . '/' . $u->id_mapel); ?>" class="btn btn-danger">Tutup Akses ⭢</a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <a id="confirmation" href="<?php echo site_url('admin/akses_materi_user/' . $u->id_user . '/' . $u->id_mapel); ?>" class="btn btn-primary">Materi ⭢</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</div>
<!-- End Main Content -->

<!-- Start Sweetalert -->
<?php if ($this->session->flashdata('success-buka')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Akses Terbuka!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('success-selesai')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Akses Selesai!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('success-tutup')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Akses Tertutup!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>


<!-- End Sweetalert -->
<script type="text/javascript">
    $('#confirmation').click(function(e) {
        e.preventDefault(); // Prevent the href from redirecting directly
        var linkURL = $(this).attr("href");
        warnBeforeRedirect(linkURL);
    });

    function warnBeforeRedirect(linkURL) {
        Swal.fire({
            title: "Ingin mengubah akses?",
            text: "Jika klik 'OK', Akses akan berubah",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            console.log(result)
            if (result.value) {
                window.location.href = linkURL;
            }
        });
    }
</script>


<?php
$this->load->view('admin/template_admin/footer');
?>