<?php

namespace App\Functional\Accounts\Services;

use App\Models\Smslist;
use App\Models\Users;
use Illuminate\Support\Facades\Log;

trait SendSmsOnRegister
{
    public function SendSmsOnRegister($phoneNo)
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
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        $context = stream_context_create($opts);
        // TODO result write to database for future
        $result = file_get_contents('https://smsc.kz/sys/send.php', false, $context);

        do {
            if (Smslist::where('phoneNo', $phoneNo)->where('type', 2)->first()) {
                $smslist = Smslist::where('phoneNo', $phoneNo)->where('type', 2)->first();
                $smslist->status = 0;
                $smslist->save();
            }

            $smslist = new Smslist();
            $smslist->status = 1;
            $smslist->phoneNo = $phoneNo;
            $smslist->message = 'REGISTER USER, ' . $result;
            $smslist->code = $pincode;
            $smslist->type = 2;
            $smslist->save();
        } while (false);

        $user = Users::where('phoneNo', $phoneNo)->first();
        $user->description = $pincode;
        $user->save();
    }
}

