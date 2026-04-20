@extends('layouts.app')

@section('title', 'change-password-page')

@section('content')

<div class="bg-pass">

<div class="container vh-100" data-aos="fade-up">
<div class="row d-flex justify-content-center h-100 align-items-center">
<div class="card col-11 col-md-7 col-lg-6 col-xl-5 p-4 shadow">

<h1 class="text-center mb-2 fw-bold">CHANGE PASSWORD</h1>
<hr class="mb-4">
<form action= "{{route('password.change')}}" method="POST">
@csrf
  <div class="mb-3">
    <label class="form-label">Current Password: </label>
    <input type="password" name="current_password" class="form-control" required>
  </div>

  <div class="mb-3">
    <label  class="form-label">New Password</label>
    <input type="password" name="new_password" class="form-control" required>
  </div>

  <div class="mb-3">
    <label  class="form-label">Confirm New Password</label>
    <input type="password" name="new_password_confirmation" class="form-control" required>
  </div>

  <div class="text-center mt-4">
  <button type="submit" class="btn btn-primary" >Change Password </button>
  </div>

</form>



</div>
</div>
</div>

</div>





@endsection