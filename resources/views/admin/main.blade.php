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
                <div class="card border-0 shadow mb-4 " style="height: 550px" >
                    <h4 class="text-center my-auto">Welcome to admin page</h4>
                </div>
                

               
                </div>                
            </div>
        </div>
    </div>
</section>
    
@endsection