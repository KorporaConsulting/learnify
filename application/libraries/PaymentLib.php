<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentLib {

    public function pay($settingPayment, $productDetails, $buyer)
    {

        $merchantCode = $settingPayment->merchant_code; // dari duitku
        $merchantKey = $settingPayment->merchant_key; // dari duitku

        $timestamp = round(microtime(true) * 1000); //in milisecond
        $paymentAmount = 40000;
        $merchantOrderId = time() . ''; // dari merchant, unique
        // $productDetails = 'Test Pay with duitku';
        $email = $buyer['email']; // email pelanggan merchant
        // $phoneNumber = '08123456789'; // nomor tlp pelanggan merchant (opsional)
        $additionalParam = ''; // opsional
        $merchantUserInfo = ''; // opsional
        $customerVaName = $buyer['nama']; // menampilkan nama pelanggan pada tampilan konfirmasi bank
        $callbackUrl = 'http://localhost/learnify/pembayaran'; // url untuk callback
        $returnUrl = 'http://localhost/learnify/pembayaran'; //'http://example.com/return'; // url untuk redirect
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

        // $address = array(
        //     'firstName' => $firstName,
        //     'lastName' => $lastName,
        //     'address' => $alamat,
        //     'city' => $city,
        //     'postalCode' => $postalCode,
        //     'phone' => $phoneNumber,
        //     'countryCode' => $countryCode
        // );

        $customerDetail = array(
            'firstName' => $firstName,
            // 'lastName' => $lastName,
            'email' => $email,
            // 'phoneNumber' => $phoneNumber,
            // 'billingAddress' => $address,
            // 'shippingAddress' => $address
        );


        $item1 = array(
            'name' => 'Test Item 1',
            'price' => 10000,
            'quantity' => 1
        );

        $item2 = array(
            'name' => 'Test Item 2',
            'price' => 30000,
            'quantity' => 3
        );

        $itemDetails = array(
            $item1, $item2
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
