<?php

namespace App\Functional\Order\Services;

use App\Models\Lenta;
use App\Models\Orders;
use App\Models\Users;

trait Book {
    public function Book($request) {
        $token = $request->input('token');
        $lenta_id = $request->input('lenta_id');
        $portion_no = $request->input('portion_no');
        $description = $request->input('description');
        $comment = $request->input('comment');
        $time = $request->input('time');

        $result['success'] = false;
        do {
            if(!$token || !$lenta_id || !$portion_no || !$description || !$comment || !$time) {
                $result['message'] = 'PARAMETER IS MISSMATCH';
                break;
            }

            if(!Users::where('token', $token)->first()) {
                $result['message'] = 'ERROR 1';
                break;
            }

            if(!Lenta::where('id', $lenta_id)->first()) {
                $result['message'] = 'ERROR 2';
                break;
            }

            $user = Users::where('token', $token)->first();

            $order = new Orders();
            $order->lenta_id = $lenta_id;
            $order->user_id = $user->id;
            $order->status = 0;
            $order->time = $time;
            $order->portion_no = $portion_no;
            $order->description = $description;
            $order->comment = $comment;
            $order->offer = 'something important later';
            $order->save();

            $result['message'] = 'ORDER CREATED WAIT CHIEF CONFIRMATION IN 10 MIN';
            $result['success'] = true;
        } while(false);
        return response()->json($result);
    }
}
