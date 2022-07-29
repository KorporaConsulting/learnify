<br>
<script src="https://cdn.plyr.io/3.7.2/plyr.js"></script>
<!-- <script src="<?= base_url('assets/') ?>plyr/js/plyr.js"></script> -->
<script>
    const player = new Plyr('#player', {
        title: 'Example Title',
        clickToPlay: false,
        controls: [
            'play-large', // The large play button in the center
            // 'restart', // Restart playback
            // 'rewind', // Rewind by the seek time (default 10 seconds)
            'play', // Play/pause playback
            // 'fast-forward', // Fast forward by the seek time (default 10 seconds)
            'progress', // The progress bar and scrubber for playback and buffering
            // 'current-time', // The current time of playback
            'duration', // The full duration of the media
            'mute', // Toggle mute
            'volume', // Volume control
            // 'captions', // Toggle captions
            // 'settings', // Settings menu
            // 'pip', // Picture-in-picture (currently Safari only)
            // 'airplay', // Airplay (currently Safari only)
            // 'download', // Show a download button with a link to either the current source or a custom URL you specify in your options
            // 'fullscreen',
        ]
    });
    player.on('ended', event => {
        $.ajax({
            url: '<?= base_url('user/mark/' . $materi->id_mapel . '/' . $this->uri->segment(4)) ?>',
            method: 'POST',
            success: function(res) {
                location.reload();
                swal("Berhasil!", "Materi telah selesai!", "success");
            },
            error: function() {

            }
        })
    });
</script>
<script>
    const player = new Plyr('#rekaman', {
        title: 'Example Title',
        clickToPlay: false,
        controls: [
            'play-large', // The large play button in the center
            // 'restart', // Restart playback
            // 'rewind', // Rewind by the seek time (default 10 seconds)
            'play', // Play/pause playback
            // 'fast-forward', // Fast forward by the seek time (default 10 seconds)
            'progress', // The progress bar and scrubber for playback and buffering
            // 'current-time', // The current time of playback
            'duration', // The full duration of the media
            'mute', // Toggle mute
            'volume', // Volume control
            // 'captions', // Toggle captions
            // 'settings', // Settings menu
            // 'pip', // Picture-in-picture (currently Safari only)
            // 'airplay', // Airplay (currently Safari only)
            // 'download', // Show a download button with a link to either the current source or a custom URL you specify in your options
            // 'fullscreen',
        ]
    });
</script>
<script type="text/javascript">

</script>
<!-- Start Animate On Scroll -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="<?= base_url('assets/') ?>js/stellar.js"></script>
<script src="<?= base_url('assets/') ?>vendors/lightbox/simpleLightbox.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/isotope/imagesloaded.pkgd.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/isotope/isotope.pkgd.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/popup/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url('assets/') ?>js/jquery.ajaxchimp.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/counter-up/jquery.waypoints.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/counter-up/jquery.counterup.js"></script>
<script src="<?= base_url('assets/') ?>js/mail-script.js"></script>
<script src="<?= base_url('assets/') ?>js/theme.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>
<script>
    var animateButton = function(e) {
        e.preventDefault;
        e.target.classList.remove('animate');
        e.target.classList.add('animate');
        setTimeout(function() {
            e.target.classList.remove('animate');
        }, 700);
    };

    var bubblyButtons = document.getElementsByClassName("bubbly-button");

    for (var i = 0; i < bubblyButtons.length; i++) {
        bubblyButtons[i].addEventListener('click', animateButton, false);
    }
</script>
<script>
    AOS.init();
</script>
<script>
    <?php if ($this->session->flashdata('success-mark')) : ?>
        Swal.fire({
            icon: 'success',
            title: '<?php echo $this->session->flashdata('success-mark'); ?>',
            text: 'Materi telah selesai',
            showConfirmButton: false,
            timer: 2500
        })
    <?php endif; ?>
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/62cfd1a17b967b1179997997/1g7tslomh';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->
<!--End of Tawk.to Script-->

<!-- End Animate On Scroll -->