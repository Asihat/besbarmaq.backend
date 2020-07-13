<?php

namespace App\Functional\Accounts\Services;

use Illuminate\Support\Facades\Log;

trait SendSmsOnForgotPassword
{
    public function SendSmsOnForgotPassword($phoneNo)
    {
        $pincode = mt_rand(1000, 9999);;
        $text = 'Number: ' . $pincode;
        $number = '+' . $phoneNo;
        $postdata = http_build_query(
            array(
                'login' => 'asihat',
                'psw' => 'sasukewar98sms',
                'phones' => $number,
                'mes' => $text,
            )
        );

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        $context  = stream_context_create($opts);
        // TODO result write to database for future
        $result = file_get_contents('https://smsc.kz/sys/send.php', false, $context);
        Log::info('PHONE NO: ' . '+' . $phoneNo);
        Log::info('RESULT: ' . $result);

        return $pincode;
    }
}

