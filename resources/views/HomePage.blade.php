
<!DOCTYPE html>
<html lang="en"> 
    <head>
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Watch Store </title>
<link rel="stylesheet" href="HomeStyles.css">

<meta name="csrf-token" content="{{ csrf_token() }}">


@vite(['resources/css/HomeStyles.css'])




<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
 integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
 crossorigin="anonymous" referrerpolicy="no-referrer" />



</head>





<body>

<!-- Add this script at the bottom of your page or in a JS file -->
<script>
function addToCart(product) {
    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ product: product })
    })
    .then(async response => {

        // Safe parse JSON — even if response is HTML
        let data = {};
        try {
            data = await response.json();
        } catch (e) {
            console.warn("Non-JSON response");
        }

        // LOGIN REQUIRED (401)
        if (response.status === 401) {
            alert( "Please login first.");
            return;
        }

        // OTHER ERRORS
        if (!response.ok) {
            alert(data.message || "Something went wrong.");
            return;
        }

        // SUCCESS CASE
        if (data.cartCount !== undefined) {
            const cartCountElem = document.getElementById('cart-count');
            if (cartCountElem) {
                cartCountElem.textContent = data.cartCount;
            }
            alert("Product added to cart!");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong.');
    });
}



</script>


<div id="img-background">

@include('Navbar')


<div class="header-1">
    <h2>TIME IS GOLD, WE GIVE YOU THE BEST PRODUCTS TO SAVE YOUR GOLDEN TIME</h2>
</div>


<div class="ss">
   <input class="search_bar" type="text" placeholder="Search Items"/>  
 <br>
 
 <a href="{{ route('home.register') }}"> <button  type="submit" class="btn-reg">CLICK HERE TO REGISTER</button>   </a>



</div>

</div>
<div class="header-2">
<h1>Watch Brands</h1>

<div class="brand-imgs">

<div class="brand-sec1">
    <a href="CassioPage.html"><img src="https://images.pexels.com/photos/11106319/pexels-photo-11106319.jpeg?auto=compress&cs=tinysrgb&w=600" height="400px" width="300px"> </a>
    <h2>CASSIO</h2>
</div>

<div class="brand-sec2">
<img src="https://images.pexels.com/photos/13257109/pexels-photo-13257109.jpeg?auto=compress&cs=tinysrgb&w=600" height="400px" width="300px">
<h2>OMEGA</h2>
</div>

<div class="brand-sec3">
    <img src="https://images.pexels.com/photos/592815/pexels-photo-592815.jpeg?auto=compress&cs=tinysrgb&w=600" height="400px" width="300px">
    <h2>CITIZEN</h2>
    </div>

    <div class="brand-sec4">
        <img src="https://images.pexels.com/photos/364822/rolex-watch-time-luxury-364822.jpeg?auto=compress&cs=tinysrgb&w=600" height="400px" width="300px">
        <h2>ROLEX</h2>
        </div>
</div>

</div>
    
<div class="header-3">
    <h1>Lateset Products</h1>

<div class="products"> 


   <div class="items">
  <a href="{{route('product1')}}">  <img src="https://anix.lk/wp-content/uploads/2022/10/anix.lk_.Casio_.W-218hd-1a-200x230.png" height="400px" width="300px"> </a>
    <div class="watch-name"> <p> <a href="{{route('product1')}}">Cassio W-218HD-1AV| C020HD </a></p></div>
    <div class="watch-price"><h4>RS:16,000.00</h4></div>

    <div class="bb"> 
        <button class="btn-cart" 
        onclick="addToCart({
    name: 'Cassio W-218HD-1AV| C020HD',
    price: 2000,
    image: 'https://anix.lk/wp-content/uploads/2022/10/anix.lk_.Casio_.W-218hd-1a-200x230.png'
})">
        
         <i class="fa-sharp fa-solid fa-cart-plus" style="cursor: pointer;"></i>Add to Cart</button> 
        
        </div>

