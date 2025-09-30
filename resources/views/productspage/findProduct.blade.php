@extends('masterlayout.master')
@section('main')
<section class="section-3 py-5 bg-2 ">
    <div class="container">     
        <div class="row">
            <div class="col-6 col-md-10 ">
                <h2>Find Products</h2>  
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-md-10 mx-auto">
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
            </div>
        </div>

        <div class="row pt-5">
            <form class="col-md-4 col-lg-3 sidebar mb-4">
                <div class="card border-0 shadow p-4">
                    <div class="mb-4">
                        <h2>Product</h2>
                        <input type="text" placeholder="Enter Name" name="name" value="{{request('name')}}" class="form-control">
                    </div>
                    <div class="mb-4">
                        <h2>Category</h2>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select a Category</option>
                            @foreach ($categories as $category )
                            <option value="{{$category->id}}" {{request('category')==$category->id ? 'selected' : null}}>{{$category->name}}</option>
                            @endforeach
                           
                        </select>
                    </div>                   


                    <div class="mb-4">
                        <h2>Sort</h2>
                            <select name="sort" id="sort" class="form-control">
                                <option value="" selected>Sort</option>
                                <option value="DESC" {{request('sort')=='DESC' ? 'selected' : null}}>Latest</option>
                                <option value="ASC"  {{request('sort')=='ASC' ? 'selected' : null}}>Oldest</option>
                        </select>
                    </div>                    
                    <div class="mb-4">
                        <h2>Price</h2>
                            <select name="priceSort" id="sort" class="form-control">
                                <option value="" selected>Select Price</option>
                                <option value="DESC" {{request('priceSort')=='DESC' ? 'selected' : null}}>highest</option>
                                <option value="ASC" {{request('priceSort')=='ASC' ? 'selected' : null}}>lowest</option>
                        </select>
                    </div>                    
                    <div class="mb-4">
                       <button class="btn btn-success " type="submit">Search</button>
                    </div>                    
                </div>
            </form>
            <div class="col-md-8 col-lg-9 ">
                <div class="job_listing_area">                    
                    <div class="job_lists">
                    <div class="row">   
                        @foreach ($products as $product )        
                        <div class="col-md-4">
                                <div class="card border-0 p-3 shadow mb-4" style="width: 18rem;">
                                    @php
                                       $image= $product->productImage->first();
                                      $firstImage=$image->image;
                                    @endphp
                                    <div class=" d-flex justify-content-between  px-1 " style="height: 170px">
                                        <img src="{{asset('productImage/'.$firstImage)}}" class="card-img-top" alt="..." style="">   
                                    </div>  
                                    <div class="card-body">
                                      <h5 class="card-title">{{$product->name}}</h5>
                                      <h6 class="card-title">Rs:{{number_format($product->price,2)}}</h6>
                                      <div class="d-flex justify-content-between">
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="btn btn-primary">Add to <i class="fa-solid fa-cart-shopping"></i></button>
                                            </form>
                                            <a href="{{route('home.productDetail',$product->id)}}" class="btn btn-primary">Detail</a>
                                     </div>
                                    
                                    </div>
                                  </div>
                        </div>              
                        @endforeach

                    </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
    
@endsection