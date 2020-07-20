<?php

namespace App\Functional\Lenta\Services;

use App\Models\Users;
use Illuminate\Support\Facades\DB;

trait Comments
{
    public function Comments($request)
    {
        $token = $request->input('token');
        $lenta_id = $request->input('lenta_id');

        $result['success'] = false;
        do {
            if(!$token || !$lenta_id) {
                $result['message'] = 'PARAMETER IS MISSMATCH';
                break;
            }

            if(!Users::where('token', $token)->first()) {
                $result['message'] = 'ERROR 1';
                break;
            }

            //$comments = \App\Models\Comments::where('lenta_id', $lenta_id)->get();
            $sql = <<<SQL
SELECT users.login as 'login', users.avatar as 'avatar', comments.comment,
comments.created_at as 'created'
FROM comments
INNER JOIN users ON comments.user_id = users.id
WHERE comments.lenta_id = $lenta_id;
SQL;
            $comments = DB::select($sql);
            foreach ($comments as $l) {
                $l->avatar = url('/') . '/api/images/avatars/' . $l->avatar;
                // TODO Rating
            }
            $result['comments'] = $comments;
            $result['success'] = true;
        } while (false);
        return response()->json($result);
    }
}
