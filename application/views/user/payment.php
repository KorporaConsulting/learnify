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
    <div class="row">
        <div class="col-lg-6 mb-3">
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
                    <button data-url="<?= site_url('user/pay_with_installment') ?>" class="btn btn-block btn-primary pay" id="angsuran">Rp. 1.000.000 (3x)</button>
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
                    <a href="" class="btn btn-block btn-primary pay">Rp. 3.000.000 (1x)</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://app-sandbox.duitku.com/lib/js/duitku.js"></script>
<script>
    $(function() {
        $('.pay').click(function() {
            $.ajax({
                url: $(this).data('url'),
                method: 'POST',
                data: {
                    nama_product: 'Kelas Cicilan 3X'
                },
                success: function(res) {
                    if(res.success){
                        checkout.process(res.duitku.reference, {
                            defaultLanguage: "id", //opsional pengaturan bahasa
                            successEvent: function(result) {
                                $.ajax({
                                    url: '<?= site_url('user/update_status_transaksi') ?>/' + res.id_transaksi,
                                    method: 'GET',
                                    success: function(res) {
                                        alert('Transaksi Updated')
                                    },
                                    error: function() {
                                        
                                    }
                                })
                                console.log('success');
                                console.log(result);
                                alert('Payment Success');
                            },
                            pendingEvent: function(result) {
                                // tambahkan fungsi sesuai kebutuhan anda
                                console.log('pending');
                                console.log(result);
                                // alert('Payment Pending');
                            },
                            errorEvent: function(result) {
                                // tambahkan fungsi sesuai kebutuhan anda
                                console.log('error');
                                console.log(result);
                                // alert('Payment Error');
                            },
                            closeEvent: function(result) {
                                // tambahkan fungsi sesuai kebutuhan anda
                                console.log('customer closed the popup without finishing the payment');
                                console.log(result);
                                // alert('customer closed the popup without finishing the payment');
                            }
                        });
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