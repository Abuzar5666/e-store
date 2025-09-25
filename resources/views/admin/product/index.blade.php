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
                        <div class="card-body card-form" style="height: 550px">
                            <div class="d-flex justify-content-between">

                                <h3 class="fs-4 mb-1">Products</h3>
                                <a href="{{route('product.create')}}">Create Product</a>
                            </div>

                            <div class="table-responsive">
                                <table class="table ">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @foreach ($products as $product )  
                                            <tr class="active">
                                                <td>
                                                    <div class="job-name fw-500">{{$product->id}}</div>
                                                </td>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->price}}</td>
                                                <td>
                                                    <div class="action-dots ">
                                                        <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="{{route('product.show',$product->id)}}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                            <li><a class="dropdown-item" href=""><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></li>
                                                            {{-- <form action="{{route('category.delete',$category->id)}}" method="POST"> --}}
                                                                {{-- @csrf --}}
                                                                {{-- @method('DELETE') --}}

                                                                <li><button type="submit" class="dropdown-item"><i class="fa fa-trash" aria-hidden="true"></i> Remove</button></li>
                                                            {{-- </form> --}}
                                                        </ul>
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