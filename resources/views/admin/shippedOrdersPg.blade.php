@extends('layouts.admin')

@section('title', 'ShippedOrders-Page')

@section('content')

<div class="container mt-3">
<h3>SHIPPED ORDERS</h3>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Order Id</th>
      <th scope="col">Customer Id</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Address</th>
      <th scope="col">Status</th>
      <th scope="col">Buttons</th>
    </tr>
  </thead>

  <tbody>
    @foreach($orders as $order)
      <tr>
        <th scope="row">{{ $order->id }}</th>
        <td>{{ $order->user_id }}</td>
        <td>{{ $order->name }}</td>
        <td>{{ $order->address }}</td>  
        <td>{{ $order->status }}</td>
        <td>
            <!-- Example buttons -->
            <a href="{{route('admin.orders.products', $order->id)}}" class="btn btn-success btn-sm">Check Product Info</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

</div>

@endsection