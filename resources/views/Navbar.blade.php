

@vite(['resources/css/Navbar.css'])



<nav class="navbar">

<h1> <a href="{{route('viewHomePage')}}" style="cursor:pointer;"> My Watch Store </a> </h1>

<div class="nav-sections">

<p ><a href="{{route('displayAboutUs')}}">About Us</a></p>
<p> <a href="{{route('displayContactUs')}}">Contact Us </a></p>

@if(Auth::check())

<button class="dropdown-btn" id="dropdownButton" >  Hi, {{ Auth::user()->name }} </button>

<div class="dropdown-content" id="dropdownMenu">

<a href="{{ route('displayAccount') }}">View Account Details</a>

<a href="{{ route('displayAccount') }}">Cart</a>

<form action="{{ route('logout') }}" method="POST"> 
@csrf
<button type="submit">LogOut</button> 




</form>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('dropdownButton');
    const menu = document.getElementById('dropdownMenu');

    // Toggle dropdown visibility
    button.addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent the click from bubbling up
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });

    // Close the dropdown when clicking outside
    document.addEventListener('click', function() {
        menu.style.display = 'none';
    });
});
</script>


    @endif

</nav>