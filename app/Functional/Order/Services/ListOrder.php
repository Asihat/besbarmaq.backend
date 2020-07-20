<?php

namespace App\Functional\Order\Services;

use App\Models\Users;
use Illuminate\Support\Facades\DB;

trait ListOrder
{
    public function ListOrder($request)
    {
        $token = $request->input('token');

        $result['success'] = false;
        do {
            if (!$token) {
                $result['message'] = 'PARAMETER IS MISSMATCH';
                break;
            }

            if (!Users::where('token', $token)->first()) {
                $result['message'] = 'ERROR 1';
                break;
            }

            $user = Users::where('token', $token)->first();
            $sql = <<<SQL
SELECT
users.login as 'chief_name',
lenta.name as 'food_name',
orders.time as 'time',
orders.portion_no as 'portion_no',
orders.status as 'status'
FROM orders
INNER JOIN lenta ON orders.lenta_id = lenta.id
INNER JOIN users ON users.id = lenta.user_id
WHERE orders.user_id = $user->id
SQL;
            $orders = DB::select($sql);

            $result['orders'] = $orders;
            $result['success'] = true;
        } while (false);

        return response()->json($result);
    }
}
