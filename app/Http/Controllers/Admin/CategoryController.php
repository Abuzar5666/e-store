<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories= Category::get(['id','name']);
        return view('admin.category.index',['categories'=>$categories]);
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:categories,name'
        ]);
        Category::create([
            'name'=>$request->name
        ]);
        return redirect()->route('category.index')->with('success','Category created successfull');
    }

    public function edit($id){
        $category=Category::find($id,['id','name']);
        return view('admin.category.edit',['category'=>$category]);
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required|unique:categories,name,except'.$id,
    
        ]);

        Category::find($id)->update([
            'name'=>$request->name,
        ]);
        return redirect()->route('category.index')->with('success','category updated successfull');
        
    }

    public function delete($id){
        // return $id;
        Category::find($id)->delete();
        return redirect()->route('category.index')->with('success','category deleted successfull');
    }

}
