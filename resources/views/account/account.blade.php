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
                <div class="card border-0 shadow mb-4">
                    <form action="{{route('account.updateProfile')}}" method="POST">
                        @csrf
                    <div class="card-body  p-4">
                        <h3 class="fs-4 mb-1">My Profile</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">Name*</label>
                            <input type="text" placeholder="Enter Name" name="name" value="{{ old('name', $user->name) }}"class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" placeholder="Enter Email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" >
                            @error('email')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Mobile*</label>
                            <input type="text" placeholder="Mobile" class="form-control" name="number" value="{{ old('number', $user->number) }}">
                        </div>                        
                    </div>
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                </div>

                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <h3 class="fs-4 mb-1">Change Password</h3>
                        <form action="{{route('account.updatePasswrod')}}" method="POST">
                            @csrf
                        <div class="mb-4">
                            <label for="" class="mb-2">Old Password*</label>
                            <input type="password" placeholder="Old Password" name="old_password" class="form-control @error('old_password') is-invalid @enderror">
                            @error('old_password')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">New Password*</label>
                            <input type="password" placeholder="New Password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror">
                            @error('confirm_password')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>  
                        
                    </div>
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                </div>                
            </div>
        </div>
    </div>
</section>
    
@endsection