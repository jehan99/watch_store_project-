<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="HomeStyles.css">
    <link rel="stylesheet" href="AboutUsPg.css"> 
    @vite(['resources/css/AboutUsPg.css'])
</head>




<body>


<div class="main-sec">

@include('Navbar') 


<div class="info-sec"> 
<h1>About Us</h1>
<p>" We are in the indutry around 10 decates which allowed satisfy many customers all aroungd the world. We are located in Sri Lanka one of the beautiest country located in 
the indian ocean. We sell the most quality products giving them the logngest durability. We have generate many customers turt with in 
our business because of our best selling products."
</p>

</div>


</div>
<div class="sec-1"> 

<img src="https://images.pexels.com/photos/3184360/pexels-photo-3184360.jpeg?auto=compress&cs=tinysrgb&w=600" height="430px" class="img-1">

<div class="info-sec-1">
<h1> We Build more than 1000 careers</h1>
<p>Our business have produce more than 100 job oppotunites for around 1000 employees. Thier hard efforts have been success by looking at the customer base we have generated. </p>
</div>

</div>

<div class="sec-2">

<img src="https://images.pexels.com/photos/190819/pexels-photo-190819.jpeg?auto=compress&cs=tinysrgb&w=600" class="img-2"> 

<div class="info-sec-2">
    <h1>Partnerships with most popular watch brands all over the world.</h1>

   <p>"We have developed our business by connecting with the most popular watch brands in all countries. 100% quality, 100% genuine..."</p> 




</div>
</div>
</body>

<footer>
    <div class="footer-sec1">
    
        <div class="F-s1">
    <h2>Services</h2>
    <p>Watch Accessories</p>
    <p>Watch repairing </p>
    <p>Watch strap selling </p>
    </div>   
    
    <div class="F-s1">
    <h2>Address</h2>
    <p>No: 266/32</p>
    <p>Petta Street</p>
    <p>Colombo 13</p>
    </div>
    
    
    <div class="F-s3">
       <div class="cn">  <h2>Contact</h2> </div>
    <h2 class="phn">+94 88 4555 11</h2>
    <hr>
    
    <i class="fa-brands fa-instagram"></i>
    <i class="fa-brands fa-facebook"></i>
    <i class="fa-brands fa-x-twitter"></i>
    
    </div>
    
    <div class="F-s4">
        <h2>Sponsers</h2>
        <img src="data:image/png;base64,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" height="100px" width="100px">
    
        <img src="data:image/png;base64,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" height="100px" width="100px">
    
        <img src="data:image/png;base64,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"height="100px" width="100px">
    </div>
    
    </div>
    
    <div class="footer-sec2">
         <h3><i class="fa-sharp fa-regular fa-copyright"></i> (2023-2024)  LK All Copy Rights reserved.</h3>
    </div>
    
    
    </footer>


</html>