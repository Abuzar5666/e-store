<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\order_item;
use Illuminate\Http\Request;

class BuyProductController extends Controller
{
    // show all buy product
    public function index(){

        $orderItem=order_item::with(['order','product','product.productImage','order.user'])->get();
        // return $orderItem;
        return view('admin.buyProduct.index',['orderItem'=>$orderItem]);

    }
}
