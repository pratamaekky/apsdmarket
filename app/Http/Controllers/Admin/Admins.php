<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class Admins extends Controller
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function staff()
    {
        echo 'Halaman Staff';
    }

    public function lists()
    {
        return view('admin.admin');
    }

    public function data(Request $request)
    {
        $url = 'api/admin/data';
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
        return view('admin.adminadd');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);

        $url = 'api/admin/save';
        $request = Request::create($url, 'POST');
        $response = Route::dispatch($request);

        return redirect('/cms/admins/lists');
    }}
