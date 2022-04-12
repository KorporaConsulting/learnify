 <!-- Start Navigation Bar -->
 <header class="header_area" style="background-color: white !important;">
     <div class="main_menu">
         <nav class="navbar navbar-expand-lg navbar-light">
             <div class="container">
                 <!-- Brand and toggle get grouped for better mobile display -->
                 <a class="navbar-brand logo_h" href="<?= base_url('welcome') ?>"><img src="<?= base_url('assets/') ?>img/logo.png" alt=""></a>
                 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                 </button>
                 <!-- Collect the nav links, forms, and other content for toggling -->
                 <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                     <ul class="nav navbar-nav menu_nav ml-auto">
                         <li class="nav-item "><a class="nav-link" href="javascript:void(0)">Hai, <?php echo $this->session->userdata('nama'); ?></a>
                         </li>
                         <li class="nav-item active"><a class="nav-link" href="<?= base_url('user') ?>">Beranda</a>
                         </li>
                         <li class=" nav-item "><a class=" nav-link text-danger" href="<?= base_url('welcome/logout') ?>">Log Out</a>
                         </li>
                     </ul>
                 </div>
             </div>
         </nav>
     </div>
 </header>
 <!-- End Navigation Bar -->