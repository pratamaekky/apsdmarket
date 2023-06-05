<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Models\Product;

class Orders extends Controller
{
    public function lists()
    {
        return view('admin.order');
    }

    public function data(Request $request)
    {
        $url = 'api/order/data';
        $params = request()->query();
        $request = Request::create($url, 'GET');
        $response = Route::dispatch($request)->getOriginalContent();
        $response = $response;

        $draw = 1;
        $totalRecods = 0;
        $totalDisplays = 0;

        if ($response['status']) {
            $data = $response['data'];

            foreach ($data['aaData'] as $key => $val) {
                $row = $val;
                $row['no'] = ($key + 1);
                $row['shipping_fee'] = 'IDR ' . number_format($val['shipping_fee'], 0, ',', '.');
                $row['action'] = "<a class='btn btn-sm btn-danger mr-2' href='#' onclick='deleteOrder(" . $val["id"] . ")' aria-expanded='true'><i class='fas fa-trash'></i></a>";

                $items[] = $row;
            }

            $draw = $data['draw'];
            $totalRecods = $data['iTotalRecords'];
            $totalDisplays = $data['iTotalDisplayRecords'];
        }

        $result = [
            "draw" => $draw,
            "recordsTotal" => $totalRecods,
            "recordsFiltered" => $totalDisplays,
            "data" => $items
        ];

        echo json_encode($result);
    }

    public function delete(Request $request)
    {
        $url = 'api/order/delete';
        $request = Request::create($url, 'POST');
        $response = Route::dispatch($request);

        return true;
    }
}