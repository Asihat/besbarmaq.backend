<?php


namespace App\Functional\Chief\Services;


use App\Models\Users;
use Illuminate\Support\Facades\DB;

trait NearChiefs
{
    use CalculateDistance;
    public function NearChiefs($request)
    {
        $result['success'] = false;

        $token = $request->input('token');
        $longtitude = $request->input('longtitude');
        $latitude = $request->input('latitude');

        do {
            if (!$token || !$longtitude || !$latitude) {
                $result['message'] = 'PARAMETER IS MISSMATCH';
                break;
            }

            if(!Users::where('token', $token)->first()) {
                $result['message'] = 'ERROR 1';
                break;
            }

            $sql = <<<SQL
SELECT users.id as 'chief_id', users.name as 'chief_name', users.login as 'chief_login',
location.longtitude as 'longtitude', location.latitude as 'latitude',
chiefs.rating as 'chief_rating', COUNT(lenta.id) as 'lenta_no'
FROM chiefs
INNER JOIN lenta ON lenta.user_id = chiefs.id
INNER JOIN users ON users.id = chiefs.id
INNER JOIN location ON chiefs.location_id = location.id
GROUP BY chiefs.id;
SQL;
            $best_chiefs = DB::select($sql);

            foreach ($best_chiefs as $key => $chief) {
                $sql = <<<SQL
SELECT COUNT(orders.id) as 'no'
FROM orders
INNER JOIN lenta ON lenta.id = orders.lenta_id
WHERE lenta.user_id = $chief->chief_id;
SQL;
                $order_no = DB::select($sql);
                $chief->order_no = $order_no[0]->no;

                $distance = $this->distance($latitude, $longtitude, $chief->latitude, $chief->longtitude, 'K');
                if($distance > 5) {
                    unset($best_chiefs[$key]);
                }
            }

            // TODO Отзывы

            $result['chiefs'] = $best_chiefs;
            $result['success'] = true;
        } while (false);

        return response()->json($result);
    }
}
