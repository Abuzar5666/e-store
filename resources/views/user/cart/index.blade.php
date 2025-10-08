@extends('masterlayout.master')

@section('main')
<div class="container my-5">
  <h2 class="mb-4">Your Shopping Cart</h2>
  <div class="col-6 col-md-12 mx-auto">
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

  <div class="card">
    <div class="card-body">
      <!-- Cart Items -->
      <div class="row gx-3">
        @if($cartItem->isEmpty())
       
           <div class="col-lg-8" style="height: 40vh" >
            <div class="col-lg-8 text-center text-muted">
              No data found.
            </div>

        </div>
        @else

        @foreach ($cartItem as $item )

        <div class="col-lg-8">
          <div class="cart-items">
            <!-- Repeat this block per cart item -->
            <div class="card mb-3">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-md-3">
                    @php
                    $image=$item->product->productImage->first();
                    $firstImage=$image->image;
                    @endphp
                    <img src="{{asset('productImage/'.$firstImage)}}" alt="Product" class="img-fluid rounded">
                  </div>
                  <div class="col-md-4">
                    <h5 class="card-title">{{$item->product->name}}</h5>
                    <p class="text-muted">{{$item->product->productCategory->name}}</p>
                  </div>

                  <div class="col-md-2">
                    <form method="POST" action="{{route('cart.update',$item->id)}}">
                      @csrf
                      @method('PUT')
                      <div class="input-group">
                        <input type="number" name="qty" min="1" max="20"
                          class="form-control form-control-sm text-center" value="{{ $item->qty }}">
                      </div>
                      <button type="submit" class="btn btn-sm btn-outline-secondary mt-2">Update</button>
                    </form>
                  </div>
                  <div class="col-md-3 text-end">
                    <p class="mb-1"> <small>Unit Price:{{number_format($item->product->price,2)}}</small> </p>
                    <p class="fw-bold">Total Price:{{number_format($item->product->price * $item->qty,2)}}</p>
                    <a class="btn btn-sm btn-outline-danger" href="{{route('cart.delete',$item->id)}}">Remove</a>
                  </div>

                </div> <!-- /.row align-items-center -->
              </div> <!-- /.card-body -->
            </div> <!-- /.card mb-3 -->
            <!-- End repeat block -->
          </div>
        </div>
        @endforeach


        <!-- Order summary / checkout column -->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4">Order Summary</h5>
              <div class="d-flex justify-content-between mb-3">
                <span>Subtotal</span>
                {{-- <span>$199.97</span> --}}
                @php
                $subTotal= $cartItem->sum(fn($item) => $item->product->price * $item->qty);
                $shipping=100;
                $tax=50;
                $total=$subTotal+$shipping+$tax;
                // echo $total;
                @endphp

                <span>Rs {{ number_format($subTotal, 2) }}</span>
              </div>
              {{-- <div class="d-flex justify-content-between mb-3">
                <span>Shipping</span>
                <span>Rs:{{$shipping}}</span>
              </div>
              <div class="d-flex justify-content-between mb-3">
                <span>Tax</span>
                <span>Rs:{{$tax}}</span>
              </div> --}}
              <hr>
              {{-- <div class="d-flex justify-content-between mb-4">
                <strong>Total</strong>
                <strong>Rs:{{number_format($total,2)}}</strong>
              </div> --}}
              <a class="btn btn-primary w-100" href="{{route('checkout.index')}}">Proceed to Checkout</a>
            </div>
          </div>
        </div> <!-- /.col-lg-4 -->

        @endif
      </div> <!-- /.row gx-3 -->
    </div> <!-- /.card-body -->
  </div> <!-- /.card -->
</div> <!-- /.container -->




@endsection