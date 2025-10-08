@extends('masterlayout.master')

@section('main')
<div class="container mt-4 py-4" >
    <h2 class="mb-4">Checkout</h2>

    <div class="row">
        <!-- Order Summary -->
        <div class="col-md-6">
            <h4>Your Order</h4>
            <ul class="list-group mb-3">
                @foreach($cartItem as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item->product['name'] }} (x{{ $item['qty'] }})
                        <span>Rs {{ number_format($item->product['price'] * $item['qty'],2) }}</span>
                    </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between fw-bold">
                    @php
                    $subTotal= $cartItem->sum(fn($item) => $item->product->price * $item->qty);
                    // $shipping=100;
                    // $tax=50;
                    // $total=$subTotal+$shipping+$tax;
                    // echo $total;
                  @endphp
                    <span>Total</span>
                    <span>
                        Rs {{ number_format($subTotal) }}
                    </span>
                </li>
            </ul>
        </div>
        
        <!-- Checkout Form -->
        <div class="col-md-6">
            <h4>Shipping Details</h4>
            <form action="{{route('checkout.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="address" class="form-label">Shipping Address</label>
                    <textarea name="address" id="address" class="form-control" rows="3">{{Auth::user()->address}}</textarea>
                    @error('address')
                    <p class="text-danger">{{$message}}</p>    
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" name="number" id="phone" class="form-control" value="{{old('number',Auth::user()->number)}}" placeholder="03XXXXXXXXX">
                    @error('number')
                    <p class="text-danger">{{$message}}</p>    
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Payment Method</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="onDelivery" checked>
                        <label class="form-check-label" for="cod">
                            Cash on Delivery
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="card" value="card">
                        <label class="form-check-label" for="card">
                            Credit / Debit Card
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    Place Order
                </button>
            </form>
        </div>
    </div>
</div>
@endsection