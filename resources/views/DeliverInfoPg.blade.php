<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="HomeStyles.css">
    @vite(['resources/css/DeliverInfoPg.css'])
</head>

<body>

@include('Navbar')

<div class="main-sec">

    <img src="https://images.pexels.com/photos/5025511/pexels-photo-5025511.jpeg?auto=compress&cs=tinysrgb&w=600"
         height="700px" style="border-radius: 5%;">

    <div class="info-sec">
        <h1 style="margin-bottom: 60px;">Delivery Information</h1>

        <form action="{{route('delivery.data')}}"  method="POST">
     @csrf

        <label>Name:</label>
        <input type="text" id="name" name="name"><br>

        <label>Mobile:</label>
        <input type="text" id="number" name="number"><br>

        <label>Email:</label>
        <input type="email" id="email" name="email"><br>

        <div style="margin-bottom: 20px;"><label>Address:</label></div>
        <textarea id="address" name="address"
                  style="margin-left: 200px; margin-top: -45px; margin-bottom: 20px; width:300px; height:130px;"></textarea><br>

        <label>Province:</label>
        <input type="text" id="province" name="province"><br>

        <button class="btn-deliver" id="delivery-btn" type="submit"> Place Your Order</button>


        </form>



        

    </div>
</div>


<footer style="margin-top:50px;">
    <!-- your footer code stays the same -->
</footer>

</body>
</html>
