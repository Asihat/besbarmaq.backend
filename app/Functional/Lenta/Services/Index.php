<?php

namespace App\Functional\Lenta\Services;

use App\Models\Lenta;
use App\Models\Users;
use Illuminate\Support\Facades\DB;

trait Index
{
    public function Index($request)
    {
        $token = $request->input('token');

        $result['success'] = false;

        do {
            if (!$token) {
                $result['message'] = "PARAMETER IS MISSMATCH";
                break;
            }

            if (!Users::where('token', $token)->first()) {
                $result['message'] = "ERROR 1";
                break;
            }

            $user = Users::where('token', $token)->first();

            // Lenta list
            $sql = <<<SQL
SELECT lenta.*, CONCAT(GROUP_CONCAT(food_category.name ), ',' , cuisine_category.name) AS 'categories',
users.login as 'chief_name', users.avatar as 'chief_avatar',
portion_type.name as 'type', lenta_portion.maxportion as 'maxportion',
GROUP_CONCAT(DISTINCT ingredients.name) as 'ingredients'
FROM lenta
INNER JOIN lenta_category ON lenta.id = lenta_category.lenta_id
INNER JOIN food_category ON lenta_category.category_id = food_category.id

INNER JOIN lenta_cuisine ON lenta_cuisine.lenta_id = lenta.id
INNER JOIN cuisine_category ON cuisine_category.id = lenta_cuisine.cuisine_id

INNER JOIN lenta_portion ON lenta_portion.lenta_id = lenta.id
INNER JOIN portion_type ON portion_type.id = lenta_portion.portion_id

INNER JOIN ingredients ON ingredients.lenta_id = lenta.id

INNER JOIN followers ON followers.user_id = 14
INNER JOIN users ON users.id = followers.chief_id

GROUP BY lenta.id;
SQL;

            $lenta = DB::select($sql);

            foreach ($lenta as $l) {
                $l->photo = url('/') . '/api/images/lenta/' . $l->photo;
                $l->chief_avatar = url('/') . '/api/images/avatars/' . $l->chief_avatar;
                $l->rating = '80%';
                // TODO Rating
            }

            // History List
            $sql = <<<SQL
SELECT users.login as 'login', users.avatar as 'avatar', history.photo as 'history'
FROM history
INNER JOIN users ON history.user_id = users.id
INNER JOIN followers ON followers.user_id = $user->id;
SQL;

            $history = DB::select($sql);

            foreach ($history as $h) {
                $h->avatar = url('/') . '/api/images/avatars/' . $h->avatar;
                $h->history = url('/') . '/api/images/history/' . $h->history;

            }

            $result['history'] = $history;
            $result['lenta'] = $lenta;
            $result['success'] = true;
        } while (false);


        return response()->json($result);
    }
}
