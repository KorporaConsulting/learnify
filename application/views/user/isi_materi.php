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
                    if ($file_row->id_file == null && $quiz_row->id_soal == null && $video->id_video == null && $tugas_row->id_tugas == null) { ?>
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
                 <?php } elseif ($file_row->id_file == null && $quiz_row->id_soal == null && $tugas_row->id_tugas == null) { ?>
                     <div class=" card-body p-5">
                         <?php
                            if ($status_materi->status != 1) { ?>
                             <div class="text-right">
                                 <a href="<?= base_url('user/mark/' . $materi->id_mapel . '/' . $this->uri->segment(4)) ?>" class="btn btn-primary"><i class="fa fa-check"></i> MARK AS COMPLETE</a>
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
                 <?php } elseif ($video->id_video == null && $quiz_row->id_soal == null && $tugas_row->id_tugas == null) { ?>
                     <div class="jumbotron jumbotron-fluid">
                         <div class="container">
                             <h1 class="display-4">Download Modul</h1>
                             <p class="lead">Silahkan download modul dibawah ini.</p>
                             <?php
                                if ($status_materi->status != 1) { ?>
                                 <div class="text-right">
                                     <a href="<?= base_url('user/mark/' . $materi->id_mapel . '/' . $this->uri->segment(4)) ?>" class="btn btn-primary"><i class="fa fa-check"></i> MARK AS COMPLETE</a>
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

                 <?php } elseif ($video->id_video == null && $file_row->id_file == null && $tugas_row->id_tugas == null) {
                        redirect('user/quiz/' . $materi->id_materi)
                    ?>
                     <!-- <div class="card-body p-5">
                         <h4 class="card-title display-5">Test</h4>
                         <hr style="background-color: white;">
                     </div>
                     <div class="container">
                         <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
                             <div class="row" style="color: black; font-family: 'poppins';">
                                 <div class="col-md-12 mt-1">
                                     <div class="card-body p-5">
                                         <div class="col-md-12 column">
                                             <div>
                                                 <a href="<?= site_url('user/quiz/' . $materi->id_materi) ?>" class="btn btn-primary">Mulai Quiz</a>
                                             </div>
                                             <div class="col-md-1 column">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div> -->

                 <?php } elseif ($video->id_video == null && $quiz_row->id_soal == null) { ?>
                     <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                         <div class="row" style="color: black; font-family: 'poppins';">
                             <div class="col-md-12 mt-1 text-center">
                                 <!-- <img class="rounded-circle" width="100px" alt="100x100" src="<?= base_url('assets/profile_picture/' . $this->session->userdata('image_user')) ?>" data-holder-rendered="true"> -->
                                 <h1 class="display-5" style="color: black; font-family:'poppins';" data-aos-duration="400">Tugas</h1>
                                 <!-- <h5><?= $this->session->userdata('nama') ?></h5> -->
                             </div>
                         </div>
                     </div>
                     <?php
                        if ($list_tugas_row != 0) { ?>
                         <!-- <div class="jumbotron jumbotron-fluid mt-4"> -->
                         <div class="card shadow bg-white mx-auto p-4 buat-text mt-3" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                             <div class="container">
                                 <!-- <h3><span class="badge badge-primary"> <?= $no++ ?> </span></h3> -->
                                 <h2 class="display-5" style="color: black ;"><?= $tugas_row->nama_tugas ?></h2>
                                 <p class="lead"><?= $tugas_row->desk_tugas ?></p>
                             </div>

                             <div class="row justify-content-center">
                                 <div class="col-md-12">
                                     <div class="row" style="color: black; font-family: 'poppins';">
                                         <div class="col-md-12 mt-1 text-center">
                                             <div class="table-responsive">
                                                 <table class="table">
                                                     <thead>
                                                         <tr>
                                                             <th>No</th>
                                                             <th>Nama File</th>
                                                             <th>Notes</th>
                                                             <th>File</th>
                                                             <th>Status</th>
                                                             <th>Action</th>
                                                         </tr>
                                                     </thead>
                                                     <tbody>
                                                         <?php
                                                            $no = 1;
                                                            foreach ($list_tugas as $t) { ?>
                                                             <tr>
                                                                 <td><?= $no++ ?></td>
                                                                 <td><?= $t->nama_file ?></td>
                                                                 <td><?= $t->desk_file ?></td>
                                                                 <td><a class="btn btn-primary" href="<?= $t->link ?>" role="button">File</a></td>
                                                                 <td>
                                                                     <?php
                                                                        if ($t->approve == 0) { ?>
                                                                         <span class="badge badge-warning">Menunggu diperiksa</span>
                                                                     <?php } else { ?>
                                                                         <span class="badge badge-success">Telah Diperiksa</span>
                                                                     <?php  } ?>
                                                                 </td>
                                                                 <td>
                                                                     <a class="btn btn-danger" href="<?= base_url('user/hapus_tugas/' . $t->id_file) ?>" role="button">Hapus</a>
                                                                 </td>
                                                             </tr>
                                                         <?php } ?>
                                                     </tbody>
                                                 </table>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- </div> -->
                             </div>
                         </div>
                     <?php  } else { ?>
                         <?php
                            $no = 1;
                            foreach ($tugas as $t) { ?>
                             <div class="card shadow bg-white mx-auto p-4 buat-text mt-3" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                                 <div class="container">
                                     <h1 class="display-5" style="color: black ;"><?= $t->nama_tugas ?></h1>
                                     <p class="lead"><?= $t->desk_tugas ?></p>
                                 </div>
                                 <div class="row mt-5 justify-content-center">
                                     <div class="col-md-10">
                                         <form method="post" action="<?= base_url('user/upload_tugas') ?>" enctype="multipart/form-data">
                                             <input type="hidden" name="id_mapel" value="<?= $t->id_mapel ?>">
                                             <input type="hidden" name="slug_materi" value="<?= $t->slug_materi ?>">
                                             <div class="form-group files">
                                                 <label>Upload Your File (Max 2 Mb)</label>
                                                 <input type="file" name="tugas[]" class="form-control" multiple>
                                             </div>
                                             <div class="form-group">
                                                 <label for="notes">Notes</label>
                                                 <textarea class="form-control" name="notes" id="notes" rows="3"></textarea>
                                             </div>
                                             <button type="submit" class="btn btn-primary float-right">Submit</button>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         <?php } ?>
                     <?php  }
                        ?>

                 <?php } ?>
             </div>

         </div>
     </div>
 </div>
 <!-- <div class="container">
     <div class="row-mt-4">
     </div>
 </div> -->
 <script>
     <?php if ($this->session->flashdata('sukses-tugas')) : ?>
         Swal.fire({
             icon: 'success',
             title: '<?php echo $this->session->flashdata('sukses-tugas'); ?>',
             text: 'Tugas berhasil diupload',
             showConfirmButton: false,
             timer: 2500
         })
     <?php endif; ?>
 </script>
 <script>
     <?php if ($this->session->flashdata('error-tugas')) : ?>
         Swal.fire({
             icon: 'error',
             title: 'Gagal!',
             text: '<?php echo $this->session->flashdata('error-tugas'); ?>',
             showConfirmButton: false,
             timer: 2500
         })
     <?php endif; ?>
 </script>
 <!-- End Lesson Cards -->
 <?php $this->load->view('user/template_user/footer'); ?>