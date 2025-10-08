<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $cartItem=Cart::with(['product','product.productImage','product.productCategory'])->where('user_id',Auth::id())->get();
        // return $cartItem;
        return view('user.cart.index',['cartItem'=>$cartItem]);
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

    public function delete($id)
    {
        // 1. Find the cart item belonging to the current user
        $cartItem = Cart::where([
            'id' => $id,
            'user_id' => Auth::id(),
        ])->first();
    
        // 2. If not found, redirect back with error message
        if (! $cartItem) {
            return redirect()->back()->withErrors(['error' => 'Cart item not found or not authorized.']);
        }
    
        // 3. Delete the item
        $cartItem->delete();
    
        // 4. Redirect back with success message
        return redirect()->back()->with('success', 'Item removed from cart.');
    }
    
    
    public function update(Request $request, $id)
    {
        // 1. Validate input
        $validated = $request->validate([
            'qty' => 'required|integer|min:1|max:20',  
        ]);
    
        // 2. Find the cart item for this user
        $cartItem = Cart::where([
            'id' => $id,
            'user_id' => Auth::id(),
        ])->first();
    
        if (! $cartItem) {
            // Agar record nahin milta, user ko back bhej ke error message
            return redirect()->back()->withErrors(['error' => 'Cart item not found or not authorized.']);
        }
    
        // 3. Update quantity
       $cartItem->update([
        'qty'=>$request->qty
       ]);
        return redirect()->back()->with('success', 'Cart updated successfully.');
    }
}
