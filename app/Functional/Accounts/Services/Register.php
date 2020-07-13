<?php

namespace App\Functional\Accounts\Services;

use App\Models\Users;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait Register
{
    use SendSmsOnRegister;

    public function Register($request)
    {
        $login = $request->input('login');
        $phone_no = $request->input('phone_no');
        $password = $request->input('password');

        $result['success'] = false;

        do {
            if(!$login || !$phone_no || !$password) {
                $result['message'] = 'INPUT ERROR';

                break;
            }

            if(Users::where('login', $login)->first()) {
                $result['message'] = 'LOGIN EXISTS';

                break;
            }


            if(Users::where('phoneNo', $phone_no)->first()) {
                $result['message'] = 'PHONE NO EXISTS';

                break;
            }
            Log::info('PHONE NO: ' . $phone_no);
            $new_user = new Users();
            $new_user->login = $login;
            $new_user->phoneNo = $phone_no;
            $new_user->password = $password;
            $new_user->token = Str::random(60);


            $result['success'] = true;
            $result['token'] = $new_user->token;
            $pincode = $this->SendSmsOnRegister($phone_no);

            $new_user->description = $pincode;
            $new_user->save();
        } while(false);

        return response()->json($result);
    }
}

