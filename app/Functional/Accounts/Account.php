<?php

namespace App\Functional\Accounts;

use App\Functional\Accounts\Services\ForgotPassword;
use App\Functional\Accounts\Services\Login;
use App\Functional\Accounts\Services\NewPassword;
use App\Functional\Accounts\Services\Register;
use App\Functional\Accounts\Services\VerifyForgotPassword;
use App\Functional\Accounts\Services\VerifyPhoneNo;

class Account implements IAccount
{
    use Login, Register, VerifyPhoneNo, ForgotPassword, NewPassword, VerifyForgotPassword;
}
