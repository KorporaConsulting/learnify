<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Management Semester Sales University</h2>
                <hr>
                <!-- <p class="card-text"> After I ran into Helen at a restaurant, I realized she was just office pretty drop-dead date put in in a deck for our standup today. Who's responsible for the ask for this request? who's responsible for the ask for this request? but moving the goalposts gain traction. </p> -->
                <a href="<?= base_url('admin/add_semester') ?>" class="btn btn-success">Tambah
                    Data Semester ⭢ </a>
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
                                    <th scope="col">Semester</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($semester as $u) {
                                ?>
                                    <tr class="text-center">

                                        <th scope="row">
                                            <?php echo $no++ ?>
                                        </th>

                                        <td>
                                            <?php echo $u->semester ?>
                                        </td>

                                        <td>
                                            <img height="80px" src="<?= base_url() . 'assets/img/' . $u->image_semester; ?>">
                                        </td>

                                        <td class="text-center">
                                            <a href="<?php echo site_url('admin/update_semester/' . $u->id_semester); ?>" class="btn btn-info">Update ⭢</a>

                                            <a onclick="yourConfirm(<?= $u->id_semester ?>);" href="javascript:void(0);" class="btn btn-danger">Delete ✖</a>
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
            title: 'Data Semester Berhasil Ditambah!',
            text: 'Selamat data bertambah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('success-edit')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Semester Telah Dirubah!',
            text: 'Selamat data berubah!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('semester-delete')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data Semester Telah Dihapus!',
            text: 'Selamat data telah Dihapus!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<!-- End Sweetalert -->

<script type="text/javascript">
    function yourConfirm(id) {
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
                window.location = "<?= base_url('admin/delete_semester/') ?>" + id;
            }
        })
    }
</script>

<?php
$this->load->view('admin/template_admin/footer');
?>