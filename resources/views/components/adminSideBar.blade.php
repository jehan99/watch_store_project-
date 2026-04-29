
<div class="text-white p-3 vh-100  pt-5 position-fixed admin-sidebar-bg">

  <a href="{{route('admin.dashboard')}}" style="text-decoration: none; color:white"><h4 class="mb-4"><i class="fa-solid fa-user-tie me-1"></i>ADMIN DASHBOARD</h4></a>

<hr>
 <h5 class="mb-4"> <i class="fa-solid fa-boxes-packing me-1"></i>Product Management</h5>
 <div class="ms-4">

  <a href="{{route('enterProductsDB')}}" class="text-white text-decoration-none d-block mb-2">
    Add Products
  </a>

  <a href="{{route('admin.products')}}" class="text-white text-decoration-none d-block mb-2">
    View / Update / Delete Products
  </a>

  <a href="{{route('homePage')}}" class="text-white text-decoration-none d-block mb-3">
    View Home Page
  </a>
  </div>

  <hr>

  <h5 class="mb-3"><i class="fa-regular fa-truck me-1"></i></i>Order Management</h5>
  <div class="ms-4">
   <a href="{{route('admin.orders.pending')}} "  class="text-white text-decoration-none d-block mb-3"> <p>Pendgin Orders</p> </a>
   <a href="{{route('admin.orders.shipped')}}"   class="text-white text-decoration-none d-block mb-3"><p>Shipped Orders</p></a>
   <a href="{{route('admin.orders.completed')}}" class="text-white text-decoration-none d-block mb-3"> <p>Completed Orders</p> </a>
   <a href="{{route('admin.orders.cancelled')}}" class="text-white text-decoration-none d-block mb-3"> <p>Cancelled Orders</p> </a>
   </div>

<hr>
<h5 class="mb-3"><i class="fa-solid fa-people-roof me-1"></i>Customer Management</h5>
<div class="ms-4">
<a href="{{route('admin.customer.list')}} "  class="text-white text-decoration-none d-block mb-3"> <p>View Customer Records</p> </a>
</div>



</div>

