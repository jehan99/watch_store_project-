@extends('layouts.app')

@section('title', 'User-account-info')

@section('content')
<div class="bg-user-ac">

<div class="container vh-100" data-aos="fade-up">
<div class="row d-flex justify-content-center pt-5 pb-5 align-items-center h-100">

<div class="col-10 col-md-5 col-lg-4  text-center" >
<i class="fa-regular fa-circle-user" style="font-size: 250px;"></i>
</div> 

<div class="card col-10 col-md-6 col-lg-4 p-4 shadow" >
    <h4 class="mb-2">Account Details</h4>
    <hr>    
<p> <strong> Name : </strong>  {{ $user->name }}  </p>  
<p> <strong>Email :</strong> {{ $user->email }} </p>  

<p> <strong>Account Created :</strong>{{ $user->created_at->format('d M Y') }} </p>   

<div class="text-center mt-2">
<a href="{{route('password.change.page')}}"> 
<button type="button" class="btn btn-info" style="color: white;">Change Password</button>
</a>
</div>


</div>

</div>





</div>
</div>






@endsection