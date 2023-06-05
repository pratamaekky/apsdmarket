<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function data(Request $request)
    {
        $resData = [];
        $params = $request->query();
        $totalOrders = DB::table('order')->get()->count();

        $draw = isset($params['draw']) ? $params['draw'] : 0;
        $start = isset($params['start']) ? $params['start'] : 0;
        $limit = isset($params['length']) ? $params['length'] : 10;

        $ordersData = DB::table('order')->offset($start)->limit($limit)->get();
        foreach ($ordersData as $order) {
            $resData[] = [
                "id" => $order->id,
                "order_no" => $order->order_no,
                "receiver_name" => $order->receiver_name,
                "receiver_address" => $order->receiver_address,
                "receiver_phone" => $order->receiver_phone,
                "shipping_fee" => $order->shipping_fee
            ];
        }

        $result = [
            "draw" => $draw,
            "iTotalRecords" => intval($limit),
            "iTotalDisplayRecords" => intval($totalOrders),
            "aaData" => $resData
        ];

        return response()->json([
            "status" => true,
            "message" => "Orders Data",
            "data" => $result
        ], 200);
    }

    public function delete(Request $request)
    {
        $orderId = $request->id;
        
        DB::table('order')->where('id', $orderId)->delete();
        DB::commit();
    }    
}
