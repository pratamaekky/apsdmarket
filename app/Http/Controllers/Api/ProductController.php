<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

use App\Http\Controllers\TransformerController;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public $productData;

    public function __construct()
    {
        $this->product = new Product;
    }

    public function data(Request $request)
    {
        $resData = [];
        $params = $request->query();
        $totalProducts = DB::table('tbl_product')->get()->count();

        $draw = isset($params['draw']) ? $params['draw'] : 0;
        $start = isset($params['start']) ? $params['start'] : 0;
        $limit = isset($params['length']) ? $params['length'] : 10;

        $productsData = $this->product->getAll($start, $limit);
        foreach ($productsData as $product) {
            $resData[] = [
                "id" => $product->id,
                "sku" => $product->sku,
                "name" => $product->name,
                "type" => TransformerController::convertProductType($product->type),
                "description" => $product->description,
                "price" => intval($product->price)
            ];
        }

        $result = [
            "draw" => $draw,
            "iTotalRecords" => intval($limit),
            "iTotalDisplayRecords" => intval($totalProducts),
            "aaData" => $resData
        ];

        return response()->json([
            "status" => true,
            "message" => "Product Data",
            "data" => $result
        ], 200);
    }

    public function detail(int $productId)
    {
        $product = $this->product->single($productId);

        return response()->json([
            "status" => true,
            "message" => "Product Detail",
            "data" => $product
        ], 200);
    }

    public function save(Request $request)
    {
        $file = $request->file('image');

        $productName = "product-" . time() . "." . $file->getClientOriginalExtension();

        DB::beginTransaction();
        $product = [];
        $product['sku'] = $request->sku;
        $product['name'] = $request->name;
        $product['type'] = $request->type;
        $product['price'] = $request->price;
        $product['description'] = $request->description;
        $product['image'] = $productName;
        DB::table('tbl_product')->insert($product);
        DB::commit();

        $file->move('product/img', $productName);
    }

    public function update(Request $request, int $productId)
    {
        $product = $this->product->single($productId);

        $file = $request->file('image');
        $productName = $product->image;
        if (!is_null($file)) {
            $productName = "product-" . time() . "." . $file->getClientOriginalExtension();
            $file->move('product/img', $productName);
        }

        DB::beginTransaction();
        $product = [];
        $product['sku'] = $request->sku;
        $product['name'] = $request->name;
        $product['type'] = $request->type;
        $product['price'] = $request->price;
        $product['description'] = $request->description;
        $product['image'] = $productName;
        DB::table('tbl_product')->where('id', $productId)->update($product);
        DB::commit();
    }

    public function delete(Request $request)
    {
        $productId = $request->id;
        
        DB::table('tbl_product')->where('id', $productId)->delete();
        DB::commit();
    }
}
