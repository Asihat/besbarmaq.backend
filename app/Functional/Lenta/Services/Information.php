<?php

namespace App\Functional\Lenta\Services;

use App\Models\Users;
use Illuminate\Support\Facades\DB;

trait Information
{
    public function Info($request)
    {
        $token = $request->input('token');
        $lenta_id = $request->input('lenta_id');

        $result['success'] = false;

        do {
            if (!$token || !$lenta_id) {
                $result['message'] = 'PARAMETER IS MISSMATCH';
                break;
            }

            if (!Users::where('token', $token)->first()) {
                $result['message'] = 'ERROR 1';
                break;
            }

            $sql = <<<SQL
SELECT lenta.*, CONCAT(GROUP_CONCAT(food_category.name ), ',' , cuisine_category.name) AS 'categories',
users.login as 'chief_name', users.avatar as 'chief_avatar',
portion_type.name as 'type', lenta_portion.maxportion as 'maxportion'
FROM lenta
INNER JOIN lenta_category ON lenta.id = lenta_category.lenta_id
INNER JOIN food_category ON lenta_category.category_id = food_category.id

INNER JOIN lenta_cuisine ON lenta_cuisine.lenta_id = lenta.id
INNER JOIN cuisine_category ON cuisine_category.id = lenta_cuisine.cuisine_id

INNER JOIN lenta_portion ON lenta_portion.lenta_id = lenta.id
INNER JOIN portion_type ON portion_type.id = lenta_portion.portion_id

INNER JOIN followers ON followers.chief_id = lenta.user_id
INNER JOIN users ON users.id = followers.chief_id
WHERE lenta.id = 1 GROUP BY lenta.id;
SQL;
            $info = DB::select($sql);
            foreach ($info as $l) {
                $l->photo = url('/') . '/api/images/lenta/' . $l->photo;
                $l->chief_avatar = url('/') . '/api/images/avatars/' . $l->chief_avatar;
                $l->rating = '80%';
                // TODO Rating
            }
            $result['info'] = $info;
            $result['success'] = true;
        } while (false);

        return response()->json($result);
    }
}