</div> 
   


   <div class="items">
    <img src="https://anix.lk/wp-content/uploads/2023/05/anix.lk_.Skmei_.1988.Armygreen-200x230.png" height="400px" width="300px">
    <div class="watch-name"> <p>Skmei W81G</p></div>
    <div class="watch-price"><h4>RS:6,000.00</h4></div>

    <div class="bb">
         <button class="btn-cart" 
    onclick="addToCart({
    name: 'Skmei W81G',
    price: 6000,
    image: 'https://anix.lk/wp-content/uploads/2023/05/anix.lk_.Skmei_.1988.Armygreen-200x230.png'
})"
    
    ><i class="fa-sharp fa-solid fa-cart-plus" style="cursor: pointer;"></i> Add to Cart</button> </div>

    

   </div> 

   <div class="items">
    <img src="https://anix.lk/wp-content/uploads/2024/01/anix.lk_.Poedagar.921.SL_.BKL_-200x230.png" height="400px" width="300px">
    <div class="watch-name"> <p>Poedagar PD12SBL | Silver Black</p></div>
    <div class="watch-price"><h4>RS:9,300.00</h4></div>

    <div class="bb"> <button class="btn-cart"
    onclick="addToCart({
    name: 'Poedagar PD12SBL | Silver Black',
    price: 9300,
    image: 'https://anix.lk/wp-content/uploads/2024/01/anix.lk_.Poedagar.921.SL_.BKL_-200x230.png' })"
    > <i class="fa-sharp fa-solid fa-cart-plus"></i>Add to Cart</button> </div>

   </div> 

   <div class="items">
    <img src="https://anix.lk/wp-content/uploads/2022/01/anix.lk_.Casio_.MTP-V004D-2B-200x230.png" height="400px" width="300px">
    <div class="watch-name"> <p>Cassio Enticer MTP-V004D-2B | C014U</p></div>
    <div class="watch-price"><h4>RS:14,650.00</h4></div>

    <div class="bb"> <button class="btn-cart"
    onclick="addToCart({
    name: 'Cassio Enticer MTP-V004D-2B | C014U',
    price: 14000,
    image: 'https://anix.lk/wp-content/uploads/2022/01/anix.lk_.Casio_.MTP-V004D-2B-200x230.png' })"
    > <i class="fa-sharp fa-solid fa-cart-plus"></i>Add to Cart</button> </div>

   </div> 


</div>


<div class="products"> 

    <div class="items">
     <img src="https://anix.lk/wp-content/uploads/2024/08/anix.lk_.Casio_.MTP-E725L-5AVDF-200x230.png" height="400px" width="300px">
     <div class="watch-name"> <p>Cassio W-218HD-1AV| C020HD</p></div>
     <div class="watch-price"><h4>RS:18,000.00</h4></div>
 
     <div class="bb"> <button class="btn-cart"
     onclick="addToCart({
    name: 'Cassio W-218HD-1AV| C020HD',
    price: 18000,
    image: 'https://anix.lk/wp-content/uploads/2024/08/anix.lk_.Casio_.MTP-E725L-5AVDF-200x230.png' })"
     > <i class="fa-sharp fa-solid fa-cart-plus"></i>Add to Cart</button> </div>
 
 </div> 
    
 
 
    <div class="items">
     <img src="https://anix.lk/wp-content/uploads/2021/11/anix.lk_.Casio_.mtpVd01D-1B-200x230.png" height="400px" width="300px">
     <div class="watch-name"> <p>Casio Enticer MTP-VD01D-BV | C022B</p></div>
     <div class="watch-price"><h4>RS:10,700.00</h4></div>
 
     <div class="bb"> <button class="btn-cart"
     onclick="addToCart({
    name: 'Casio Enticer MTP-VD01D-BV | C022B',
    price: 10700,
    image: 'https://anix.lk/wp-content/uploads/2021/11/anix.lk_.Casio_.mtpVd01D-1B-200x230.png' })"
     > <i class="fa-sharp fa-solid fa-cart-plus"></i>Add to Cart</button> </div>
 
    </div> 
 
    <div class="items">
     <img src="https://anix.lk/wp-content/uploads/2024/01/anix.lk_.Poedagar.613.RG_.WHL_-200x230.png" height="400px" width="300px">
     <div class="watch-name"> <p>Poedagar PD12SBL | Silver Black</p></div>
     <div class="watch-price"><h4>RS:14,000.00</h4></div>
 
     <div class="bb"> <button class="btn-cart"
     onclick="addToCart({
    name: 'Poedagar PD12SBL | Silver Black',
    price: 14000,
    image: 'https://anix.lk/wp-content/uploads/2024/01/anix.lk_.Poedagar.613.RG_.WHL_-200x230.png' })"
     >  <i class="fa-sharp fa-solid fa-cart-plus"> </i> Add to Cart </button> </div>
 
    </div> 
 
    <div class="items">
     <img src="https://anix.lk/wp-content/uploads/2023/05/anix.lk_.Skmei_.2070.camoblue-200x230.png" height="400px" width="300px">
     <div class="watch-name"> <p>Citizen I3220</p></div>
     <div class="watch-price"><h4>RS:13,600.00</h4></div>
 
     <div class="bb"> <button class="btn-cart"
     onclick="addToCart({
    name: 'Citizen I3220',
    price: 13000,
    image: 'https://anix.lk/wp-content/uploads/2023/05/anix.lk_.Skmei_.2070.camoblue-200x230.png' })"
     ><i class="fa-sharp fa-solid fa-cart-plus"></i> Add to Cart</button> </div>
 
    </div> 
  
 
 </div>
 
 

 <div class="add-sec">
    <img src="./Img/add.png">    
    
    </div>
</div>  


<div style="margin-top: 1600px; width:100%">
@include('Footer')

     </div>
     
</body>


</html>


