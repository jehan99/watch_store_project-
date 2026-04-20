@extends('layouts.admin')

@section('title', 'CustumerList-Page')

@section('content')


<div class="container mt-3">
  <h3>Cusotmer List</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">User Id</th>
      <th scope="col">User Name</th>
      <th scope="col">Email</th>
      <th scope="col">Created date & time</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>


    </tr>
  </thead>

  <tbody>
    @foreach($users as $user)
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->created_at}}</td>
        <td class="{{ $user->status == 'active' ? 'text-success' : 'text-danger' }}">{{$user->status}}</td>
        
        <td>

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
    {{ $user->status }}
  </button>

  <ul class="dropdown-menu">
    <li>
      <form action="{{ route('admin.user.status', $user->id) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="active">
        <button class="dropdown-item">Active</button>
      </form>
    </li>

    <li>
      <form action="{{ route('admin.user.status', $user->id) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="block">
        <button class="dropdown-item">Block</button>
      </form>
    </li>

    <li>
      <form action="{{ route('admin.user.status', $user->id) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="deactive">
        <button class="dropdown-item">Deactive</button>
      </form>
    </li>
  </ul>
</div>


</td>



        </td>
    </tr>
    @endforeach
</tbody>

</table>

</div>

@endsection