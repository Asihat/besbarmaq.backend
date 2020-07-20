<?php

namespace App\Http\Controllers;

use App\Functional\Accounts\IAccount;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $_account;

    public function __construct(IAccount $account)
    {
        $this->_account = $account;
    }

    public function Login(Request $request)
    {
        $result = $this->_account->Login($request);
        return $result;
    }

    public function Register(Request $request)
    {
        $result = $this->_account->Register($request);
        return $result;
    }

    public function Verifyphoneno(Request $request)
    {
        $result = $this->_account->VerifyPhoneNo($request);
        return $result;
    }

    public function ForgotPassword(Request $request)
    {
        $result = $this->_account->ForgotPassword($request);
        return $result;
    }

    public function NewPassword(Request $request)
    {
        $result = $this->_account->NewPassword($request);
        return $result;
    }

    public function VerifyForgotPassword(Request $request)
    {
        $result = $this->_account->VerifyForgotPassword($request);
        return $result;
    }

    public function SendSmsOnRegisterAgain(Request $request) {
        $result = $this->_account->SendSmsOnRegisterAgain($request);
        return $result;
    }

}
