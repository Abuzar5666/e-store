@extends('masterlayout.master')

@section('main')
<div class="container my-5">
    <h2 class="mb-4">Your Shopping Cart</h2>
  
    <div class="card">
      <div class="card-body">
        <!-- Cart Items -->
        <div class="row gx-3">
          <div class="col-lg-8">
            <div class="cart-items">
              <!-- Repeat this block per cart item -->
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-md-3">
                      <img src="https://via.placeholder.com/100" alt="Product" class="img-fluid rounded">
                    </div>
                    <div class="col-md-5">
                      <h5 class="card-title">Product Name</h5>
                      <p class="text-muted">Category or details</p>
                    </div>
                    <div class="col-md-2">
                      <div class="input-group">
                        <button class="btn btn-outline-secondary btn-sm" type="button">−</button>
                        <input type="text" class="form-control form-control-sm text-center" value="1">
                        <button class="btn btn-outline-secondary btn-sm" type="button">+</button>
                      </div>
                    </div>
                    <div class="col-md-2 text-end">
                      <p class="fw-bold">$99.99</p>
                      <button class="btn btn-sm btn-outline-danger">Remove</button>
                    </div>
                  </div> <!-- /.row align-items-center -->
                </div> <!-- /.card-body -->
              </div> <!-- /.card mb-3 -->
              <!-- End repeat block -->
  
              <!-- If no items -->
              <!-- <p>No items in cart.</p> -->
            </div>
          </div>
  
          <!-- Order summary / checkout column -->
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-4">Order Summary</h5>
                <div class="d-flex justify-content-between mb-3">
                  <span>Subtotal</span>
                  <span>$199.97</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                  <span>Shipping</span>
                  <span>$10.00</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                  <span>Tax</span>
                  <span>$5.00</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4">
                  <strong>Total</strong>
                  <strong>$214.97</strong>
                </div>
                <button class="btn btn-primary w-100">Proceed to Checkout</button>
              </div>
            </div>
          </div> <!-- /.col-lg-4 -->
  
        </div> <!-- /.row gx-3 -->
      </div> <!-- /.card-body -->
    </div> <!-- /.card -->
  </div> <!-- /.container -->
  
    
@endsection