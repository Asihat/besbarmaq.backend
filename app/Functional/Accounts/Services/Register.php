<?php

namespace App\Functional\Accounts\Services;

trait Register
{
    use SendSmsOnRegister;

    public function Register()
    {
        $this->SendSmsOnRegister();
        dd('This is register function');

    }
}

