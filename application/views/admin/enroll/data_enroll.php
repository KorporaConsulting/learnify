<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Management Enroll User</h2>
                <hr>
                <!-- <p class="card-text"> After I ran into Helen at a restaurant, I realized she was just office pretty drop-dead date put in in a deck for our standup today. Who's responsible for the ask for this request? who's responsible for the ask for this request? but moving the goalposts gain traction. </p> -->
                <a href="<?= base_url('admin/add_enroll') ?>" class="btn btn-success">Tambah
                    Enroll User ⭢ </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                    <div class="table-responsive">
                        <table id="example" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Course</th>
                                    <th scope="col">Nama User</th>
                                    <th scope="col">Semester</th>
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
                                            <b><?php echo $u->nama_mapel ?></b>
                                        </td>

                                        <td>
                                            <b><?php echo $u->nama ?></b>
                                        </td>
                                        <td>
                                            <?php echo $u->semester ?>
                                        </td>
                                        <td class="text-center">
                                            <a onclick="deleteenroll(<?= $u->id_enroll ?>);" href="javascript:void(0);" class="btn btn-danger">Remove Enroll ✖</a>
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
<?php if ($this->session->flashdata('success-reg')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Course Berhasil Ditambah!',
            text: 'Selamat data bertambah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('enroll-delete')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Enroll Telah Dihapus!',
            text: 'Selamat data telah Dihapus!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<!-- End Sweetalert -->

<script type="text/javascript">
    function deleteenroll(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            console.log(result)
            if (result.value) {
                window.location = "<?= base_url('admin/delete_enroll/') ?>" + id;
            }
        })
    }
</script>

<?php
$this->load->view('admin/template_admin/footer');
?>