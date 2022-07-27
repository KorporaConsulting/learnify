<?php $this->load->view('user/template_user/header'); ?>
<!-- Start Greetings Card -->
<!-- <div class="container">
    <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
        <div class="row" style="color: black; font-family: 'poppins';">
            <div class="col-md-12 mt-1">
                <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="400">Selamat Datang
                    di Sales University <span style="font-size: 40px;">
                    </span> </h1>
                <p>Hello Students! , Ini merupakan halaman utama Sales University ! Selamat belajar ya students!</p>
                <hr>
            </div>
        </div>
    </div>
</div> -->



<div class="container pt-3">
    <?php if ($user->last_status > 0) : ?>
        <?php if ($user->angsuran == null || $user->angsuran >= $user->tipe_angsuran) : ?>
            Pembayaran anda sudah lunas
        <?php else : ?>
            Bayar Angsuran anda sebelum <?= $user->expired_at ?>
            <div>
                <button data-url="<?= site_url('user/pay_with_installment') ?>" data-name="Kelas Cicilan 3x" data-loop="<?= $user->tipe_angsuran ?>" class="btn btn-block btn-primary pay mb-3 " data-price="1000000" data-angsuran="1">Bayar Cicilan ke <?= $user->angsuran + 1 ?></button>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <div class="row">
            <!-- <div class="col-lg-6 mb-3">
                <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                    <div class="card-header">
                        Bayar dengan Cicilan
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="<?= base_url('assets/img/cicil.svg') ?>" alt="" class="w-50">
                        </div>
                    </div>
                    <div>
                        <button data-url="<?= site_url('user/pay_with_installment') ?>" data-name="Kelas Cicilan 3x" data-loop="3" class="btn btn-block btn-primary pay mb-3 " data-price="1000000" data-angsuran="1">Rp. <?= number_format($harga_enroll->harga / 3, 2, ",", ".") ?> (3x)</button>
                    </div>
                    <div>
                        <button data-url="<?= site_url('user/pay_with_installment') ?>" data-name="Kelas Cicilan 6x" data-loop="6" class="btn btn-block btn-primary pay" data-price="1000000" data-angsuran="1">Rp. <?= number_format($harga_enroll->harga / 6, 2, ",", ".") ?> (6x)</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="card shadow bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="400" style="width: 100%; border-radius:20px;">
                    <div class="card-header">
                        Bayar tanpa cicilan
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="<?= base_url('assets/img/non_cicilan.svg') ?>" alt="" class="w-50">
                        </div>
                    </div>
                    <div>
                        <button data-url="<?= site_url('user/pay_without_installment') ?>" data-name="Kelas Pembayaran Total" data-loop="1" class="btn btn-block btn-primary pay" data-price="3000000" data-angsuran="0">Rp. <?= number_format($harga_enroll->harga, 2, ",", ".") ?> (1x)</button>
                    </div>
                </div>
            </div> -->
            <a href="<?= site_url('user/detail_pembayaran?type=3') ?>" class="btn btn-primary">Rp. <?= number_format($harga_enroll->harga / 3, 2, ",", ".") ?> (3x)</a>
        </div>
    <?php endif; ?>
</div>


<script src="https://app-sandbox.duitku.com/lib/js/duitku.js"></script>
<script>
    $(function() {
        $('.pay').click(function() {
            $.ajax({
                url: $(this).data('url'),
                method: 'POST',
                data: {
                    nama_product: $(this).data('name'),
                    loop: $(this).data('loop'),
                },
                success: function(res) {
                    console.log(res);
                    if (res.success) {
                        window.location.href = res.duitku.paymentUrl;
                    }
                },
                error: function(err) {
                    console.log(err)
                }
            })
        })
    })
</script>
<!-- End Class Card -->
<?php $this->load->view('user/template_user/footer'); ?>