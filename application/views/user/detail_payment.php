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
    <?php if ($is_cicilan) : ?>
        <h2 class="text-center mb-4">Tipe Pembayaran: <?= $cicilan ?>x Angsuran</h2>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div id="wrap-alert">

                </div>
                <div class="input-group mb-3">
                    <input type="text" id="input-voucher" class="form-control" placeholder="Kode Voucher" aria-label="Kode Voucher" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="use-voucher">Gunakan</button>
                    </div>
                </div>
                <?php if ($is_cicilan) : ?>
                    <form action="<?= site_url('price/pay_with_installment') ?>" method="POST">
                        <input type="hidden" name="loop" value="<?= $cicilan ?>">
                        <button class="btn btn-primary">Bayar</button>
                    </form>
                <?php else : ?>
                    <form action="<?= site_url('price/pay_without_installment') ?>" method="POST">
                        <button class="btn btn-primary">Bayar</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    <?php else : ?>

    <?php endif; ?>
</div>


<script src="https://app-sandbox.duitku.com/lib/js/duitku.js"></script>
<script>
    $(function() {
        $('#use-voucher').click(function() {
            $.ajax({
                url: '<?= site_url("user/check_voucher") ?>',
                method: 'POST',
                data: {
                    kode_voucher: $('#input-voucher').val(),
                },
                success: function(res) {
                    if (res.success) {
                        const html = `<div class="alert alert-success">${res.message}</div>`;
                        $('#wrap-alert').html(html)
                    } else {
                        const html = `<div class="alert alert-danger">${res.message}</div>`;
                        $('#wrap-alert').html(html)
                    }
                    console.log(res);
                },
                error: function(err) {
                    console.log(err);
                }
            })
        });


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