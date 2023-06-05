<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->product = new Product;
    }

    public function index()
    {
        $productData = $this->product->store();

        $resData = [];
        foreach ($productData as $product) {
            $resData[] = [
                "id" => $product->id,
                "name" => $product->name,
                "sku" => $product->sku,
                "type" => TransformerController::convertProductType($product->type),
                "description" => $product->description,
                "price" => intval($product->price),
                "image" => $product->image
            ];
        }

        return view("home", ["productData" => $resData]);
    }

    public function detail(int $productId = -1)
    {
        $product = $this->product->single($productId);
        $product['type'] = TransformerController::convertProductType($product['type']);
        $product['status'] = TransformerController::convertProductStatus($product['status']);

        return view("product/detail", ["product" => $product]);
    }

    public function cart()
    {
        return view('cart');
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function submitcheckout(Request $request)
    {
        $validate = $request->validate([
            "receiver_name" => 'required',
            "receiver_address" => 'required',
            "receiver_phone" => 'required'
        ]);

        DB::beginTransaction();
        $random = rand(10000, 99999);

        $order = new Order;
        $order->order_no = 'INV/'.date('Y-m').'/'.$random;
        $order->receiver_name = $request->receiver_name;
        $order->receiver_address = $request->receiver_address;
        $order->receiver_phone = $request->receiver_phone;
        $order->shipping_fee = 10000;
        $order->status = 0;
        $order->save();

        $items = json_decode($request->items);
        $orderItem = [];
        $orderVal = 0;
        foreach ($items as $item) {
            $orderItem[] = [
                "order_id" => $order->id,
                "name" => $item->name,
                "qty" => $item->qty,
                "price" => $item->price
            ];
        }
        DB::table('order_item')->insert($orderItem);
        DB::commit();

        return redirect('/');
    }
}
