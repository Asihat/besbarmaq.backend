<?php

namespace App\Functional\Order;

use App\Functional\Order\Services\Book;
use App\Functional\Order\Services\ListOrder;

class Order implements IOrder {
    use Book, ListOrder;
}
