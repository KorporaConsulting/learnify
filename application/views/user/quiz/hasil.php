<?php $this->load->view('user/template_user/header'); ?>
<?php

// $totalQuiz = count($quiz);

?>
<!-- Start Greetings Card -->
<div class="container">
    <div class="row pt-5">
        <div class="col-6">
            <a href="<?= site_url('user/course/' . $slug_mapel) ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali ke List Materi</a></a>
        </div>
    </div>
    <div class="row pt-5 px-5">
        <h4><?= $materi->nama_materi ?></h4>
        <?php if ($is_final == 1) { ?>
            <div class="col-md-12 pt-2">
                <div class="alert alert-warning" role="alert">
                    <strong>Jika anda tidak lulus lebih dari <?= $opt_quiz->max_post_test ?> kali maka nilai maksimal yang dapat Anda peroleh adalah 70</strong>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow bg-white mx-auto p-4 buat-text mb-2" style="width: 100%; border-radius:10px;">
                <div class="card-header">
                    <h3>Histori Test</h3>
                </div>
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Nama Quiz</th>
                            <th>Nilai</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($histori as $hi) { ?>
                            <tr class="text-center">
                                <td><?= $hi->nama_materi ?></td>
                                <td><?= $hi->nilai ?></td>
                                <?php
                                if ($hi->nilai < $min_nilai->min_nilai) { ?>
                                    <td><span class="badge badge-danger badge-lg">Tidak Lulus</span></td>
                                <?php } else { ?>
                                    <td><span class="badge badge-success badge-lg">Lulus</span></td>
                                <?php }
                                ?>
                            </tr>
                        <?php  }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col text-right">
                    <?php if (!isset($is_lulus)) { ?>
                        <a href="<?= site_url('user/quiz/' . $materi->id_materi . '/' . $id_quiz) ?>" class="btn btn-warning"><i class="fa fa-refresh"></i> Ulangi Test</a>
                    <?php  } ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/selectric@1.13.0/public/jquery.selectric.min.js" integrity="sha256-FEyhf2150teujGP4O8fW1UwKlodqIsIPSXvwvu1VGmE=" crossorigin="anonymous"></script>
    <script>
        $(function() {
            $('#quiz').slick({
                prevArrow: '.prev',
                nextArrow: '.next',
                infinite: false,
                mobileFirst: true,
                swipe: false,
                touchMove: false,
                useCSS: false,
                speed: 0
            });
            if (jQuery().selectric) {
                $(".selectric").selectric({});
            }
        })
    </script>
    <!-- End Class Card -->
    <?php $this->load->view('user/template_user/footer'); ?>