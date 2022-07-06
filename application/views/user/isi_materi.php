 <?php $this->load->view('user/template_user/header'); ?>


 <div class="container-fluid">
     <div class="row">
         <div class="col-6 mt-5">
             <h3><a href="<?= base_url('user/course/' . $file_row->slug_mapel) ?>" class="badge badge-info"><i class="fa fa-arrow-left"></i> Kembali ke List Materi</a></h3>
         </div>
         <div class="col-6 mt-5  text-right">
             <?php
                if ($status_materi->status != 1) { ?>
                 <h3><a href="<?= base_url('user/mark/' . $materi->id_mapel . '/' . $this->uri->segment(4)) ?>" class="badge badge-primary"><i class="fa fa-check"></i> MARK AS COMPLETE</a></h3>
             <?php } ?>
         </div>
     </div>
     <div class="row mt-4">
         <div class="col-md-3 mt-5 mb-4 d-none d-lg-block overflow-auto " style="max-height:100vh ;">
             <?php
                $no = 1;
                foreach ($side_materi as $m) { ?>
                 <div class="list-group">
                     <a href="<?= base_url('user/materi/' . $m->id_mapel . '/' . $m->slug_materi) ?>">
                         <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos-duration="1400" border-radius:10px; <?= ($m->slug_materi == $this->uri->segment(4)) ? 'style="border-color: #1bdbde; border: 5px solid;"' : ""  ?>>
                             <div class="row" style="color: black; font-family: 'poppins';">
                                 <div class="col-md-12 mt-1">
                                     <h2><?php if ($m->status == 0) { ?>
                                             <i class="fa fa-circle-thin float-right" style="color:green"></i>
                                             <!-- <span class="badge badge-warning badge-pill float-right">Belum selesai</span> -->
                                         <?php } elseif ($m->status == 1) { ?>
                                             <i class="fa fa-check-circle float-right" title="Selesai" style="color:green"></i>
                                             <!-- <span class="badge badge-primary badge-pill float-right">Selesai</span> -->
                                         <?php } ?>
                                     </h2>
                                     <h5 class="display-5" style="color: black; font-family:'poppins';" data-aos-duration="1400"><?= $m->nama_materi ?>
                                     </h5>
                                     <p><?= $m->desk_materi ?></p>
                                 </div>
                             </div>
                         </div>
                     </a>
                 </div>
             <?php } ?>
         </div>
         <div class="col-md-9 w-150 mb-4">
             <div class="card materi mt-2 border-0">
                 <?php
                    if ($file_row->id_file == null && $quiz_row->id_soal == null && $video->id_video == null && $tugas_row->id_tugas == null && $zoom_row == null) { ?>
                     <div class="jumbotron mt-5 mb-5 pt-5 pb-5">
                         <img src="<?= base_url('assets/') ?>img/sad.svg" width="300px" class="img-fluid" alt="Responsive image">
                         <h1 class="display-4">Belum tersedia!</h1>
                         <p class="lead">Mohon maaf materi yang anda akses belum teredia</p>
                         <hr class="my-4">
                         <p></p>
                         <!-- <p class="lead">
                             <a class="btn btn-primary btn-lg" href="#" onclick="history.back()">Kembali</a>
                         </p> -->
                     </div>
                     <?php if ($urutan_materi->urutan != 0 || $urutan_materi->urutan != 1) { ?>
                         <div class="row">
                             <div class="col-6">
                                 <?php if (isset($previous)) { ?>
                                     <a href="<?= base_url('user/materi/' . $this->uri->segment(3) . '/' . $previous->slug_materi) ?>" class="float-left"> <i class="fa fa-arrow-left"></i> Sebelumnya</a>
                                 <?php } ?>
                             </div>
                             <div class="col-6">
                                 <?php if (isset($next)) { ?>
                                     <a href="<?= base_url('user/materi/' . $this->uri->segment(3) . '/' . $next->slug_materi) ?>" class="float-right">Berikutnya <i class="fa fa-arrow-right"></i></a>
                                 <?php } ?>
                             </div>
                         </div>
                     <?php } ?>
                 <?php } elseif ($video->id_video != null) { ?>
                     <style>
                         .ytp-title-channel {
                             display: none !important;
                         }
                     </style>
                     <div class=" card-body p-5">
                         <div class="card shadow bg-white mx-auto p-2 buat-text" data-aos-duration="400" style="width: 100%; border-radius:15px;">
                             <h3 class="card-title display-5"><?= $video->nama_video ?></h3>
                             <hr style="background-color: white;">
                             <div class="plyr__video-embed" id="player">
                                 <!-- <div class="embed-responsive embed-responsive-16by9" id="player"> -->
                                 <!-- <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="<? $video->link ?>"></div> -->
                                 <iframe allowfullscreen allowtransparency allow="autoplay" class="embed-responsive-item" <?php if ($video->video == null) { ?> src="https://www.youtube.com/embed/<?= $video->link ?>" <?php } else { ?>src="<?= base_url('assets/materi_video/' . $video->video) ?>" <?php } ?>></iframe>
                                 <!-- </div> -->
                             </div>
                             <div class="text-center mt-2">
                                 <h5><?= $video->nama_video ?></h5>
                                 <p><?= $video->desk_video ?></p>
                             </div>
                         </div>
                     </div>
                     <?php if ($urutan_materi->urutan != 0 || $urutan_materi->urutan != 1) { ?>
                         <div class="row">
                             <div class="col-6">
                                 <?php if (isset($previous)) { ?>
                                     <a href="<?= base_url('user/materi/' . $this->uri->segment(3) . '/' . $previous->slug_materi) ?>" class="float-left"> <i class="fa fa-arrow-left"></i> Sebelumnya</a>
                                 <?php } ?>
                             </div>
                             <div class="col-6">
                                 <?php if (isset($next)) { ?>
                                     <a href="<?= base_url('user/materi/' . $this->uri->segment(3) . '/' . $next->slug_materi) ?>" class="float-right">Berikutnya <i class="fa fa-arrow-right"></i></a>
                                 <?php } ?>
                             </div>
                         </div>
                     <?php } ?>
                 <?php } elseif ($file_row->is_tugas == 0 && $file_row->id_file != null) { ?>
                     <div class="card shadow bg-white mx-auto p-2 buat-text" data-aos-duration="400" style="width: 100%; border-radius:15px;">
                         <div class="jumbotron jumbotron-fluid" style="background: url(<?= base_url('assets/img/modul.jpg') ?>) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
                             <div class="container">
                                 <h1 class="display-4" style="color: black ;">Download Modul</h1>
                                 <p class="lead" style="color: black ;">Silahkan download modul dibawah ini.</p>
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
                             <?php if ($urutan_materi->urutan != 0 || $urutan_materi->urutan != 1) { ?>
                                 <div class="row mt-5 pt-5 pb-5 mb-5">
                                     <div class="col-6">
                                         <?php if (isset($previous)) { ?>
                                             <a href="<?= base_url('user/materi/' . $this->uri->segment(3) . '/' . $previous->slug_materi) ?>" class="float-left"> <i class="fa fa-arrow-left"></i> Sebelumnya</a>
                                         <?php } ?>
                                     </div>
                                     <div class="col-6">
                                         <?php if (isset($next)) { ?>
                                             <a href="<?= base_url('user/materi/' . $this->uri->segment(3) . '/' . $next->slug_materi) ?>" class="float-right">Berikutnya <i class="fa fa-arrow-right"></i></a>
                                         <?php } ?>
                                     </div>
                                 </div>
                             <?php } ?>
                         </div>
                     </div>
                 <?php } elseif ($quiz_row->id_soal != null) {
                        redirect('user/quiz/' . $materi->id_materi . '/' . $quiz_row->id_quiz)
                    ?>
                 <?php } elseif ($list_tugas_row != null) { ?>
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
                         <div class="card shadow bg-white mx-auto p-4 buat-text mt-3" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                             <div class="container">
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
                                                                 <td><a target="_blank" class="btn btn-primary" href="<?= base_url('user/download_file/') . $t->nama_file ?>" role="button">File</a></td>
                                                                 <td>
                                                                     <?php
                                                                        if ($t->approve == 0) { ?>
                                                                         <span class="badge badge-warning">Menunggu diperiksa</span>
                                                                     <?php } else { ?>
                                                                         <span class="badge badge-success">Telah Diperiksa</span>
                                                                     <?php  } ?>
                                                                 </td>
                                                                 <td>
                                                                     <?php
                                                                        if ($t->approve == 0) { ?>
                                                                         <a href="#" class="btn btn-danger" onclick="confirm('<?= base_url('user/hapus_tugas/' . $t->id_file . '/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)) ?>')">Hapus</a>
                                                                     <?php } else { ?>
                                                                         <a href="#" class="btn btn-danger disabled" onclick="confirm('<?= base_url('user/hapus_tugas/' . $t->id_file . '/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)) ?>')">Hapus</a>
                                                                     <?php  } ?>
                                                                 </td>
                                                             </tr>
                                                         <?php } ?>
                                                     </tbody>
                                                 </table>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     <?php } ?>
                 <?php } elseif ($zoom_row != null) { ?>
                     <div class="card shadow bg-white mx-auto p-2 buat-text" data-aos-duration="400" style="width: 100%; border-radius:15px;">
                         <div class="jumbotron jumbotron-fluid" style="background: url(<?= base_url('assets/img/zoom.jpg') ?>) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
                             <div class="container">
                                 <h1 class="display-4" style="color: white;">Link Zoom Live kelas</h1>
                                 <p class="lead"><b><?= $zoom_row->nama_file ?></b></p>
                             </div>
                         </div>
                         <div class="card-body p-5">
                             <h4 class="card-title display-5"><?= $zoom_row->desk_file ?></h4>
                             <hr style="background-color: white;">
                             <div class="btn btn-block">
                                 <a href="<?= $zoom_row->link ?>" target="_blank" class="btn btn-icon btn-lg btn-primary float-center">Memulai Kelas Live</a>
                             </div>

                             <?php if ($urutan_materi->urutan != 0 || $urutan_materi->urutan != 1) { ?>
                                 <div class="row mt-5 pt-5 pb-5 mb-5">
                                     <div class="col-6">
                                         <?php if (isset($previous)) { ?>
                                             <a href="<?= base_url('user/materi/' . $this->uri->segment(3) . '/' . $previous->slug_materi) ?>" class="float-left"> <i class="fa fa-arrow-left"></i> Sebelumnya</a>
                                         <?php } ?>
                                     </div>
                                     <div class="col-6">
                                         <?php if (isset($next)) { ?>
                                             <a href="<?= base_url('user/materi/' . $this->uri->segment(3) . '/' . $next->slug_materi) ?>" class="float-right">Berikutnya <i class="fa fa-arrow-right"></i></a>
                                         <?php } ?>
                                     </div>
                                 </div>
                             <?php } ?>
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
                     <?php  }  ?>
                     <?php if ($urutan_materi->urutan != 0 || $urutan_materi->urutan != 1) { ?>
                         <div class="row">
                             <div class="col-6">
                                 <?php if (isset($previous)) { ?>
                                     <a href="<?= base_url('user/materi/' . $this->uri->segment(3) . '/' . $previous->slug_materi) ?>" class="float-left"> <i class="fa fa-arrow-left"></i> Sebelumnya</a>
                                 <?php } ?>
                             </div>
                             <div class="col-6">
                                 <?php if (isset($next)) { ?>
                                     <a href="<?= base_url('user/materi/' . $this->uri->segment(3) . '/' . $next->slug_materi) ?>" class="float-right">Berikutnya <i class="fa fa-arrow-right"></i></a>
                                 <?php } ?>
                             </div>
                         </div>
                     <?php } ?>
                 <?php } ?>
             </div>

         </div>
     </div>
 </div>
 <script>
     <?php if ($this->session->flashdata('sukses-tugas')) : ?>
         Swal.fire({
             icon: 'success',
             title: 'Berhasil!',
             text: '<?php echo $this->session->flashdata('sukses-tugas'); ?>',
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
 <script>
     function confirm(link) {
         //  console.log(link)
         Swal.fire({
             title: 'Apakah Anda yakin?',
             text: "File yang terhapus tidak akan bisa kembali",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
             if (result.value) {
                 window.location.href = link
             }
         })
     }
 </script>
 <!-- End Lesson Cards -->
 <?php $this->load->view('user/template_user/footer'); ?>