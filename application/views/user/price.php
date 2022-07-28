<?php $this->load->view('user/template_user/header'); ?>
<link rel="stylesheet" href="<?= base_url('assets/') ?>css/price.css">
<!-- Start Greetings Card -->
<div class="container pt-5 mt-5" style="min-height: 100vh;">
    <div class="card mb-3 shadow bg-white mx-auto p-4 buat-text" style="width: 100%; border-radius:20px;">
        <div class="pricing-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-price">
                            <div class="deal-top">
                                <h3>Cicilan</h3>
                                <h4>3 X</h4>
                            </div>
                            <div class="deal-bottom">
                                <ul class="deal-item">
                                    <?php
                                    $harga3 = $harga->harga / 3;
                                    for ($i = 0; $i < 3; $i++) { ?>
                                        <li>Rp.<?= number_format($harga3, 0) ?></li>
                                    <?php  }
                                    ?>
                                </ul>
                                <div class="btn-area">
                                    <a href="<?= site_url('price/detail_pembayaran?type=3') ?>">Pilih</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-price">
                            <div class="deal-top">
                                <h3>Cicilan</h3>
                                <h4>6 X</h4>
                            </div>
                            <div class="deal-bottom">
                                <ul class="deal-item">
                                    <?php
                                    $harga6 = $harga->harga / 6;
                                    for ($i = 0; $i < 6; $i++) { ?>
                                        <li>Rp.<?= number_format($harga6, 0) ?></li>
                                    <?php  }
                                    ?>
                                </ul>
                                <div class="btn-area">
                                    <a href="<?= site_url('price/detail_pembayaran?type=6') ?>">Pilih</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-price">
                            <div class="deal-top">
                                <h3>Pembayaran Tanpa Cicilan</h3>
                            </div>
                            <div class="deal-bottom">
                                <ul class="deal-item">
                                    <?php
                                    $harga6 = $harga->harga; ?>
                                    <li>Rp.<?= number_format($harga6, 0) ?></li>
                                </ul>
                                <div class="btn-area">
                                    <a href="#">Pilih</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>