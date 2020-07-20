<?php

namespace App\Functional\Accounts\Services;

use App\Models\Smslist;
use App\Models\Users;

trait VerifyPhoneNo
{
    public function VerifyPhoneNo($request)
    {
        $number = $request->input('number');
        $phone_no = $request->input('phone_no');
        $token = $request->input('token');

        $result['success'] = false;

        do {
            if (!$number || !$phone_no || !$token) {
                $result['message'] = 'PARAMETER MISMATCH';
                break;
            }

            if (!Users::where('token', $token)->first()) {
                $result['message'] = 'ERROR 1';

                break;
            }

            if (!Users::where('token', $token)->where('phoneNo', $phone_no)->where('description', $number)->where('bloked', 2)->first()) {
                $result['message'] = 'ERROR 2';

                break;
            }

            $user = Users::where('token', $token)->where('phoneNo', $phone_no)->where('description', $number)->where('bloked', 2)->first();
            $user->description = '';
            $user->bloked = 1;
            $user->save();

            $smslist = Smslist::where('phoneNo', $user->phoneNo)->where('status', 1)->where('type', 2)->first();
            $smslist->status = 0;
            $smslist->save();

            $result['success'] = true;
            $result['message'] = 'User verified';
        } while (false);

        return response()->json($result);
    }

}

