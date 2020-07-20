<?php

namespace App\Functional\Accounts\Services;

use App\Models\Users;
use Illuminate\Support\Str;

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

            if(!Users::where('phoneNo', $phone_no)->where('password', $password)->first()) {
                $result['messsage'] = 'INCORRECT PASSWORD';
                break;
            }

            $user = Users::where('phoneNo', $phone_no)->where('password', $password)->first();

            if($user->bloked == 0) {
                $result['message'] = 'USER IS BLOKED, CONTACT WITH US';
                break;
            }

            if($user->bloked == 2) {
                $result['message'] = 'USER IS NOT VERIFIED. VERIFY YOURSELF';
                break;
            }

            if($user->bloked != 1) {
                $result['messsage'] = 'SOMETHING WRONG ON SERVER. AND CONTACT WITH US.';
                break;
            }

            $user->token = Str::random(60);
            $user->save();

            $result['token'] = $user->token;
            $result['success'] = true;
        } while(false);
        return response()->json($result);
    }

}

