    @extends('layouts.app')

    @section('title', 'Home-page')

    @section('content')


    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="https://images.pexels.com/photos/2170283/pexels-photo-2170283.jpeg" class="d-block w-100 img-1" alt="..." height="560vh" >
        </div>
        <div class="carousel-item">
        <img src="https://images.pexels.com/photos/1467188/pexels-photo-1467188.jpeg" class="d-block w-100 img-2" alt="..." height="560vh" >
        </div>
        <div class="carousel-item">
        <img src="https://images.pexels.com/photos/7209315/pexels-photo-7209315.jpeg" class="d-block w-100 img-3" alt="..." height="560vh">
        </div>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>

<!-- Reg section -->
<div class="container " data-aos="fade-up">
<div class="row d-flex justify-content-center mb-5 mt-4">
<h1 class="text-center fw-bold">Click Here To Register </h1>
<a href="{{ route('home.register') }}" class="text-center"><button type="submit" class="btn btn-success   fs-3" style="height: 60px;">Sign Up</button>  </a>
</div>

</div>




    <!-- BRANDS -->
    <div class="container-fluid brands-bg">
    <div class="row d-flex justify-content-center  mb-5 pb-5 pt-5"> 

    <div class="mb-5">
    <h1 class="text-center mb-4" style="color:white;">BRANDS </h1>
    </div>

    <div class="card pt-3 col-9 col-sm-7 col-md-5 col-xl-2  me-3  mb-3 shadow"  data-aos="zoom-in">
    <img src="https://images.pexels.com/photos/11106319/pexels-photo-11106319.jpeg?auto=compress&cs=tinysrgb&w=600" height="400" width="300px"
     class="card-img-top" alt="..." style="object-fit: cover;">
    <div class="card-body">
        <h3 class="card-text text-center">CASIO</h3>
    </div>
    </div>

    <div class="card pt-3 col-9 col-sm-7 col-md-5 col-xl-2 me-3 mb-3 shadow"  data-aos="zoom-in"> 
    <img src="https://images.pexels.com/photos/13257109/pexels-photo-13257109.jpeg?auto=compress&cs=tinysrgb&w=600" height="400" width="300px" class="card-img-top" alt="..." style="object-fit: cover;">
    <div class="card-body">
    <h3 class="card-text text-center">OMEGA</h3>
    </div>
    </div>

    <div class="card pt-3  col-9 col-sm-7 col-md-5 col-xl-2 me-3 mb-3 shadow"  data-aos="zoom-in"> 
    <img src="https://images.pexels.com/photos/592815/pexels-photo-592815.jpeg?auto=compress&cs=tinysrgb&w=600" height="400" width="300px" class="card-img-top" alt="..." style="object-fit: cover;">
    <div class="card-body">
    <h3 class="card-text text-center">CITIZEN</h3>
    </div>
    </div>

    <div class="card pt-3 col-9 col-sm-7 col-md-5 col-xl-2 me-3 mb-3 shadow"  data-aos="zoom-in"> 
    <img src="https://images.pexels.com/photos/364822/rolex-watch-time-luxury-364822.jpeg?auto=compress&cs=tinysrgb&w=600" height="400" width="300px" class="card-img-top" alt="..." class="img-1" style="object-fit: cover;">
    <div class="card-body">
    <h3 class="card-text text-center">ROLEX</h3>
    </div>
    </div>


    </div>
    </div>



<!-- section -->
<div class="container" data-aos="fade-up" >
  <div class="row d-flex justify-content-center pb-5">
  <h1 class="text-center mb-2">Design Your Unique Style</h1>
  <p class="text-center mb-4 fs-5">We provide a wide range of watches to match your unique style.</p>

  <img src='https://images.pexels.com/photos/11008033/pexels-photo-11008033.jpeg'  class="col-10 col-md-4 mb-2">
<img src='https://images.pexels.com/photos/3656125/pexels-photo-3656125.jpeg' class="col-10 col-md-4 mb-2">
<img src='https://images.pexels.com/photos/30509137/pexels-photo-30509137.jpeg' class="col-10 col-md-4 mb-2">
<img src=''>
<img src=''>
</div>
</div>


<!-- PRODUCT SECTION -->


<div class="container my-5" data-aos="fade-up">
<h1 class="mb-5 text-center">Products</h1>

<div class="row">

    @foreach($products as $product)

@php
$notAvailable = $product->stock <= 0;
$isAdmin = Auth::check() && Auth::user()->role === 'admin';

@endphp


        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 mt-4" >


        <div class="items"
     data-id="{{ $product->id }}"
     data-name="{{ $product->title }}"
     data-price="{{ $product->price }}"
     data-image="{{ $product->image }}">


     <div class="card h-100 text-center pt-3"
     style="{{ $notAvailable ? 'opacity:0.5; cursor:not-allowed;' : '' }}">

            
            <img   src="{{ asset('storage/' . ($product->mainImage->image_path ?? 'default.png')) }}" alt="Main Image" width="100"

                     class="card-img-top top product-image mx-auto"
                     alt="">


                     <div class="card-body">
                    <h6 class="card-title">{{ $product->title }}</h6>
                    <p class="card-text">RS: {{ $product->price }}</p>

                    @if($notAvailable)
            <p class="text-danger fw-bold mt-2">
                Out of Stoks
            </p>
        @else
            <p class="text-success fw-bold mt-2">
                In Stoks
            </p>
        @endif


                    <div class="d-grid justify-content-center">
                        
                    @if($notAvailable || $isAdmin)

                    <button class="btn btn-success btn-sm mb-3 disabled" 
                            onclick="addToCart(this)">
                        <i class="fa fa-cart-plus"></i> Add to Cart
                    </button>
                    @else
                    <button class="btn btn-success btn-sm mb-3"
                            onclick="addToCart(this)">
                        <i class="fa fa-cart-plus"></i> Add to Cart
                    </button>
                    @endif


                    @if($notAvailable || $isAdmin)
    <span class="btn btn-primary btn-sm disabled">BUY NOW</span>
@else
    <a href="{{ route('buy.now', $product->id) }}" style="text-decoration:none;">
        <button class="btn btn-primary btn-sm w-100">BUY NOW</button>
    </a>
@endif

</div>


                </div>

            </div>

        </div>

        </div>
    @endforeach

</div>




    <script>

    function getProductData(element) {
        const item = element.closest('.items');

        return {
            id: Number(item.dataset.id),  // <-- send product_id
            name: item.dataset.name,
            price: Number(item.dataset.price),
            image: item.dataset.image
        };
    }




    function addToCart(button) {

        const product = getProductData(button);

        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ product_id: product.id })
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
        }

        // SHOW BACKEND MESSAGE (IMPORTANT FIX)
        if (data.message) {
            alert(data.message);
        }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong.');
        });
    }






    </script>
    @endsection