<?php


namespace App\Functional\Chief\Services;


use App\Models\Users;
use Illuminate\Support\Facades\DB;

trait NewChiefs
{
    public function NewChiefs($request) {
        $token = $request->input('token');

        $result['success'] = false;
        do {
            if (!$token) {
                $result['message'] = 'PARAMETER MISSMATCH';
                break;
            }

            if (!Users::where('token', $token)->first()) {
                $result['message'] = 'ERROR 1';
                break;
            }


            $sql = <<<SQL
SELECT users.id as 'chief_id', users.name as 'chief_name', users.login as 'chief_login',
chiefs.rating as 'chief_rating', SUM(lenta.id) as 'lenta_no'
FROM chiefs
INNER JOIN lenta ON lenta.user_id = chiefs.id
INNER JOIN users ON users.id = chiefs.id
GROUP BY chiefs.id;
SQL;
            $best_chiefs = DB::select($sql);

            foreach ($best_chiefs as $chief) {
                $sql = <<<SQL
SELECT COUNT(orders.id) as 'no'
FROM orders
INNER JOIN lenta ON lenta.id = orders.lenta_id
WHERE lenta.user_id = $chief->chief_id;
SQL;
                $order_no = DB::select($sql);
                $chief->order_no = $order_no[0]->no;
            }

            // TODO Отзывы

            $result['chiefs'] = $best_chiefs;
            $result['success'] = true;
        } while (false);

        return response()->json($result);
    }
}
