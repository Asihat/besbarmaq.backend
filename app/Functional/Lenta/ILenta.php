<?php

namespace App\Functional\Lenta;

interface ILenta {
    public function Index($request);
    public function Info($request);
    public function Comments($request);
    public function AddComment($request);
}
