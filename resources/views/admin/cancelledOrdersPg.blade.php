@extends('layouts.admin')

@section('title', 'CancelledOrders-Page')

@section('content')


<div class="container mt-3">
  <h3>CANCELLED ORDERS</h3>
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
            <div class="d-flex">
            <a href="{{route('admin.orders.products', $order->id)}}" class="btn btn-success btn-sm me-2">Check Product Info</a>

<form action="{{route('admin.order.delete', $order->id)}}" method="POST">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger btn-sm"
      onclick="return confirm('Are you sure you want to delete this order?')">
      Delete Order</button>
 </form>       

        </div>

</td>
      </tr>

    @endforeach
  </tbody>
</table>

</div>

@endsection