<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Wa_model extends CI_Model
{
    public function sendWa($phone, $text)
    {
        $apikey = '3729';
        $phone = $phone;
        $message = $text;
        $url = 'http://172.165.115.244/api/post.php';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            'Apikey'    => $apikey,
            'Phone'     => $phone,
            'Message'   => $message,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }
    public function sendWaWithFile($phone, $text, $file)
    {
        $apikey = '3729';
        $phone = $phone;
        $message = $text;
        $url = 'http://172.165.115.244/api/post.php';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            'Apikey'    => $apikey,
            'Phone'     => $phone,
            'Message'   => $message,
            'file'      => $file,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }
}
