<?php

namespace App\Http\Controllers;

use App\Functional\Order\IOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $_order;

    public function __construct(IOrder $order)
    {
        $this->_order = $order;
    }

    public function CreateOrder(Request $request) {
        $result = $this->_order->Book($request);
        return $result;
    }

    public function ListOrders(Request $request) {
        $result = $this->_order->ListOrder($request);
        return $result;
    }
}
