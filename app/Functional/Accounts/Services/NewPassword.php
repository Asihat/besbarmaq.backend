<?php

namespace App\Functional\Accounts\Services;

use App\Models\Smslist;
use App\Models\Users;

trait NewPassword
{
    public function NewPassword($request)
    {
        $phone_no = $request->input('phone_no');
        $password = $request->input('password');
        $token = $request->input('token');

        $result['success'] = false;

        do {
            if(!$phone_no || !$password || !$token) {
                $result['message'] = 'PARAMETER IS MISSMATCH';
                break;
            }

            if(!Users::where('phoneNo', $phone_no)->first()) {
                $result['message'] = 'USER DOESNT EXISTS';
                break;
            }

            if(!Users::where('phoneNo', $phone_no)->where('token', $token)->first()) {
                $result['message'] = 'ERROR 1';
                break;
            }

            $user = Users::where('phoneNo', $phone_no)->where('token', $token)->first();
            $user->password = $password;
            $user->save();

            $result['success'] = true;
            $result['message'] = 'PASSWORD UPDATED';
        } while(false);
        return response()->json($result);
    }

}

