
@php
use Illuminate\Support\Facades\Auth;
@endphp

<nav class="navbar navbar-expand-lg bg-body-tertiary" >
  <div class="container-fluid">

    <h1>
      <a href="{{ route('homePage') }}" style="cursor:pointer; margin-left:20px; text-decoration:none; color:white;">
       <img src="{{asset('images/LOGO2.png')}}" alt="LOGO" height="60" >
      </a>
    </h1>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarTogglerDemo02"
      aria-controls="navbarTogglerDemo02"
      aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center text-center " id="navbarTogglerDemo02">

      <!-- Left Side Links -->
      <ul class="navbar-nav me-auto  mb-lg-0 justify-content-end w-100 fs-5 align-items-center">
      <hr class="d-lg-none w-100 mx-auto" style="color: white;">

        <li class="nav-item me-3">
  <a class="nav-link {{ request()->routeIs('homePage') ? 'active' : '' }}" 
     href="{{ route('homePage') }}">
     Home |
  </a>
</li>

<li class="nav-item me-3">
  <a class="nav-link {{ request()->routeIs('displayAboutUs') ? 'active' : '' }}" 
     href="{{ route('displayAboutUs') }}">
     About Us |
  </a>
</li>

<li class="nav-item me-4">
  <a class="nav-link {{ request()->routeIs('displayContactUs') ? 'active' : '' }}" 
     href="{{ route('displayContactUs') }}">
     Contact Us |
  </a>
</li>
        <hr class="d-lg-none w-100 mx-auto" style="color: white;">

      <!-- Right Side (Auth Section) -->
      <li class="nav-item me-2 mt-2 mt-lg-1 mb-4 mb-lg-0 ">
      @if(Auth::check())
      <div class="dropdown me-3 fs-6">
        <button class="btn btn-secondary dropdown-toggle fs100" type="button" data-bs-toggle="dropdown">
          Hi, {{ Auth::user()->name }}
        </button>

        <ul class="dropdown-menu dropdown-menu-end">

          <li>
            <a class="dropdown-item fs-5" href="{{ route('displayAccount') }}">
              View Account Details
            </a>
          </li>
          @if(auth()->user()->role !== 'admin')

          <li>
            <a class="dropdown-item fs-5" href="{{ route('cart.show') }}">
           Cart Item: <span id="cart-count">  {{ auth()->user()->cart()->sum('quantity') }}</span> 
            </a>
          </li>
         @endif
          @if(auth()->user()->role === 'admin')
          <li>
            <a class="dropdown-item fs-5" href="{{ route('admin.dashboard') }}">
             Admin Panel
            </a>
          </li>
          @endif

          @if(auth()->user()->role !== 'admin')
          <li>
            <a class="dropdown-item fs-5" href="{{ route('user.orders') }}">
           All Orders
            </a>
          </li>
          @endif

          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="dropdown-item fs-5" type="submit">Logout</button>
            </form>
          </li>

        </ul>
      </div>

      @else
      <a href="{{ route('login') }}" class="me-4" style="text-decoration: none; color:white">
        Login
      </a>
      @endif

      </li>
      

      </ul>

    </div>
  </div>
</nav>

<style>

/* active color */

.nav-link.active {
  color: #FFD700 !important;
}

/* underline effect */
.nav-link::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;

  background-color: #FFD700;
  transition: 0.3s;
}

</style>


