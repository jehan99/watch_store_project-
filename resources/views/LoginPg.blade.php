@extends('layouts.app')
@section('title', 'User-LogIn')

@section('content')
    
<div class="login-bg">
<div class="container  vh-100">
    <div class="row justify-content-center align-items-center h-100">
<div class="col-10 col-md-7 col-lg-4">

<form action="{{ route('loginUser') }}" method="POST" onsubmit="return validateLogin()">
@csrf
<div class="bg-1 p-4" data-aos="fade-up">
<h1 class="text-center mb-4">LogIn</h1>

  <div class="mb-3">
    <label  class="form-label">Email</label>
    <input type="email" id="email" name="email" class="form-control">
  
 <p id="emailError" class="text-danger fw-bold"></p>

  </div>

  <div class="mb-3">
    <label  class="form-label">Password</label>
    <input type="password" id="password" name="password" class="form-control">
    <p id="passwordError" class="text-danger fw-bold"></p>

  </div>
  
  @error ('email')
  <p class="text-danger fw-bold text-center"><i class="fa-solid fa-triangle-exclamation me-1"></i>{{ $message }}</p>
  @enderror

  <div class="text-center">
  <button type="submit" class="btn btn-primary mt-3" style="width: 200px;">Submit</button>
  </div>
</div>
</form>


</div>
</div>
</div>

</div>


<script>
function validateLogin() {

    let valid = true;

    let email = document.getElementById('email').value.trim();
    let password = document.getElementById('password').value;

    let emailError = document.getElementById('emailError');
    let passwordError = document.getElementById('passwordError');

    // Clear errors
    emailError.innerHTML = "";
    passwordError.innerHTML = "";

    // Email validation
    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/;

    if (email === "") {
        emailError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i>Email is required';
        valid = false;
    } else if (!email.match(emailPattern)) {
        emailError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i>Enter a valid email';
        valid = false;
    }

    // Password validation
    if (password === "") {
        passwordError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i>Password is required';
        valid = false;
    } else if (password.length < 6) {
        passwordError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i>Password must be at least 6 characters';
        valid = false;
    }

    return valid; //  controls form submit
}
</script>

@endsection