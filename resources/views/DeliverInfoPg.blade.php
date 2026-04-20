@extends('layouts.app')

@section('title', 'Delivery_page')

@section('content')

<div class="bg-delivery"> 

<div class="container-fluid d-flex justify-content-center align-items-center">
    <div class="row justify-content-center w-100 mt-5">
    <div class="col-12 col-lg-8 d-flex justify-content-center">

        <img src="https://images.pexels.com/photos/5025511/pexels-photo-5025511.jpeg?auto=compress&cs=tinysrgb&w=600"
         height="750px" style="border-radius: 1%;"
         class="d-none  d-md-flex"
         >




<div class="col-12 col-md-6 col-lg-7 col-xl-5">
   <div class=" card shadow p-3 h-100">

   <form id="deliveryForm" action="{{ route('delivery.data') }}" method="POST" >
         @csrf

<h4>Enter Delivery Infomation</h4>

  <div class="mb-3">
    <label  class="form-label">Full Name:</label>
    <input id="name" name="name" class="form-control" >
    <p id="fullNameErrorMsg" class="text-danger fw-bold error-msg"></p>
  </div>

  <div class="mb-3">
    <label  class="form-label">Mobile/Tele:</label>
    <input type="text" id="number" name="number" class="form-control" >
    <p id="phoneErrorMsg" class="text-danger fw-bold error-msg"></p>

  </div>

  <div class="mb-3">
    <label  class="form-label">Email:</label>
    <input type="email"  name="email" id="email" class="form-control" >
    <p id="emailErrorMsg" class="text-danger fw-bold error-msg"></p>

  </div>

  <div class="mb-3">
    <label  class="form-label">Address</label>
    <textarea class="form-control" id="address" name="address" rows="4"></textarea>
    <p id="addressErrorMsg" class="text-danger fw-bold error-msg"></p>

  </div>

  <div class="mb-3">
    <label  class="form-label">Province</label>
    <input type="text" class="form-control"  id="province" name="province">
    <p id="provinceErrorMsg" class="text-danger fw-bold error-msg"></p>

  </div>


  <input type="hidden" name="product_id" value="{{ $product_id ?? '' }}">


<div class="text-center mt-5">
<button type="submit" class="btn btn-primary" id="delivery-btn">Place Order</button>
</div>

</form>
</div>
   </div>
   
  </div>
     </div>
        </div>

        <div>


        <div class="container">
   <div class="col-12 mt-4">
   <div class="row justify-content-center">

   <div id="delivery-header">
   <h3 class="text-center mt-4 mb-4">Saved Delivery Infomation</h3>
   <hr class="mb-2">

   @if($deliveries->isEmpty())
    <p id="empty-message" class="text-center text-muted mt-4">
        No saved delivery addresses
    </p>
@endif
</div>

@if($showSaved)
@foreach($deliveries as $delivery)
<div class="col-12 col-md-6 col-lg-4 mb-5">
    <div class="card p-3 shadow h-100" id="delivery-{{ $delivery->id }}">

        <p><strong>Name:</strong> {{ $delivery->name }}</p>
        <p><strong>Phone:</strong> {{ $delivery->number }}</p>
        <p><strong>Email:</strong> {{ $delivery->email }}</p>
        <p><strong>Address:</strong> {{ $delivery->address }}</p>
        <p><strong>Province:</strong> {{ $delivery->province }}</p>

        <form action="{{ route('order.summary', [$product_id, $delivery->id]) }}" method="GET">
            <button class="btn btn-success mt-2">Use This Address</button>
        </form>

     <div class="d-flex justify-content-end">  
    <a class="text-danger" onclick="deleteDelivery({{ $delivery->id }})" style="cursor:pointer;">Delete Address</a>
    </div> 
    
      </div>
</div>
@endforeach
@endif
</div>
</div> 
</div> 


</div> 


<script>

function deleteDelivery(id) {
    if (!confirm("Delete this address?")) return;

    fetch("{{ route('delivery.delete') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ delivery_id: id })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        document.getElementById(`delivery-${id}`).remove();
        
    });
}

document.addEventListener("DOMContentLoaded", function () {

    document.getElementById("deliveryForm").addEventListener("submit", function (e) {
    let valid = true;

    let name = document.getElementById("name").value.trim();
    let number = document.getElementById("number").value.trim();
    let email = document.getElementById("email").value.trim();
    let address = document.getElementById("address").value.trim();
    let province = document.getElementById("province").value.trim();


    let nameError = document.getElementById("fullNameErrorMsg");
    let phoneError = document.getElementById("phoneErrorMsg");
    let emailError = document.getElementById("emailErrorMsg");
    let addressError = document.getElementById("addressErrorMsg");
    let provinceError = document.getElementById("provinceErrorMsg");



    nameError.innerHTML = "";
    phoneError.innerHTML = "";
    emailError.innerHTML = "";
    addressError.innerHTML = "";
    provinceError.innerHTML = "";


    // Name validation
    if (name === "" || name.length < 10 ) {
        nameError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i> Full name is required.';
        valid = false;
    }

    // Phone validation (basic Sri Lanka style check)
    let phoneRegex = /^(?:0|94|\+94)?[0-9]{9}$/;
        if (!phoneRegex.test(number)) {
        phoneError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i> Enter a valid phone number.';
        valid = false;
    }

    // Email validation
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        emailError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i> Enter a valid email.';
        valid = false;
    }

    // Address validation
    if (address.length < 5) {
        addressError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i> Address is too short.';
        valid = false;
    }

    // Province validation
    if (province === "") {
        provinceError.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-1"></i> Province is requiered.';
        valid = false;
    }

    if (!valid) {
        e.preventDefault(); // stop form submit
    }
});

});


// Live validation

// Name
document.getElementById("name").addEventListener("input", function () {
    let value = this.value.trim();
    let error = document.getElementById("fullNameErrorMsg");

    if (value.length >= 10) {
        error.innerHTML = "";
    }
});

// Phone
document.getElementById("number").addEventListener("input", function () {
    let value = this.value.trim();
    let error = document.getElementById("phoneErrorMsg");

    let phoneRegex = /^(?:0|94|\+94)?[0-9]{9}$/;

    if (phoneRegex.test(value)) {
        error.innerHTML = "";
    }
});

// Email
document.getElementById("email").addEventListener("input", function () {
    let value = this.value.trim();
    let error = document.getElementById("emailErrorMsg");

    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailRegex.test(value)) {
        error.innerHTML = "";
    }
});

// Address
document.getElementById("address").addEventListener("input", function () {
    let value = this.value.trim();
    let error = document.getElementById("addressErrorMsg");

    if (value.length >= 5) {
        error.innerHTML = "";
    }
});

// Province
document.getElementById("province").addEventListener("input", function () {
    let value = this.value.trim();
    let error = document.getElementById("provinceErrorMsg");

    if (value !== "") {
        error.innerHTML = "";
    }
});


  </script>

@endsection