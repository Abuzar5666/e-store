<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // SHOW home page
    public function home(){
        return view('index');
    }

    public function findProductPage(){
        $products=Product::with('productImage')->get();
        // return $products;
    
        return view('productspage.findProduct');
    }

}
