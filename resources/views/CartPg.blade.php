@extends('layouts.app')
@section('title', 'Cart-items-page' )

@section('content')





<div class="container vh-100 d-none d-lg-block">
    <div class="row mt-4 col-12">

        <h1 class="text-center mb-4 fw-bold">CART ITEMS</h1>
        <hr class="mb-4">

        <table class="table" style="display: {{ $cart->count() == 0 ? 'none' : 'table' }};">

            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Actions</th>
                    <p id="empty-cart-message" style="display: {{ $cart->count() == 0 ? 'block' : 'none' }}; text-align:center; font-size:40px; margin-top:   ;">
                        Your cart is empty.
                    </p>

                </tr>
            </thead>
            @foreach($cart as $item)

            @php
            $notAvailable = $item->availability === 'out_of_stock';

            @endphp

            <tr class="cart-item cart-item-{{ $item->id }} {{ $notAvailable ? 'disabled' : '' }}">

                <td>


                    @if($item->image)
                    <a href="{{ route('deliveryData', ['product_id' => $item->product_id]) }}">
                        <img src="{{ asset('storage/' . $item->image) }}" style="object-fit:cover;" width="130" height="130"> </a>
                    @else
                    No Image
                    @endif
                </td>

                <td>{{ $item->name }}</td>

                <td>Rs. {{ number_format($item->price) }}</td>

                <td>
                    <button type="button" class="btn btn-secondary decrement-btn " data-id="{{ $item->id }}">-</button>

                    <span id="qty-{{ $item->id }}">{{ $item->quantity }}</span>

                    <buttontype="button" class="btn btn-secondary increment-btn " data-id="{{ $item->id }}">+</button>
                </td>

                <td>
                    Rs.<span id="subtotal-{{ $item->id }}">{{ $item->price * $item->quantity }}</span>
                </td>


                <td>
                    <div class="d-grid">
                        <button type="button" class="btn btn-danger w-75 mb-3" onclick="deleteCartItem('{{ $item->id }}')">DELETE FROM CART</button>


                        <a href="{{ route('product.show',  $item->product_id) }}" class="btn btn-success w-75">
                            PLACE ORDER
                        </a>

                    </div>

                </td>
            </tr>


            @endforeach
        </table>

        <!-- <h3>
    Grand Total: 
    Rs. <span id="grand-total">{{ $cart->sum(fn($item) => $item->price * $item->quantity) }}</span>
</h3> -->

    </div>
</div>

<!-- FOR MOBILE -->

<div class="container d-block d-lg-none">
    <div class="row d-flex justify-content-center mt-5" style="margin-bottom: 40%;">

        <h1 class="text-center mb-3 fw-bold">CART ITEMS</h1>
        <hr class="mb-4">

        <p id="empty-cart-message" style="display: {{ $cart->count() == 0 ? 'block' : 'none' }}; text-align:center; font-size:40px;">
            Your cart is empty.
        </p>

        @foreach($cart as $item)

        @php
        $notAvailable = $item->availability === 'out_of_stock';

        @endphp


        <div class="col-10 mb-3 cart-item cart-item-{{ $item->id }}"><!-- column -->
            <div class="card text-center p-4 shadow {{ $notAvailable ? 'disabled' : '' }}" style="display: {{ $cart->count() == 0 ? 'none' : 'flex' }};"> <!-- card -->


                @if($item->image)
                <a href="{{ route('deliveryData', ['product_id' => $item->product_id]) }}">
                    <img src="{{ asset('storage/' . $item->image) }}" style="object-fit:cover;" width="130" height="130"> </a>
                @else
                No Image
                @endif
                <p class="mt-4"><strong> {{ $item->name }} </strong></p>
                <p><strong>Price:Rs: {{ number_format($item->price) }}</strong></p>
                <div>
                    <p><strong>Quantitiy:</strong></p>
                    <!-- <button class="decrement-btn" data-id="{{ $item->id }}">-</button> -->
                    <button type="button" class="btn btn-secondary decrement-btn " data-id="{{ $item->id }}">-</button>


                    <span id=" card-qty-{{ $item->id }}">{{ $item->quantity }}</span>

                    <!-- <button class="increment-btn" data-id="{{ $item->id }}">+</button> -->
                    <button type="button" class="btn btn-secondary increment-btn" data-id="{{ $item->id }}">+</button>

                </div>
                <p class="mt-4"><strong>Grand Total price: Rs: </strong><span id="card-subtotal-{{ $item->id }}">
                        {{ $item->price * $item->quantity }}
                    </span></p>
                <button type="button" class="btn btn-danger mb-3" onclick="deleteCartItem('{{ $item->id }}')">DELETE FROM CART</button>
                <a href="{{ route('product.show',  $item->product_id) }}" class="btn btn-success">
                    PLACE ORDER
                </a>


            </div>

        </div>
        @endforeach

    </div>
