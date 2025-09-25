@extends('masterlayout.master')
@section('main')

<section class="section-4 bg-2">    
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('product.index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Products</a></li>
                    </ol>
                </nav>
            </div>
        </div> 
    </div>
    <div class="container job_details_area">
        <div class="row pb-5">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                
                                <div class="jobs_conetent">
                                    <a>
                                        <h4>{{$product->name}}</h4>
                                    </a>
                                    <a>
                                        <h6>{{$product->price}}</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Product description</h4>
                            <p>{{$product->description}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Product Images</h3>
                        </div>
                        <div class="job_content pt-3">
                            @foreach ($product->productImage as $image)
                                <img src="{{asset('productImage/'.$image->image)}}" alt="fff">
                                {{-- <p>{{asset('productImage/')$image->image}}</p> --}}
                            @endforeach
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    
@endsection