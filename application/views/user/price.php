<?php $this->load->view('user/template_user/header'); ?>
<link rel="stylesheet" href="<?= base_url('assets/') ?>css/price.css">
<!-- Start Greetings Card -->
<div class="container pt-5 mt-5" style="min-height: 100vh;">
    <div class="card mb-3 shadow bg-white mx-auto p-4 buat-text" style="width: 100%; border-radius:20px;">
        <div class="pricing-area">
            <div class="container">
                <h2>Price</h2>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="single-price">
                            <div class="deal-top">
                                <h3>Cicilan <br> 12 X</h3>
                                <button class="btn btn-warning btn-disabled">Rp 1.089.000 /Bulan</button>
                            </div>
                            <div class="deal-bottom">
                                <div class="btn-area">
                                    <a href="<?= site_url('price/detail_pembayaran?type=3') ?>">Pilih</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="single-price">
                            <div class="deal-top">
                                <h3>Pembayaran <br> Tanpa Cicilan</h3>
                                <button class="btn btn-warning btn-disabled">Rp. 13.000.000</button>
                            </div>
                            <div class="deal-bottom">
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