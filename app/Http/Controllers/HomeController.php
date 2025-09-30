<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FavoriteProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // SHOW home page
    public function home(){
        return view('index');
    }

    public function findProductPage(Request $request){
        $products=Product::with('productImage');
        if($request->name != null){
            $products=$products->where('name','like','%'.$request->name.'%');
        }
        if($request->category != null){
            $products=$products->where('category_id',$request->category);
        }
        if($request->sort != null){
            $products=$products->orderBy('created_at',$request->sort);
        }
        if($request->priceSort != null){
            $products=$products->orderBy('price',$request->priceSort);
        }

        $products=$products->get();
        $categories=Category::all();
        // return $products;
        return view('productspage.findProduct',['products'=>$products,'categories'=>$categories]);
    }
    
    public function productDetailPage($id){
    
        $product=Product::with('productImage')->find($id);
        $countFP=FavoriteProduct::where(['product_id'=>$id,'user_id'=>Auth::id()])->count();
        return view('productspage.productDetail',['product'=>$product,'countFP'=>$countFP]);
    }


}
