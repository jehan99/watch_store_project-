    @extends('layouts.app')
    @section('title', 'product_information')

    @section('content')

<div class="bg-item-spec">


    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="row justify-content-center w-100 pt-5 pb-5">
            
            <div class="col-10 col-sm-10 col-md-12 col-lg-4 text-center mt-5 me-lg-5">

                <div class="main-sec">


                    <div class="img-sec">

                        <!-- Main Image -->
                        <img id="mainImage"
                            src="{{ asset('storage/' . ($product->mainImage->image_path ?? 'default.png')) }}" 
                            alt="{{ $product->title }}" 
                            width="340px"
                            height="540px"
                            class="mb-3"
                            style="object-fit:cover; border-radius:20px "
                            >

                        <!-- Gallery Images -->
                        <div class="d-flex flex-wrap gap-3 justify-content-center">
                            @foreach($product->galleryImages as $gallery)
                                <img src="{{ asset('storage/' . $gallery->image_path) }}"
                                    alt="Gallery Image"
                                    class="img-thumbnail gallery-img"
                                    style="max-height:130px; width:130px; cursor:pointer; object-fit:cover;">
                            @endforeach
                        </div>

                    </div>

                </div>
                </div>


                <div class="card shadow col-10 col-md-9 col-lg-4 mt-5 info p-4">
                    
                
                <div class="product-info d-grid mt-4 ">

                <h1 style="text-align: center; margin-bottom:20px;">{{$product->title}}</h1>
                <hr>

                <h5>Specifications:</h5>
                    <ul class="styled">
                        @foreach ($product->specifications as $key => $value)
                            <li><h5>{{$key}} {{$value}} </h5></li>
                        @endforeach
                    </ul>

                    <h5>Description:</h5>

                    <p>{{$product->description}}</p>


                    <hr>

                    <h5 class="text-danger text-center mt-2 ">Price: {{$product->price}} LKR</h5>

                    <hr>

                    <div class="btn-sec d-flex justify-content-center gap-3 mt-5">
                        <a href="{{route('deliveryData', $product->id )}}">
                            <button class="btn btn-primary">Place Order</button>
                        </a> 

                        
<button class="btn btn-secondary" onclick="addToCart({{ $product->id }})">
    Add to Cart
</button>

</div>

                </div>


        </div>
    </div>
    </div>

    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const mainImage = document.getElementById("mainImage");
        const galleryImages = document.querySelectorAll(".gallery-img");

        galleryImages.forEach(img => {
            img.addEventListener("click", function () {

                // Save current main image
                let mainSrc = mainImage.src;

                // Swap
                mainImage.src = this.src;
                this.src = mainSrc;
            });
        });
    });


const addCart = document.getElementById('addToCart');
document.addEventListener("DOMContentLoaded", function () {


    
});

if($item == product_id){
    alert('u have already added this item to cart.');
}else{
    
}


function addToCart(productId) {
    fetch("{{ route('cart.add') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(res => res.json())
    .then(data => {

        if (data.message) {
    alert(data.message);
}
   // UPDATE NAVBAR COUNT (THIS WAS MISSING)
   if (data.cartCount !== undefined) {
            const cartCountElem = document.getElementById('cart-count');
            if (cartCountElem) {
                cartCountElem.textContent = data.cartCount;
            }
        }

    })
    .catch(error => {
        alert("Something went wrong");
    });
}




    </script>

    @endsection

