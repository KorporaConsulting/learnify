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
                     <h1 class="card-title display-4"><?= $isi_materi->nama_materi; ?></h1>
                     <hr style="background-color: white;">
                     <p class="card-text"><?= $isi_materi->desk_materi; ?></p>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="container">
     <div class="row mt-4">
         <div class="col-md-12 w-150 mb-4">
             <div class="card materi border-0">
                 <div class="card-body p-5">
                     <h4 class="card-title display-5">Modul</h4>
                     <hr style="background-color: white;">
                     <a href="#" class="btn btn-icon btn-lg btn-success float-center"><i class="fa fa-download"></i> Download Modul</a>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="container">
     <div class="row mt-4">
         <div class="col-md-12 w-150 mb-4">
             <div class="card materi border-0">
                 <div class="card-body p-5">
                     <h4 class="card-title display-5">Video</h4>
                     <hr style="background-color: white;">
                     <div class="embed-responsive embed-responsive-4by3">
                         <iframe class="embed-responsive-item" <?php if ($isi_materi->video == null) { ?> src="https://www.youtube.com/embed/<?= $isi_materi->link ?>" <?php } else { ?>src="<?= base_url('assets/materi_video/' . $isi_materi->video) ?>" <?php } ?>></iframe>
                     </div>
                     <div class="text-center mt-2">
                         <h5><?= $isi_materi->nama_video ?></h5>
                         <p><?= $isi_materi->desk_video ?></p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="container">
     <div class="row mt-4">
         <div class="col-md-12 w-150 mb-4">
             <div class="card materi border-0">
                 <div class="card-body p-5">
                     <h4 class="card-title display-5">Quiz</h4>
                     <hr style="background-color: white;">
                     <div class="embed-responsive embed-responsive-4by3">
                         <iframe class="embed-responsive-item" <?php if ($isi_materi->video == null) { ?> src="https://www.youtube.com/embed/<?= $isi_materi->link ?>" <?php } else { ?>src="<?= base_url('assets/materi_video/' . $isi_materi->video) ?>" <?php } ?>></iframe>
                     </div>
                     <div class="text-center mt-2 mb-4">
                         <h5><?= $isi_materi->nama_video ?></h5>
                         <p><?= $isi_materi->desk_video ?></p>
                     </div>
                     <a href="" class="btn btn-success text-right">Lanjut Ke Quiz</a>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- <div class="container">
     <div class="row-mt-4">
     </div>
 </div> -->

 <!-- End Lesson Cards -->
 <?php $this->load->view('user/template_user/footer'); ?>