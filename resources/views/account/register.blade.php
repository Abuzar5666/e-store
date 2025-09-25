@extends('masterlayout.master')

@section('main')
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Register</h1>
                    <form action="{{route('account.registerProcess')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="mb-2">Name*</label>
                            <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" name="email" id="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email">
                            @error('email')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Password*</label>
                            <input type="password" name="password" id="name" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password">
                            @error('password')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" name="confirm_password" id="name" value="{{old('confirm_password')}}" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Enter Password">
                            @error('confirm_password')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div> 
                        <button class="btn btn-primary mt-2">Register</button>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Have an account? <a  href="{{route('account.login')}}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection