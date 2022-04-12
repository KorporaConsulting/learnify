 <?php $this->load->view('user/template_user/header'); ?>
 <?php $this->load->view('user/template_user/navbar'); ?>

 <!-- Start Greeting Cards -->

 <!-- End Greeting Cards -->


 <!-- Start Lesson Cards -->
 <div class="container">
     <div class="row mt-4">
         <div class="col-md-12 w-150 mb-4">
             <div class="card materi border-0">
                 <div class="card-body p-5">
                     <h1 class="card-title display-4"><?= $detail->nama_guru; ?></h1>
                     <hr style="background-color: white;">
                     <h5 class="card-text"><?= $detail->nama_mapel; ?></h5>
                     <p class="card-text"> Deskripsi materi pelajaran : <br> <?= $detail->deskripsi; ?></p>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- End Lesson Cards -->
 <?php $this->load->view('user/template_user/footer'); ?>