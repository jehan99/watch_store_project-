

<nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top ">
  <div class="container-fluid">
 
    <!-- Hamburger -->
    <button class="navbar-toggler d-lg-none"
            type="button" 
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Brand -->
    <a class="navbar-brand ms-2" href="#">Admin Panel</a>
   
    <div class="d-flex d-lg-none me-1">
<form action="{{route('logout')}}" method="POST">
  @csrf
<button type="submit"  class="btn p-0 border-0 bg-transparent">
   <i class="fa-solid fa-right-from-bracket fs-4" style="color:white;cursor:pointer;"></i></button> 

</form></div>

    <!-- Offcanvas menu -->
    <div class="offcanvas offcanvas-start text-bg-dark"
         tabindex="-1"
         id="offcanvasDarkNavbar">

      <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" 
                class="btn-close btn-close-white"
                data-bs-dismiss="offcanvas">
        </button>
      </div>  

      <div class="offcanvas-body d-lg-none">
    
   
      <a href="{{route('admin.dashboard')}}" style="text-decoration: none; color:white"><h4 class="mb-4"><i class="fa-solid fa-user-tie me-1"></i>ADMIN DASHBOARD</h4></a>

<hr>
<h5 class="mb-4"> <i class="fa-solid fa-boxes-packing me-1"></i>Product Management</h5>
<div class="ms-4">
<a href="{{route('enterProductsDB')}}" class="text-white text-decoration-none d-block mb-2">Add Products</a>
<a href="{{route('admin.products')}}" class="text-white text-decoration-none d-block mb-2">View / Update / Delete Products</a>
<a href="{{route('homePage')}}" class="text-white text-decoration-none d-block mb-3">View Home Page</a>
</div>
<hr>

<h5 class="mb-3"><i class="fa-regular fa-truck me-1"></i></i>Order Management</h5>
<div class="ms-4">
<a href="{{route('admin.orders.pending')}} "  class="text-white text-decoration-none d-block mb-3"> <p>Pendgin Orders</p> </a>
 <a href="{{route('admin.orders.shipped')}}"   class="text-white text-decoration-none d-block mb-3"><p>Shipped Orders</p></a>
 <a href="{{route('admin.orders.completed')}}" class="text-white text-decoration-none d-block mb-3"> <p>Completed Orders</p> </a>
 <a href="{{route('admin.orders.cancelled')}}" class="text-white text-decoration-none d-block mb-3"> <p>Cancelled Orders</p> </a>
</div>

 <h5 class="mb-3"><i class="fa-solid fa-people-roof me-1"></i>Customer Management</h5>
 <div class="ms-4">
<a href="{{route('admin.customer.list')}} "  class="text-white text-decoration-none d-block mb-3"> <p>View Customer Records</p> </a>
</div>





      </div>

    </div>


    <div class="d-none d-lg-flex me-3">

<form action="{{route('logout')}}" method="POST">
  @csrf
<button type="submit"  class="btn p-0 border-0 bg-transparent">
   <i class="fa-solid fa-right-from-bracket fs-4" style="color:white;cursor:pointer;"></i></button> 

</form>

  </div>



</nav>



