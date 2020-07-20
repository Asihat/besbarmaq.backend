<?php

namespace App\Functional\Accounts\Services;

use App\Models\Users;

trait SendSmsOnRegisterAgain
{
    use SendSmsOnRegister;

    public function SendSmsOnRegisterAgain($request)
    {
        $phone_no = $request->input('phone_no');
        $token = $request->input('token');

        $result['success'] = false;
        do {
            if(!$phone_no || !$token) {
                $result['message'] = 'PARAMETER IS MISSMATCH';
                break;
            }

            if(!Users::where('token', $token)->where('phoneNo', $phone_no)->first()) {
                $result['message'] = 'ERROR 1';
                break;
            }

            $this->SendSmsOnRegister($phone_no);
            $result['success'] = true;
        }while(false);

        return response()->json($result);
    }
}
