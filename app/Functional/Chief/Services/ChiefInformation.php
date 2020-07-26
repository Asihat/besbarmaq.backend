<?php


namespace App\Functional\Chief\Services;


use App\Models\Users;
use Illuminate\Support\Facades\DB;

trait ChiefInformation
{
    public function ChiefInformation($request) {
        $token = $request->input('token');
        $chief_id = $request->input('chief_id');

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
SELECT users.id as 'chief_id', users.name as 'chief_name', users.login as 'chief_login', users.avatar as 'chief_avatar',
chiefs.rating as 'chief_rating', SUM(lenta.id) as 'lenta_no'
FROM chiefs
INNER JOIN lenta ON lenta.user_id = chiefs.id
INNER JOIN users ON users.id = chiefs.id
WHERE users.id = $chief_id
GROUP BY chiefs.id;
SQL;
            $chief = DB::select($sql);

            foreach ($chief as $c) {
                $sql = <<<SQL
SELECT COUNT(orders.id) as 'no'
FROM orders
INNER JOIN lenta ON lenta.id = orders.lenta_id
WHERE lenta.user_id = $c->chief_id;
SQL;
                $order_no = DB::select($sql);
                $c->order_no = $order_no[0]->no;
            }

            $chief = $chief[0];

            $sql = <<<SQL
SELECT food_category.name as 'category_name',
food_classification.id as 'classification_id',
food_subcategory.name, lenta_category.id as 'lenta_category_id',
lenta.name as 'lenta_name', lenta.price as 'price', lenta.rating as 'rating', lenta.work_time as 'work_time',
lenta.photo as 'lenta_photo'
FROM food_category
INNER JOIN food_classification ON food_classification.food_category_id = food_category.id
INNER JOIN food_subcategory ON food_subcategory.id = food_classification.food_subcategory_id
INNER JOIN lenta_category ON lenta_category.category_id = food_subcategory.id
INNER JOIN lenta ON lenta.id = lenta_category.lenta_id
WHERE lenta.user_id = $chief_id;
SQL;

            // TODO Отзывы
            $lenta = DB::select($sql);
            $category = [];
            foreach ($lenta as $key => $l) {
                if(array_key_exists($l->category_name, $category)) {
                    array_push($category[$l->category_name], $l);
                } else {
                    $category[$l->category_name] = [];
                    array_push($category[$l->category_name], $l);
                }
            }

            foreach ($lenta as $l) {
                $l->lenta_photo = url('/') . '/api/images/lenta/' . $l->lenta_photo;
                // TODO Rating
            }

            $result['lenta'] = $category;
            $result['chief'] = $chief;
            $result['success'] = true;
        } while (false);

        return response()->json($result);
    }
}
