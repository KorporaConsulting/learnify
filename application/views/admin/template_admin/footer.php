 <!-- Start Footer -->
 <footer class="main-footer">
     <div class="text-center">
         Copyright &copy; 2022 <div class="bullet"></div><a href="https://korporaconsulting.com/">Korpora Consulting</a>
     </div>
 </footer>
 <!-- End Footer -->

 </div>
 </div>
 <!-- End Main Content -->

 <!-- General JS Scripts -->
    <?php if($this->session->flashdata('success')): ?>
        <script>
            Swal.fire('Berhasil', '<?= $this->session->flashdata('success') ?>', 'success');
        </script>
    <?php endif; ?>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
 </script>
 <script>
     $('.custom-file-input').on('change', function() {
         let fileName = $(this).val().split('\\').pop();
         $(this).next('.custom-file-label').addClass("selected").html(fileName);
     });
 </script>
 <!-- <script src="<?= base_url('assets/') ?>/modules/bootstrap-daterangepicker/daterangepicker.js"></script> -->
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
 </script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
 <script src="<?= base_url('assets/') ?>stisla-assets/js/stisla.js"></script>
 <!-- JS Libraies -->
 <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
 <script>
     $(document).ready(function() {
         $('#example').DataTable();
     });
 </script>
 <!-- Template JS File -->
 <script src="<?= base_url('assets/') ?>stisla-assets/js/scripts.js"></script>
 <script src="<?= base_url('assets/') ?>stisla-assets/js/custom.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
 </body>

 </html>