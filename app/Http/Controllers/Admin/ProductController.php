<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(){
        $products=Product::all();
        // return $products;
        return view('admin.product.index',['products'=>$products]);
    }

    public function create(){
        $categories=Category::all(['id','name']);
        return view('admin.product.create',['categories'=>$categories]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        try {
            DB::beginTransaction();
            
            $product_id= Product::create([
                 'name'=>$request->name,
                 'category_id'=>$request->category_id,
                 'price'=>$request->price,
                 'description'=>$request->description,
             ]);
             
             $validated = $request->validate([
                'image' => 'required|array',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
             if($request->has('image')){
                     $images=$request->file('image');
                     foreach ($images as $image) {
                         $ext=$image->getClientOriginalExtension();
                         $string = Str::random(10);
                         $imagename=time().$string.'.'.$ext;
                         $image->move(public_path('productImage/'),$imagename);
                         ProductImage::create([
                             'product_id'=> $product_id->id,
                             'image'=>$imagename
                         ]);
                     }
                     
                    }
                    DB::commit();
                    return redirect()->route('product.index')->with('success','product created successfull');
                } 
            catch (\Exception $e) {
                // Roll back if error
                DB::rollBack();
                return redirect()->route('product.index')
                                 ->with('error', 'Something went wrong. Please try again.'.$e->getMessage());
            }
        
        }

        // show single product detail
        public function show($id){
            $product=Product::with(['productImage'])->find($id);
            // return $product;
            return view('admin.product.show',['product'=>$product]);
        }
    
}
