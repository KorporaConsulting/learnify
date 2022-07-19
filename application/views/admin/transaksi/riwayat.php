<?php
$this->load->view('admin/template_admin/header');
$this->load->view('admin/template_admin/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Init Date</th>
                        <th>Update Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $key =>  $t) : ?>
                        <?php 
                            $initDate = date_create($t->created_at);
                            $initDate = date_format($initDate, 'Y-m-d');
                            if($t->updated_at){
                                $updateDate = date_create($t->updated_at);
                                $updateDate = date_format($updateDate, 'Y-m-d');
                            }else{
                                 $updateDate = '<span class="badge badge-danger">Tidak ada</span>';
                            }        
                        ?>
                        <tr>
                            <th><?= $key+1 ?></th>
                            <th><?= $t->nama ?></th>
                            <th>
                                <?php if ($t->status == 'pending') : ?>
                                    <span class="badge badge-warning"><?= $t->status ?></span>
                                <?php elseif ($t->status == 'success') : ?>
                                    <span class="badge badge-success"><?= $t->status ?></span>
                                <?php else : ?>
                                    <span class="badge badge-danger"><?= $t->status ?></span>
                                <?php endif; ?>
                            </th>
                            <th><?= $initDate ?></th>
                            <th><?= $updateDate ?></th>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End Main Content -->



<?php
$this->load->view('admin/template_admin/footer');
?>