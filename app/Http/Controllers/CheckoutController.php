<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\order;
use App\Models\order_item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(){
        $cartItem=Cart::with(['product','product.productImage','product.productCategory'])->where('user_id',Auth::id())->get();
        $user=User::find(Auth::id());
        // return $user;
        
        return view('user.checkout.index',['cartItem'=>$cartItem]);
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
        $request->validate([
            'address'        => 'required|string|max:255',
            'number'          => 'required|string|min:10|max:15',
            'payment_method' => 'required|in:onDelivery,card',
        ]);
        
        User::where('id',Auth::id())->update([
            'address'=>$request->address,
            'number'=>$request->number,
        ]);

        $cartItem=Cart::with(['product'])->where('user_id',Auth::id())->get();
        // return $cartItem;

        if ($cartItem->isEmpty()) {
            // If the cart is empty, rollback and inform the user
            DB::rollBack();
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

       $order= order::create([
            'user_id'=>Auth::id(),
            'payment_method'=>$request->payment_method,
            'total'=>collect($cartItem)->sum(fn($item)=>$item->product->price * $item->qty),
        ]);
        foreach($cartItem as $item){

            order_item::create([
                'order_id'=>$order->id,
                'product_id'=>$item->product->id,
                'qty'=>$item->qty,
                'price'=>$item->product->price
                
            ]);
        }
        Cart::where('user_id',Auth::id())->delete();

        DB::commit();
          return redirect()
            ->route('home.product')
            ->with('success', 'Your order was placed successfully.');
         
         
         //code...
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('home.product')->with('error',$th->getMessage());
            //throw $th;
         }

    }
}
