<?php

namespace App\Functional\Accounts;

use App\Functional\Accounts\Services\Login;
use App\Functional\Accounts\Services\Register;

class Account implements IAccount
{
    use Login, Register;
}
