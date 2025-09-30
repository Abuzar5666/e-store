@extends('masterlayout.master')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
                @include('masterlayout.side')
            <div class="col-lg-9">
                <div class="col-lg-9" >
                    @if(Session::has('error'))
                        
                    <div class="alert alert-warning alert-dismissible fade show " role="alert">
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
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="card-body card-form" style="height: 550px">
                            <div class="d-flex justify-content-between">

                                <h3 class="fs-4 mb-1">Favorite Product</h3>
                            </div>

                            <div class="table-responsive">
                                <table class="table ">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($product->isEmpty())
                                        <tr>
                                          <td colspan="4" class="text-center">No data found.</td>
                                        </tr>
                                      @else
                                        @foreach ($product as $item )  
                                        <tr class="active">
                                                <td>{{$item->product->name}}</td>
                                                <td>{{number_format($item->product->price,2)}}</td>
                                                @php
                                                $image= $item->product->productImage->first();
                                                $firstImage=$image->image;
                                                @endphp
                                                <td class="w-25"><img src="{{asset('productImage/'.$firstImage)}}" alt="noooo" class="w-75"></td>
                                                <td>
                                                    <div class="action-dots ">
                                                        <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="{{route('home.productDetail',$item->product->id)}}"><i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                            <form action="{{route('home.favorite.delete',$item->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')

                                                                <li><button type="submit" class="dropdown-item"><i class="fa fa-trash" aria-hidden="true"></i> Remove</button></li>
                                                            </form>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach   
                                            @endif
                                        </tbody>
                                </table>
                                {{ $product->links() }}

                            </div>
                        </div>
                    </div> 
                </div>
                
            </div>
        </div>
    </div>
</section>
    
@endsection