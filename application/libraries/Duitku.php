<?php 

class Duitku {

    public function pay($settingPayment, $product, $buyer)
    {

        $merchantCode = $settingPayment->merchant_code; // dari duitku
        $merchantKey = $settingPayment->merchant_key; // dari duitku

        $timestamp = round(microtime(true) * 1000); //in milisecond
        $merchantOrderId = time() . ''; // dari merchant, unique
        $productDetails = 'Anjas';
        $email = $buyer['email']; // email pelanggan merchant
        // $phoneNumber = '08123456789'; // nomor tlp pelanggan merchant (opsional)
        $additionalParam = ''; // opsional
        $merchantUserInfo = ''; // opsional
        $customerVaName = $buyer['nama']; // menampilkan nama pelanggan pada tampilan konfirmasi bank
        $callbackUrl = 'http://demo.salesuniversity.id/user/payment_callback'; // url untuk callback
        $returnUrl = 'http://demo.salesuniversity.id/pembayaran'; //'http://example.com/return'; // url untuk redirect
        $expiryPeriod = 10; // untuk menentukan waktu kedaluarsa dalam menit
        $signature = hash('sha256', $merchantCode . $timestamp . $merchantKey);
        //$paymentMethod = 'VC'; //digunakan untuk direksional pembayaran

        // Detail pelanggan
        $firstName = $buyer['nama'];
        // $lastName = "Doe";

        // Alamat
        $alamat = "Jl. Kembangan Raya";
        $city = "Jakarta";
        $postalCode = "11530";
        $countryCode = "ID";

        $customerDetail = array(
            'firstName' => $firstName,
            'email' => $email,
        );


        $paymentAmount = $product['price'];
        if($product['cicilan']){
            $item1 = array(
                'name' => 'Cicilan 1',
                'price' => $product['price'],
                'quantity' => 1,
            );
        }else{
            $item1 = array(
                'name' => 'Full Pay',
                'price' => $product['price'],
                'quantity' => 1
            );
        }

        // $item2 = array(
        //     'name' => 'Test Item 2',
        //     'price' => 30000,
        //     'quantity' => 3
        // );

        $itemDetails = array(
            $item1
        );

        $params = array(
            'paymentAmount' => $paymentAmount,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'additionalParam' => $additionalParam,
            'merchantUserInfo' => $merchantUserInfo,
            'customerVaName' => $customerVaName,
            'email' => $email,
            // 'phoneNumber' => $phoneNumber,
            'itemDetails' => $itemDetails,
            'customerDetail' => $customerDetail,
            'callbackUrl' => $callbackUrl,
            'returnUrl' => $returnUrl,
            'expiryPeriod' => $expiryPeriod,
            //'paymentMethod' => $paymentMethod
        );

        $params_string = json_encode($params);
        //echo $params_string;
        $url = 'https://api-sandbox.duitku.com/api/merchant/createinvoice'; // Sandbox
        // $url = 'https://api-prod.duitku.com/api/merchant/createinvoice'; // Production

        //log transaksi untuk debug 
        // file_put_contents('log_createInvoice.txt', "* log *\r\n", FILE_APPEND | LOCK_EX);
        // file_put_contents('log_createInvoice.txt', $params_string . "\r\n\r\n", FILE_APPEND | LOCK_EX);
        // file_put_contents('log_createInvoice.txt', 'x-duitku-signature:' . $signature . "\r\n\r\n", FILE_APPEND | LOCK_EX);
        // file_put_contents('log_createInvoice.txt', 'x-duitku-timestamp:' . $timestamp . "\r\n\r\n", FILE_APPEND | LOCK_EX);
        // file_put_contents('log_createInvoice.txt', 'x-duitku-merchantcode:' . $merchantCode . "\r\n\r\n", FILE_APPEND | LOCK_EX);
        $ch = curl_init();


        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($params_string),
                'x-duitku-signature:' . $signature,
                'x-duitku-timestamp:' . $timestamp,
                'x-duitku-merchantcode:' . $merchantCode
            )
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        //execute post
        $request = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode == 200) {
            //header('location: '. $result['paymentUrl']);
            return [
                'data' =>  json_decode($request, true),
                'success' => true
            ];
            // echo "paymentUrl :". $result['paymentUrl'] . "<br />";
            // echo "reference :". $result['reference'] . "<br />";
            // echo "statusCode :". $result['statusCode'] . "<br />";
            // echo "statusMessage :". $result['statusMessage'] . "<br />";
        } else {
            // echo $httpCode . " " . $request ;
            return [
                'data' => json_decode($request, true),
                'success' => false
            ];
        }
    }

}
