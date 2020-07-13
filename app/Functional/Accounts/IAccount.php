<?php

namespace App\Functional\Accounts;

interface IAccount {
    public function Login($request);
    public function Register($request);
    public function VerifyPhoneNo($request);
    public function ForgotPassword($request);
    public function VerifyForgotPassword($request);
    public function NewPassword($request);
}