</div>



<script>
    function deleteCartItem(id) {
        if (!confirm("Are you sure you want to delete this item?")) return;

        fetch("{{ route('cart.delete') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    id: id
                })
            })
            .then(res => res.json())
            .then(data => {

                // 🔥 remove BOTH table + card
                document.querySelectorAll(`.cart-item-${id}`).forEach(el => el.remove());

                // update cart count
                document.getElementById("cart-count").innerText = data.cartCount;

                // empty cart handling
                if (data.cartCount === 0) {
                    document.querySelectorAll("#empty-cart-message").forEach(el => {
                        el.style.display = "block";
                    });
                }
            })
            .catch(err => console.error(err));
    }

    document.addEventListener('click', function(e) {

        if (e.target.classList.contains('increment-btn') ||
            e.target.classList.contains('decrement-btn')) {

            let id = e.target.getAttribute('data-id');
            let url = e.target.classList.contains('increment-btn') ?
                "{{ route('cart.increment') }}" :
                "{{ route('cart.decrement') }}";

            fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        id: id
                    })
                })
                .then(async res => {
                    let data = await res.json().catch(() => ({}));

                    let incBtn = document.querySelector(`.increment-btn[data-id="${id}"]`);
                    let decBtn = document.querySelector(`.decrement-btn[data-id="${id}"]`);

                    //  HANDLE STOCK LIMIT
                    if (!res.ok) {

                        if (data.maxReached) {
                            // disable correct button

                            if (incBtn) {
                                incBtn.disabled = true;
                                incBtn.style.opacity = "0.5";
                                incBtn.style.cursor = "not-allowed";
                            }

                        }

                        return; // NO alert → no "undefined"

                    }
                    if (decBtn) {
                        incBtn.disabled = false;
                        incBtn.style.opacity = "1";
                        incBtn.style.cursor = "pointer";
                    }





                    // TABLE update
                    let qty = document.getElementById("qty-" + id);
                    let sub = document.getElementById("subtotal-" + id);

                    if (qty) qty.innerText = data.quantity;
                    if (sub) sub.innerText = data.subtotal.toLocaleString();

                    // CARD update
                    let cqty = document.getElementById("card-qty-" + id);
                    let csub = document.getElementById("card-subtotal-" + id);

                    if (cqty) cqty.innerText = data.quantity;
                    if (csub) csub.innerText = data.subtotal.toLocaleString();

                    // CART COUNT
                    document.getElementById("cart-count").innerText = data.cartCount;
                });
        }

    });





    // fetch('/cart/increment', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json',
    //         'X-CSRF-TOKEN': csrfToken
    //     },
    //     body: JSON.stringify({ product_id: id })
    // })
    // .then(async res => {
    //     let data = await res.json().catch(() => ({}));

    //     if (!res.ok) {

    //         if (data.maxReached) {
    //             //  DISABLE BUTTON HERE
    //             document.querySelector(`#increment-btn-${id}`).disabled = true;
    //         }

    //         alert(data.message || "Error");
    //         return;
    //     }

    //     // normal success logic
    // });
</script>

<style>
    .disabled {
        opacity: 0.5;
        background-color: #f5f5f5;
        pointer-events: none;
    }
</style>

@endsection