<?php

namespace App\Functional\Accounts\Services;

use App\Models\Users;

trait Login
{
    public function Login($request)
    {
        $phone_no = $request->input('phone_no');
        $password = $request->input('password');

        $result['success'] = false;

        do {
            if(!$phone_no || !$password) {
                $result['message'] = 'PARAMETER MISMATCH';
                break;
            }

            if(!Users::where('phoneNo', $phone_no)->first()) {
                $result['message'] = 'USER WITH THIS PHONE NO DOESNT EXISTS';
                break;
            }

            if(!Users::where('phoneNo', $phone_no)->where('password', $password)->where('bloked', 1)->first()) {
                $result['message'] = 'USER IS BLOCKED';
                break;
            }

            if(!Users::where('phoneNo', $phone_no)->where('password', $password)->first()) {
                $result['message'] = 'Password is incorrect';
                break;
            }

            $user = Users::where('phoneNo', $phone_no)->where('password', $password)->first();

            $result['user'] = $user;
            $result['success'] = true;
        } while(false);
        return response()->json($result);
    }

}

