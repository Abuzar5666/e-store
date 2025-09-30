<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FavoriteProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteProductController extends Controller
{
    public function favoriteProduct($id){
        // return $id;
        $checkProduct=FavoriteProduct::where(['product_id'=>$id,'user_id'=>Auth::id()])->count();
        if($checkProduct > 1){
            session()->flash('error','product already added to favorite');
            return redirect()->back();
        }
        // return $checkProduct;
        FavoriteProduct::firstOrCreate([
            'user_id'=>Auth::id(),
            'product_id'=>$id,
        ]);
        return redirect()->back()->with('success','product added favorite successfull');
    }
    
    
    public function index(){
        $product=FavoriteProduct::with(['product','product.productImage'])->where('user_id',Auth::id())->paginate(4);    
        return view('user.favoriteProduct.index',['product'=>$product]);
    }
    
    public function delete($id){
        FavoriteProduct::find($id)->delete();
        return redirect()->back()->with('success','favorite product deleted successfull');

    }

    
}

