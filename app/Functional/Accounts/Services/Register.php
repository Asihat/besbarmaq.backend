<?php

namespace App\Functional\Accounts\Services;

use App\Models\Smslist;
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

            if(strlen($password) < 8) {
                $result['message'] = 'PASSWORD DOES NOT MATCH THE REQUIREMENT';
                break;
            }

            Log::info('PHONE NO: ' . $phone_no);
            $new_user = new Users();
            $new_user->login = $login;
            $new_user->phoneNo = $phone_no;
            $new_user->password = $password;
            $new_user->token = Str::random(60);
            $new_user->description = '';
            $new_user->bloked = 2;
            $new_user->save();

            $this->SendSmsOnRegister($phone_no);


            $result['token'] = $new_user->token;
            $result['success'] = true;
        } while(false);

        return response()->json($result);
    }

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

