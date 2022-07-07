<?php $this->load->view('user/template_user/header'); ?>
<?php

$totalQuiz = count($quiz);

?>
<!-- Start Greetings Card -->
<div class="container">
    <h4><?= $materi->nama_materi ?></h4>
    <div class="row mt-5 pt-5">

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <?php for ($i = 1; $i <= $totalQuiz; $i++) : ?>
                        <button class="btn btn-light toSlide" id="<?= $i - 1  ?>"><?= $i ?></button>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow bg-white mx-auto p-4 buat-text mb-2" style="width: 100%; border-radius:10px;">
                <form action="<?= site_url('user/save_quiz') ?>" method="post">
                    <input type="hidden" name="total_soal" value="<?= $totalQuiz ?>">
                    <input type="hidden" name="id_materi" value="<?= $this->uri->segment(3); ?>">

                    <div id="quiz">
                        <?php foreach ($quiz as $key => $val) : ?>
                            <input type="hidden" name="id_soal[]" value="<?= $val->id_soal ?>">
                            <div class="panel panel-primary" id="<?= $val->id_soal ?>">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <?= $key + 1 ?>. <?= $val->soal ?>
                                    </h3>
                                </div>
                                <div class="panel-body mb-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="answer<?= $key ?>" id="optionsRadios1" value="opsi_a" data-slide="<?= $key ?>"> <?= $val->opsi_a ?>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="answer<?= $key ?>" id="optionsRadios2" value="opsi_b" data-slide="<?= $key ?>"> <?= $val->opsi_b ?>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="answer<?= $key ?>" id="optionsRadios3" value="opsi_c" data-slide="<?= $key ?>"> <?= $val->opsi_c ?>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="answer<?= $key ?>" id="optionsRadios4" value="opsi_d" data-slide="<?= $key ?>"> <?= $val->opsi_d ?>
                                        </label>
                                    </div>
                                    <input type="hidden" name="answer_key<?= $key ?>" value="opsi_<?= $val->jawaban ?>">
                                </div>
                                <div class="panel-footer">
                                    <?php if ($totalQuiz == $key + 1) { ?>
                                        <button type="button" class="btn btn-sm btn-warning prev">Prev</button>
                                        <button type="button" class="btn btn-sm btn-primary next float-right" onclick="confirm()">Submit</button>
                                    <?php } elseif ($key == 0) { ?>
                                        <button type="button" class="btn btn-sm btn-primary next">Next</button>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-sm btn-warning prev">Prev</button>
                                        <button type="button" class="btn btn-sm btn-primary next">Next</button>
                                    <?php  } ?>
                                </div>
                                </p>
                            </div>

                        <?php endforeach; ?>
                    </div>
                    <input type="hidden" name="type" value="<?= $quiz_type->type ?>">
                    <input type="hidden" name="id_quiz" value="<?= $quiz_type->id_quiz ?>">
                </form>
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

            $('.toSlide').click(function() {
                const index = $(this).attr('id');
                $('#quiz').slick('slickGoTo', index)
            });

            $('input[type=radio]').change(function() {
                const button = $(this).data('slide');
                $('#' + button).removeClass('btn-light');
                $('#' + button).addClass('btn-success');
            })


        })

        const confirm = function() {
            Swal.fire({
                title: 'apa anda yakin?',
                text: "Cek kembali jawaban anda sebelum submit",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $('form').submit();
                }
            })
        }
    </script>
    <!-- End Class Card -->
    <?php $this->load->view('user/template_user/footer'); ?>