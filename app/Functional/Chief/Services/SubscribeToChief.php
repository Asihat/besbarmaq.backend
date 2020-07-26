<?php


namespace App\Functional\Chief\Services;


use App\Models\Chiefs;
use App\Models\Followers;
use App\Models\Users;

trait SubscribeToChief
{
    public function SubscribeToChief($request)
    {
        $token = $request->input('token');
        $chief_id = $request->input('chief_id');

        $result['success'] = false;
        do {
            if(!$token || !$chief_id) {
                $result['message'] = 'PARAMTER IS MISSMATCH';
                break;
            }

            if(!Users::where('token', $token)->first()) {
                $result['message'] = 'ERROR 1';
                break;
            }

            if(!Chiefs::where('id', $chief_id)->first()) {
                $result['message'] = 'ERROR 2';
                break;
            }

            $user = Users::where('token', $token)->first();

            if(!Followers::where('chief_id', $chief_id)->where('user_id', $user->id)->first()) {
                $result['message'] = 'USER ALREADY SUBSCRIBED TO CHIEF';
                break;
            }


            $result['success'] = true;
        } while (false);
        return response()->json($result);
    }
}
