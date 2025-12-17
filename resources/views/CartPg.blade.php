
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart Page</title>
</head>

@vite(['resources/css/CartPg.css'])

<body>






@include('Navbar')


<div class="main-sec">
<h2>Your Cart Information</h2>


@if($cart->count() == 0)
    <p>Your cart is empty.</p>

@else

    <table  cellpadding="10">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>

        @foreach($cart as $item)
        <tr id="cart-item-{{ $item->id }}">

<td>
    @if($item->image)
     <a href="{{route('deliveryData')}}"><img src="{{ asset($item->image) }}" width="130"> </a>
    @else
        No Image
    @endif
</td>

<td>{{ $item->name }}</td>

<td>Rs. {{ number_format($item->price) }}</td>

<td>
    <button class="decrement-btn" data-id="{{ $item->id }}">-</button>

    <span id="qty-{{ $item->id }}">{{ $item->quantity }}</span>

    <button class="increment-btn" data-id="{{ $item->id }}">+</button>
</td>

    <td>
    Rs.<span id="subtotal-{{ $item->id }}">{{ $item->price * $item->quantity }}</span>
</td>


<td>
    <button class="delete_btn" onclick="deleteCartItem('{{ $item->id }}')"> DELETE FROM CART</button>
</td>

</tr>


        @endforeach

    </table>

    <!-- Total Calculation -->
    <h3>
    Grand Total: 
    Rs. <span id="grand-total">{{ $cart->sum(fn($item) => $item->price * $item->quantity) }}</span>
</h3>

    </h3>

</div>
@endif

@include('Footer')
</body>

<script>

function deleteCartItem(id) {
    if (!confirm("Are you sure you want to delete this item?")) return;

    fetch("{{ route('cart.delete') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ id: id })
    })
    .then(res => res.json())
    .then(data => {
        // Remove row from table
        const row = document.getElementById(`cart-item-${id}`);
        if(row) row.remove();

        // Update cart count if you have a badge
        const cartBadge = document.getElementById('cart-count');
        if(cartBadge) cartBadge.innerText = data.cartCount;

        alert("Item removed from cart!");
    })
    .catch(err => console.error(err));

}


document.querySelectorAll('.increment-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        let id = this.getAttribute('data-id');

        fetch("{{ route('cart.increment') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: id })
        })
        .then(res => res.json())
        .then(data => {

            // Update quantity
            document.getElementById("qty-" + id).innerText = data.quantity;
document.getElementById("subtotal-" + id).innerText = "Rs. " + data.subtotal.toLocaleString();
document.getElementById("grand-total").innerText = data.totalPrice.toLocaleString();
document.getElementById("cart-count").innerText = data.cartCount;

        });
    });
});



document.querySelectorAll('.decrement-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        let id = this.getAttribute('data-id');

        fetch("{{ route('cart.decrement') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: id })
        })
        .then(res => res.json())
        .then(data => {

            // Update quantity
            document.getElementById("qty-" + id).innerText = data.quantity;
document.getElementById("subtotal-" + id).innerText = "Rs. " + data.subtotal.toLocaleString();
document.getElementById("grand-total").innerText = data.totalPrice.toLocaleString();
document.getElementById("cart-count").innerText = data.cartCount;

        });
    });
});


</script>



</html>












