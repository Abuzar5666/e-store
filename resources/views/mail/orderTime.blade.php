<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>

<body>
	

{{-- # Order Received — #{{ $orderDetail->id }} --}}

Thank you for your purchase! Here are your order details:

{{-- **Order Date:** {{ $order->created_at->toDateTimeString() }} --}}

## Items Purchased

{{-- @foreach ($orderDetail as $item) --}}
- **Product:** {{ $orderDetail->product->name }}  <br>
  **Quantity:** {{ $orderDetail->qty }}  <br>
  **Price:** {{ $orderDetail->price }}  <br>
{{-- @endforeach --}}

**Total Price:** {{ $orderDetail->price * $orderDetail->qty }}

Thanks for shopping with us!  
		

	
</body>
</html>