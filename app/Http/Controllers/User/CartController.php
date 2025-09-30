<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $cartItem=Cart::with(['product','product.productImage','product.productCategory'])->where('user_id',Auth::id())->get();
        return $cartItem;
        return view('user.cart.index');
    }

    public function store(Request $request){
        $cartCount=Cart::where(['user_id'=>Auth::id(),'product_id'=>$request->product_id])->count();
        if($cartCount > 0){

            return redirect()->back()->with('error','you already added this item');
        }
        Cart::create([
            'user_id'=>Auth::id(),
            'product_id'=>$request->product_id,
        ]);
        return redirect()->route('cart.index');
        
    }
}
