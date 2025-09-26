@extends('masterlayout.master')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
        </div>
        <div class="row">
            @include('admin.side')
            <div class="col-lg-9">
                @if(Session::has('error'))
                    
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{Session::get('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                    
                @endif
                @if(Session::has('success'))
                    
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{Session::get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                    
                @endif
                <div class="col-lg-9" >
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="card-body card-form" style="height:">
                            <div class="d-flex justify-content-between">

                                <h3 class="fs-4 mb-1">Edit Product</h3>
                                <a href="{{route('product.index')}}">Back Product List </a>
                               
                            </div>
                            <form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body card-form p-4">
                                   
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="" class="mb-2">Name<span class="req">*</span></label>
                                            <input type="text" placeholder="Product Name" id="title" name="name" value="{{old('name',$product->name)}}" class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                                <p class="text-danger">{{$message}}</p>        
                                            @enderror
                                        </div>
                                        <div class="col-md-6  mb-4">
                                            <label for="" class="mb-2">Category<span class="req">*</span></label>
                                            <select name="category_id" id="category" class="form-control">
                                                <option value="" selected disabled>Select a Category</option>
                                                @foreach ($categories as $category )
                                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id) @selected($category->id==$product->category_id)>{{ $category->name }} </option>                                              
                                                @endforeach
                                                
                                            </select>
                                            @error('category_id')
                                                <p class="text-danger">{{$message}}</p>        
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="" class="mb-2">Price<span class="req">*</span></label>
                                        <input type="text" value="{{old('price',$product->price)}}" class="form-control @error('price') is-invalid @enderror" name="price" id="" placeholder="Price">
                                        @error('price')
                                            <p class="text-danger">{{$message}}</p>        
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="" class="mb-2">Description<span class="req">*</span></label>
                                        <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description">{{$product->description}}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="" class="mb-2">Image<span class="req">*</span></label>
                                        
                                        <input type="file"  class="form-control" name="image[]" accept="" multiple>

                                        @foreach($product->productImage as $image)
                                        <div>
                                            <img src="{{ asset('productImage/'.$image->image) }}" style="width: 100px">
                                            <label>
                                            Delete?
                                            <input type="checkbox" name="delete_images[]" value="{{ $image->id }}">
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            
                        </div>
                    </div> 
                </div>
                

               
                </div>                
            </div>
        </div>
    </div>
</section>
    
@endsection