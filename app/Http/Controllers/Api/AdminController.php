<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function data(Request $request)
    {
        $resData = [];
        $params = $request->query();
        $totalOrders = DB::table('tbl_admin')->get()->count();

        $draw = isset($params['draw']) ? $params['draw'] : 0;
        $start = isset($params['start']) ? $params['start'] : 0;
        $limit = isset($params['length']) ? $params['length'] : 10;

        $adminsData = DB::table('tbl_admin')->offset($start)->limit($limit)->get();
        foreach ($adminsData as $admin) {
            $resData[] = [
                "id" => $admin->id,
                "name" => $admin->name,
                "username" => $admin->username,
                "role" => ucwords($admin->role),
                "last_login" => $admin->last_login
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

    public function save(Request $request)
    {
        DB::beginTransaction();
        $product = [];
        $product['name'] = $request->name;
        $product['username'] = $request->username;
        $product['role'] = $request->role;
        $product['password'] = Hash::make($request->password);
        DB::table('tbl_admin')->insert($product);
        DB::commit();
    }

    public function delete(Request $request)
    {
        $adminId = $request->id;
        
        DB::table('tbl_admin')->where('id', $adminId)->delete();
        DB::commit();
    }    
}
