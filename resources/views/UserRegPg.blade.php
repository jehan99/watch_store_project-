@extends('layouts.app')

@section('title', 'User-Reg-page' )
@section('content')

<div class="bg-reg">

<div class="container vh-100 " data-aos="fade-up">
<div class="row  justify-content-center align-items-center h-100">
<div class="col-10 col-md-7 col-lg-5 col-xl-4 bg-reg-1">

<form action="register" method="POST" onsubmit="return validateForm()">
@csrf
<h1 class="text-center mb-5">User Registration</h1>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Create User Name :</label>
    <input type="text" name="name" id="name" class="form-control">
    <p id="nameErrorMsg" class="text-danger  fw-bold"></p>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Enter Email: </label>
    <input type="email" name="email" id="email" class="form-control">
    <p id="emailErrorMsg" class="text-danger  fw-bold"></p>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Create Password :</label>
    <input type="password" name="password" id="password" class="form-control">
    <p id="passwordErrorMsg" class="text-danger  fw-bold"></p>
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Confirm Password :</label>
    <input type="password" name="password_confirmation" id="confirmPassword" class="form-control">
    <p id="conPassErrorMsg" class="text-danger  fw-bold"></p>
  </div>

<div class="text-center">
  <button type="submit" class="btn btn-primary mt-4" style="width: 200px; height:40px;">Register</button>
  </div>
</form>

</div>
</div>
</div>

</div>


<script>
function validateForm() {

    let valid = true;

    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;

    let nameError = document.getElementById("nameErrorMsg");
    let emailError = document.getElementById("emailErrorMsg");
    let passwordError = document.getElementById("passwordErrorMsg");
    let confirmError = document.getElementById("conPassErrorMsg");

    // Clear errors
    nameError.innerHTML = "";
    emailError.innerHTML = "";
    passwordError.innerHTML = "";
    confirmError.innerHTML = "";

    // Name
    if (name === "") {
    nameError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i> Name is required';
    valid = false;
}
else if (name.length < 3) {
    nameError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i> Minimum 3 characters required';
    valid = false;
} 
else if (name.length > 6) {
    nameError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i> Maximum 6 characters allowed';
    valid = false;
} 
else {
    nameError.innerHTML = '';
}
    // Email
    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/;
    if (!email.match(emailPattern)) {
        emailError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i> Enter a valid email';
        valid = false;
    }

    // Password
    let pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;

    if (password.length < 6) {
        passwordError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i> Minimum 6 characters';
        valid = false;
    } else if (!password.match(pattern)) {
        passwordError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i> Must include uppercase, lowercase & number';
        valid = false;
    }

    // Confirm Password
    if (password !== confirmPassword) {
        confirmError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i> Passwords do not match';
        valid = false;
    }

    return valid; //  THIS controls submission
}
</script>

@endsection