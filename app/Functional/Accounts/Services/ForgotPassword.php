<?php

namespace App\Functional\Accounts\Services;

use App\Models\Smslist;
use App\Models\Users;

trait ForgotPassword
{
    use SendSmsOnForgotPassword;

    public function ForgotPassword($request)
    {
        $phone_no = $request->input('phone_no');
        $result['success'] = false;

        do {
            if (!$phone_no) {
                $result['message'] = 'PARAMETER MISSMATCH';
                break;
            }

            if (!Users::where('phoneNo', $phone_no)->first()) {
                $result['message'] = 'USER DOESNT EXISTS';
                break;
            }

            if (Smslist::where('phoneNo', $phone_no)->where('type', 1)->where('status', 1)->first()) {
                $unsms = Smslist::where('phoneNo', $phone_no)->where('type', 1)->where('status', 1)->first();
                $unsms->status = 0;
                $unsms->save();
            }

            $number = $this->SendSmsOnRegister($phone_no);

            $smslist = new Smslist();
            $smslist->status = 1;
            $smslist->phoneNo = $phone_no;
            $smslist->message = 'FORGOT PASSWORD';
            $smslist->code = $number;
            $smslist->type = 1;
            $smslist->save();

            $result['success'] = true;
            $result['message'] = 'WAIT SMS';
        } while (false);

        return response()->json($result);
    }

}

