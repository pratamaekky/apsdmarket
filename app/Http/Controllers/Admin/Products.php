<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Models\Product;

class Products extends Controller
{
    public function lists()
    {
        return view('admin.product');
    }

    public function data(Request $request)
    {
        $url = 'api/product/data';
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
                $row['price'] = 'IDR ' . number_format($val['price'], 0, ',', '.');
                $row['action'] = "<a class='btn btn-sm btn-primary mr-2' href='". url('cms/products/edit/') . "/" . $val["id"] ."' aria-expanded='true'><i class='fas fa-pencil-alt'></i></a>
                                  <a class='btn btn-sm btn-danger mr-2' href='#' onclick='deleteProduct(" . $val["id"] . ")' aria-expanded='true'><i class='fas fa-trash'></i></a>";

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

    public function add()
    {
        return view('admin.productadd');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'sku' => 'required',
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $url = 'api/product/save';
        $request = Request::create($url, 'POST');
        $response = Route::dispatch($request);

        return redirect('/cms/products');
    }

    public function edit(int $productId)
    {
        $url = 'api/product/detail/' . $productId;
        $request = Request::create($url, 'GET');
        $response = Route::dispatch($request)->getOriginalContent();

        return view('admin.productedit', ['product' => $response['data']]);
    }

    public function update(Request $request, int $productId)
    {
        $this->validate($request, [
            'sku' => 'required',
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $url = 'api/product/update/' . $productId;
        $request = Request::create($url, 'POST');
        $response = Route::dispatch($request);

        return redirect('/cms/products');
    }

    public function delete(Request $request)
    {
        $url = 'api/product/delete';
        $request = Request::create($url, 'POST');
        $response = Route::dispatch($request);

        return true;
    }
}
