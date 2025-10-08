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
                    <div class="col-lg-12" >
                        <div class="card border-0 shadow mb-4 p-3">
                            <div class="card-body card-form" style="height: 550px">
                                <div class="d-flex justify-content-between">

                                    <h3 class="fs-4 mb-1">Buy Products</h3>
                                </div>

                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead class="bg-light">
                                            <tr>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border-0">
                                            @foreach ($orderItem as $item )  
                                                <tr class="active">
                                                    <td>
                                                        <div class="job-name fw-500">{{$item->product->name}}</div>
                                                    </td>
                                                    <td>{{$item->product->price}}</td>
                                                    <td>{{$item->order->status}}</td>
                                                    @php
                                                        $image=$item->product->productImage->first();
                                                        $firstImage=$image->image;
                                                        // echo $firstImage;
                                                    @endphp
                                                    <td class="w-25"><img class="w-50" src="{{asset('productImage/'.$firstImage)}}" alt=""></td>
                                                    <td>
                                                        <div class="action-dots ">
                                                            <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </a>
                                                            {{-- <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="{{route('category.edit', $category->id)}}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></li>
                                                                <form action="{{route('category.delete',$category->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <li><button type="submit" class="dropdown-item"><i class="fa fa-trash" aria-hidden="true"></i> Remove</button></li>
                                                                </form>
                                                            </ul> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach                                     
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 
                    </div>
                    

               
                </div>                
            </div>
        </div>
    </div>
</section>
    
@endsection