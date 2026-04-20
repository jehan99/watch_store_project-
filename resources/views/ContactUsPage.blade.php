@extends('layouts.app')

@section('title', 'contact-us-page')

@section('content')

<div class="bg-con">
<div class="container pt-5 pb-5 " style="font-family:Arial, Helvetica, sans-serif" data-aos="fade-up">


<h2 class="text-center mb-3"> CONTACT US</h2>

<div class=" d-flex justify-content-center mb-4">
<img src="https://images.pexels.com/photos/8101355/pexels-photo-8101355.jpeg" width="400px" style="border-radius: 20px;" >
</div>
    
<div class="row justify-content-center" data-aos="fade-up">    
<div class="card col-10 col-lg-5  text-center pt-3" >
<i class="fa-solid fa-phone" style="font-size:50px; margin-bottom:1rem;"></i>
<h2>Phone</h2>
<p class="fs-5">+94 7788554</p >

</div>
<div class="card col-10 col-lg-5  text-center pt-3 pb-4" >
<i class="fa-solid fa-envelope" style="font-size:50px; margin-bottom:1rem;"></i>
<h2>Email</h2>
<p class="fs-5">MywatchStore@gmail.com</p >

</div>  

</div>

<div class="row justify-content-center"  data-aos="fade-up">
<div class="card col-10 col-lg-5 text-center pt-3 pb-4" >
<i class="fa-solid fa-location-dot" style="font-size:50px; margin-bottom:1rem;"></i>
<h2>location</h2>
<p class="fs-5">MywatchStore@gmail.com</p >



</div>

<div class="card col-10 col-lg-5 text-center pt-3 pb-4" >
<i class="fa-regular fa-clock" style="font-size:50px; margin-bottom:1rem;"></i>
<h2>Working hours</h2>
<p class="fs-5">24 / 7</p >

</div>  

</div>  
    
</div>  


@endsection