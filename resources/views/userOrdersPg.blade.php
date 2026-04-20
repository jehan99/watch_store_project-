@extends('layouts.app')

@section('content')

<div class="container">
<div class="row justify-center"> 
<h2>My Orders</h2>




@foreach($orders as $order)

@php
    $isCancelled = $order->status === 'cancelled';
    $isCompleted = $order->status === 'completed';

@endphp

<div class="col-12">
<div class="card mt-5 mb-4 h-4 p-3 {{ ($isCancelled  || $isCompleted ) ? 'bg-light text-muted' : '' }}" 
         style="{{ ($isCancelled  || $isCompleted ) ? 'pointer-events: none; opacity: 0.6;' : '' }}">
        

<h5>Product Summery</h5>

<p class="text-danger">Please note after 1 day the order can not be modified or deleted.</p>

<img src="{{ asset('storage/' . $order->item_image) }}" width="100">

<h6>Order Number: {{ $order->id }}</h6>

        <h6><strong>Product Name:</strong> {{ $order->item_name }}</h6>


        <p style="margin: 0;"><strong>Quantity:</strong> {{ $order->quantity }}</p>
        <p style="margin: 0;"><strong>Item Price:</strong> Rs {{ $order->price }}</p>
        <div class="text-end">
        <p style="margin: 0;"><strong>Total:</strong> Rs {{ $order->total }}</p>
        </div>

        <hr>

        <h5>Address Summery</h5>
        <p style="margin: 0;"><strong>Name:</strong> {{ $order->name }}</p>
        <p style="margin: 0;"><strong>Phone:</strong> {{ $order->phone }}</p>
        <p style="margin: 0;"><strong>Address:</strong> {{ $order->address }}</p>
        <p style="margin: 0;"><strong>Province:</strong> {{ $order->province }}</p>
        <div class="text-end">
        <p><strong>Status:</strong>  <span class="
        @if($order->status == 'pending') text-warning
        @elseif($order->status == 'shipped') text-success
        @elseif($order->status == 'cancelled') text-danger
        @endif">
         {{ $order->status }} 
        </span></p>

        @if(!$isCancelled && !$isCompleted )
                <form action="{{ route('admin.order.delete', $order->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link text-danger p-0"
                        onclick="return confirm('Are you sure you want to delete this order?')">
                        Delete Order
                    </button>
                </form>
            @else
                <p class="text-muted mb-0">This order is cancelled and cannot be modified.</p>
            @endif
        </div>

    </div>
    </div>

@endforeach


</div>
</div>

@endsection


