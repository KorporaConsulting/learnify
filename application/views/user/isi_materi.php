 <?php $this->load->view('user/template_user/header'); ?>


 <!-- Start Greeting Cards -->

 <!-- End Greeting Cards -->


 <!-- Start Lesson Cards -->
 <!-- <div class="container">
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
 </div> -->

 <div class="container">
     <div class="row mt-4">
         <div class="col-md-12 w-150 mb-4">
             <div class="card materi border-0">
                 <?php
                    if ($file_row->id_file == null && $quiz_row->id_soal == null && $video->id_video == null) { ?>
                     <div class="jumbotron mt-5 mb-5 pt-5 pb-5">
                         <img src="<?= base_url('assets/') ?>img/sad.svg" width="300px" class="img-fluid" alt="Responsive image">
                         <h1 class="display-4">Belum tersedia!</h1>
                         <p class="lead">Mohon maaf materi yang anda akses belum teredia</p>
                         <hr class="my-4">
                         <p></p>
                         <p class="lead">
                             <a class="btn btn-primary btn-lg" href="#" onclick="history.back()">Kembali</a>
                         </p>
                     </div>
                 <?php } elseif ($file_row->id_file == null && $quiz_row->id_soal == null) { ?>
                     <div class=" card-body p-5">
                         <?php
                            if ($status_materi->status != 1) { ?>
                             <div class="text-right">
                                 <a href="<?= base_url('user/mark/' . $materi->id_mapel . '/' . $this->uri->segment(3)) ?>" class="btn btn-primary"><i class="fa fa-check"></i> MARK AS COMPLETE</a>
                             </div>
                         <?php } ?>
                         <h3 class="card-title display-5"><?= $video->nama_video ?></h3>
                         <hr style="background-color: white;">

                         <!-- <div class="plyr__video-embed" id="player">
                             <iframe src="https://www.youtube.com/embed/bTqVqk7FSmY?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
                         </div> -->

                         <div class="embed-responsive embed-responsive-16by9 plyr__video-embed" id="player">
                             <iframe class="embed-responsive-item" <?php if ($video->video == null) { ?> src="https://www.youtube.com/embed/<?= $video->link ?>" <?php } else { ?>src="<?= base_url('assets/materi_video/' . $video->video) ?>" <?php } ?>></iframe>
                         </div>
                         <div class="text-center mt-2">
                             <h5><?= $video->nama_video ?></h5>
                             <p><?= $video->desk_video ?></p>
                         </div>
                     </div>
                 <?php } elseif ($video->id_video == null && $quiz_row->id_soal == null) { ?>
                     <div class="jumbotron jumbotron-fluid">
                         <div class="container">
                             <h1 class="display-4">Download Modul</h1>
                             <p class="lead">Silahkan download modul dibawah ini.</p>
                             <?php
                                if ($status_materi->status != 1) { ?>
                                 <div class="text-right">
                                     <a href="<?= base_url('user/mark/' . $materi->id_mapel . '/' . $this->uri->segment(3)) ?>" class="btn btn-primary"><i class="fa fa-check"></i> MARK AS COMPLETE</a>
                                 </div>
                             <?php } ?>
                         </div>
                     </div>
                     <div class="card-body p-5">
                         <h4 class="card-title display-5">Modul</h4>
                         <hr style="background-color: white;">
                         <div class="row">
                             <?php foreach ($file as $files) { ?>
                                 <div class="col-md-4 mb-4">
                                     <a href="<?php echo $files->link ?>" target="_blank" class="btn btn-icon btn-lg btn-primary float-center"><i class="fa fa-download"></i> Modul <?= $files->nama_file ?></a>
                                 </div>
                             <?php } ?>
                         </div>
                     </div>

                 <?php } elseif ($video->id_video == null && $file_row->id_file == null) { ?>
                     <div class="card-body p-5">
                         <h4 class="card-title display-5">Test</h4>
                         <hr style="background-color: white;">
                     </div>
                     <div class="container">
                         <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
                             <div class="row" style="color: black; font-family: 'poppins';">
                                 <div class="col-md-12 mt-1">
                                     <div class="card-body p-5">
                                         <div class="col-md-12 column">
                                             <p class="lead">Completo al 40%</p>
                                             <div class="progress">
                                                 <div class="progress-bar" role="progressbar" style="width: 40%;">
                                                     <span class="sr-only">Completo al 40%</span>
                                                 </div>
                                             </div>
                                             <div class="panel panel-primary">
                                                 <div class="panel-heading">
                                                     <h3 class="panel-title">
                                                         Domanda
                                                     </h3>
                                                 </div>
                                                 <div class="panel-body">
                                                     <div class="radio">
                                                         <label>
                                                             <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked=""> Questa è la risposta uno. Fossi in te, la lascerei perdere
                                                         </label>
                                                     </div>
                                                     <div class="radio">
                                                         <label>
                                                             <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"> Forse la due si avvicina... ma non ci giurerei
                                                         </label>
                                                     </div>
                                                     <div class="radio">
                                                         <label>
                                                             <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3"> Opzione tre — da' retta, è questa
                                                         </label>
                                                     </div>
                                                     <div class="radio">
                                                         <label>
                                                             <input type="radio" name="optionsRadios" id="optionsRadios4" value="option4"> Sulla risposta quattro non ci metterei la mano sul fuoco...
                                                         </label>
                                                     </div>

                                                 </div>
                                                 <div class="panel-footer">
                                                     <a href="#" class="btn btn-primary " role="button">Conferma</a>
                                                     <a href="#" class="btn btn-default disabled" role="button">Avanti</a>
                                                 </div>
                                             </div>
                                             <div class="col-md-1 column">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>

                 <?php } ?>

             </div>
         </div>
     </div>
 </div>

 <!-- End Lesson Cards -->
 <?php $this->load->view('user/template_user/footer'); ?>