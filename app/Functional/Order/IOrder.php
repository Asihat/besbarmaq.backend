<?php

namespace App\Functional\Order;

interface IOrder{
    public function Book($request);
    public function ListOrder($request);
}
