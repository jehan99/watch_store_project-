<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
        <title>Document</title>

        <link rel="stylesheet" href="HomeStyles.css">
        <link rel="stylesheet" href="ContactUsPg.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
 integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
 crossorigin="anonymous" referrerpolicy="no-referrer" />

 @vite(['resources/css/ContactUsPg.css'])

</head>
 

<body>
    
@include('Navbar')


<div class="sec-c1"> 

    <img src="https://images.pexels.com/photos/10677957/pexels-photo-10677957.jpeg?auto=compress&cs=tinysrgb&w=600" height="500px" class="img-c1"> 

<div class="info-sec-c1">
    <h1>Contact Us</h1>
 <h2> Phone1: 011-2234226</h2>
 <h2> Phone2: 077-5433377</h2>
 
<h1>Email</h1>
<h2>MYpetStoreSri @gmail.com</h2>

<h1>Social Media</h1>
<i class="fa-brands fa-instagram"></i>
<i class="fa-brands fa-facebook"></i>
<i class="fa-brands fa-x-twitter"></i>

<h1>Address</h1>
<h2>No:302/1</h2>
<h2>Sri Jayawardanapura, Kotte</h2>
<h2>Colombo-1</h2>

</div>

</div>

@include('Footer')
</body>





</html>