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
                        <div class="card-body card-form" style="height: 400px">
                            <div class="d-flex justify-content-between">

                                <h3 class="fs-4 mb-1">Create Category</h3>
                                <a href="{{route('category.index')}}">Back Category List </a>
                               
                            </div>
                            <form action="{{route('category.store')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Name<span class="req">*</span>  </label>
                                        <input type="text" placeholder="Enter Category Name" id="title" name="name" class="form-control @error('name')is-invalid @enderror" value="{{old('name')}}">
                                        @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
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