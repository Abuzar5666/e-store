<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyProductController extends Controller
{
    // show all buy product
    public function index(){
        // $buy=order::with(['orderItem','orderItem.product','orderItem.product.productImage'])->where('user_id',Aouth::id())->get();
        // $buyItem=order_item::with(['order'])->get();
        
            $buyItems = order_item::with(['order','product','product.productImage'])
            ->whereHas('order', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();
        // return $buyItems;
        return view('user.buyProduct.index',['buyItems'=>$buyItems]);
    }
}
