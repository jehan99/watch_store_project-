
@extends('layouts.app')


@section('titel','about-us-page')

@section('content')


<div class="container-fluid bg d-flex align-items-center justify-content-center" style="min-height: 80vh;">
  <div class="row w-100">
    <div class="text-background col-12 text-center" data-aos="fade-up">
      <h1>About Us</h1>
      <p class="fs-5">
       <span  ><i class="fa-solid fa-quote-left"></i></span> We are a Sri Lanka-based company with decades of experience, delivering high-quality 
       and durable products trusted by customers worldwide.<span style="font-size:20px"><i class="fa-solid fa-quote-right"></i></span>
      </p>
    </div>
  </div>
</div>


<!-- MIDDLE SEC -->


<div class="bg-middle">
<div class="container" style="padding-top:100px;">
<div class="row align-items-center mb-4 " data-aos="fade-up">

<div class="col-md-4">
  <img src="https://images.pexels.com/photos/3184360/pexels-photo-3184360.jpeg?auto=compress&cs=tinysrgb&w=600" 
       class="img-fluid" alt="image" width="100%" style="border-radius: 20px;">
</div>

<div class="col-md-8">
  <h1 class="mb-3 mt-3">We Build more than 1000 careers</h1>
  <p>
    Our business has produced more than 100 job opportunities for around 1000 employees. 
    Their hard efforts have led to success, reflected in the strong customer base we have built.
  </p>
</div>

</div>
</div>


<div class="container" style="margin-top: 50px; padding-bottom:60px">
<div class="row align-items-center" data-aos="fade-up">


<div class="col-md-8">
<h1 class="mb-3">Partnerships with most popular watch brands all over the world.</h1>

<p class="mb-3">"We have developed our business by connecting with the most popular watch brands in all countries. 100% quality, 100% genuine..."</p> 
</div>

<div class="col-md-4">
<img src="https://images.pexels.com/photos/190819/pexels-photo-190819.jpeg?auto=compress&cs=tinysrgb&w=600"
       class="img-fluid" alt="image" width="100%" style="border-radius: 20px;">
</div>



</div>
</div>

<div class="container" data-aos="fade-up" >
  <div class="row d-flex justify-content-center pb-5 mt-5">
 <div class="card shadow col-10 col-md-4 text-center p-4">
  <i class="fa-solid fa-gifts mb-4" style="font-size: 150px;"></i>
<p class="fs-4">Gift your friends lovers the best quality products form your store.</p>

  </div>

  <div class="card shadow col-10 col-md-4 text-center p-4">
  <i class="fa-solid fa-award  mb-4" style="font-size: 150px;"></i>
  <p class="fs-4">100% Genuine with 100% Trust</p>

  </div>

  <div class="card shadow col-10 col-md-4 text-center p-4">
  <i class="fa-regular fa-handshake  mb-4" style="font-size: 150px;"></i>
  <p class="fs-4">On time garanteed deliver with higher cusotmer satisfaction.</p>

  </div>

</div>
</div>


</div>

@endsection