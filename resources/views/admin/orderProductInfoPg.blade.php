@extends('layouts.admin')

@section('title', 'orderProductInfoPage')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height:80vh;">
    
    <div class="card  p-4" style="width: 400px;">

        <h4 class="mb-3">Product Information</h4>

        <img src="{{ asset('storage/'.$order->item_image) }}" width="120" class="mx-auto mb-3">

        <div class="container d-grid justify-content-center">
        <p><strong>Order Id:</strong> {{ $order->id }}</p>
        <p><strong>Customer Id:</strong> {{ $order->user_id }}</p>
        <p><strong>Product Id:</strong> {{ $order->product_id }}</p>
        <p><strong>Product Name:</strong> {{ $order->item_name }}</p>
        <p><strong>Product Quantity:</strong> {{ $order->quantity }}</p>
        <p><strong>Total Price:</strong> {{ $order->total }}</p>
        </div>

        <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <hr>
    <div class="mb-3">
        <div class="d-flex">
        <label class="me-3">Current status:</label> <p><strong>{{$order->status}}</strong></p>
        </div>

        <label class="form-label">Change Order Status</label>
        <select name="status" class="form-select" onchange="this.form.submit()">
            <option disabled selected>Select option</option>
            <option value="shipped">Mark Shipped</option>
            <option value="completed">Mark completed</option>
            <option value="pending">Mark Pending</option>
            <option value="cancelled">Mark Cancelled</option>
        </select>
    </div>
</form>





    

</div>

@endsection