<?php

namespace App\Functional\Lenta\Services;

use App\Models\Users;

trait AddComment
{
    public function AddComment($request)
    {
        $token = $request->input('token');
        $lenta_id = $request->input('lenta_id');
        $comment = $request->input('comment');

        $result['success'] = false;
        do {
            if (!$token || !$lenta_id || !$comment) {
                $result['message'] = 'PARAMETER IS MISSMATCH';
                break;
            }

            if (!Users::where('token', $token)->first()) {
                $result['message'] = 'ERROR 1';
                break;
            }

            $user = Users::where('token', $token)->first();

            \App\Models\Comments::create([
                'user_id' => $user->id,
                'lenta_id' => $lenta_id,
                'comment' => $comment,
            ]);

        } while (false);
        $result['success'] = true;
        $result['message'] = 'Comment added';
        return response()->json($result);
    }
}
