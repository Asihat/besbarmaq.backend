<?php

namespace App\Functional\Accounts\Services;

use App\Models\Smslist;
use App\Models\Users;
use Illuminate\Support\Str;

trait VerifyForgotPassword
{
    public function VerifyForgotPassword($request)
    {
        $number = $request->input('number');
        $phone_no = $request->input('phone_no');

        do {
            if(!$number || !$phone_no) {
                $result['message'] = "PARAMETER MISSMATCH";
                break;
            }

            if(!Users::where('phoneNo', $phone_no)->first()) {
                $result['message'] = 'USER DOESNT EXISTS';
                break;
            }

            if(!Smslist::where('phoneNo', $phone_no)->where('type', 1)->first()) {
                $result['message'] = 'ERROR 1';
                break;
            }


            if(!Smslist::where('phoneNo', $phone_no)->where('type', 1)->where('code', $number)->where('status', 1)->first()) {
                $result['message'] = 'ERROR 2';
                break;
            }

            $token = Str::random(60);;

            $user = Users::where('phoneNo', $phone_no)->first();
            $user->token = $token;
            $user->save();

            $smslist = Smslist::where('phoneNo', $phone_no)->where('type', 1)->where('code', $number)->where('status', 1)->first();
            $smslist->status = 0;
            $smslist->save();

            $result['token'] = $token;
            $result['success'] = true;
        } while(false);
        return response()->json($result);
    }

}

