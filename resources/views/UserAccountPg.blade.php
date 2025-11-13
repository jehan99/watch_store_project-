<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Details</title>
</head>
@vite (['resources/css/UserAccount.css'])


<body>
@include('Navbar')

<img src="{{ asset('images/user.png') }}" height="230px"  id="user-img">

<div class="user-info-sec">


<h3> User Name : <span style="color:blue; "> {{ $user->name }} </span> </h3>   <br>
<h3> Email : <span style="color:blue">{{ $user->email }} </span></h3>   <br>
<h3> Account Created : <span style="color:blue">{{ $user->created_at->format('d M Y') }}</span> </h3>   <br>


    






</div>

</body>
</html>