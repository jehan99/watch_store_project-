@extends('layouts.app')

@section('title', 'order-summery-page')

@section('content')


<div class="bg-ord-sum">
<div class="container"  data-aos="fade-up">
<div class="row pt-5 pb-5  justify-content-center">


<div class="col-md-8">


<div class="card p-5 shadow fs-5">

<h1 class="text-center text-success">ORDER SUMMERY</h1>
<!-- Product Info Start --->
<hr>
<h3>Product Summery</h3>
<hr>
@if($product)
<div class="mx-auto mb-3">
<img src="{{ asset('storage/' . ($product->mainImage->image_path ?? 'default.png')) }}" width="150" class="mb-3 rounded-3 ">
<p><strong>Product:</strong> {{ $product->title }}</p>
<p><strong>Price:</strong> Rs {{ $product->price }}</p>
<p><strong>Quantity:</strong> {{ $quantity }}</p>
<p><strong>Total Price:</strong> Rs {{ isset($total) ? $total : $product->price }}</p>

</div>

@endif

<!-- Product Info end -->

<hr>
<!-- Delivery Info Start --->
<h3>Delivery Information Summery</h3>
<hr>

@if($delivery)  
<div class="mx-auto mb-3">
<p><strong>Name:</strong> {{ $delivery->name }}</p>
<p><strong>Email:</strong> {{ $delivery->email }}</p> 
<p><strong>Contact Number:</strong> {{ $delivery->number }}</p>
<p><strong>Address:</strong> {{ $delivery->address }}</p>
<p><strong>Province:</strong> {{ $delivery->province }} </p>

<div class="">
<p class="text-warning mb-0 fw-bold ">Delivery method Cash on delivery</p>
<p>(Your Order Will delivered with in 7-14 days)</p>
</div>

</div>

<!-- Delivery Info End -->


<form action="{{ route('order.store') }}" method="POST">
    @csrf

    <!-- Hidden product data -->
      <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="quantity" value="{{ $quantity }}">

    <!-- Hidden delivery data -->
    <input type="hidden" name="name" value="{{ $delivery->name }}">
    <input type="hidden" name="email" value="{{ $delivery->email }}">
    <input type="hidden" name="number" value="{{ $delivery->number }}">
    <input type="hidden" name="address" value="{{ $delivery->address }}">
    <input type="hidden" name="province" value="{{ $delivery->province }}">

    <div class="text-center">
    <button type="submit" class="btn btn-success fs-5" style="width:200px; height:50px;">Confirm Order</button>
    </div>
</form>
 
    @else
        <p>Record not found.</p>
    @endif



    </div>

    </div>
</div>
</div>



</div>


@endsection