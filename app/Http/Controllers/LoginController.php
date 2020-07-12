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

    public function Login()
    {
        $result = $this->_account->Login();

        return $result;
    }

    public function Register()
    {
        $result = $this->_account->Register();

        return $result;
    }

}
