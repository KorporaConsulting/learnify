<?php

use \Endroid\QrCode\Builder\Builder;
use \Endroid\QrCode\Encoding\Encoding;
use \Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use \Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use \Endroid\QrCode\Label\Font\NotoSans;
use \Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use \Endroid\QrCode\Writer\PngWriter;

class qrcode
{


    public function generate($data)
    {
        $password = "ketik amin biar saya masuk surga";
        $encrypted_string = openssl_encrypt($data, "AES-128-ECB", $password);
        $decrypted_string = openssl_decrypt($encrypted_string, "AES-128-ECB", $password);

        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($encrypted_string)
            // ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            // ->logoPath(__DIR__ . '/assets/symfony.png')
            ->labelText('Sales University')
            ->labelFont(new NotoSans(20))
            ->labelAlignment(new LabelAlignmentCenter())
            ->build();

        // header('Content-Type: ' . $result->getMimeType());
        // echo $result->getString();
        $path = 'assets/absensi/' . uniqid('QR-code-') . '.png';
        $result->saveToFile($path);
        $dataUri = $result->getDataUri();
        return $path;
    }
}
