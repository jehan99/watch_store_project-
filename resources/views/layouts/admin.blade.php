<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Dropzone -->

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    
</head>


<body>
<x-adminNavbar />

<div class="container-fluid">
    <div class="row">

        <!-- Navbar -->

        <!-- Sidebar -->
        <div class="d-none d-lg-block col-lg-3 col-xxl-2 p-0 mt-4 ">
            <x-adminSideBar />
        </div>

        <!-- Page Content -->   
        <div class="col-12 col-lg-9 col-xxl-10 pt-4 mt-5 mb-5">
            @yield('content')
        </div>

    </div>
</div>


@vite(['resources/js/admin.js'])

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/browser-image-compression@2.0.2/dist/browser-image-compression.js"></script>


@stack('scripts')

</body>


</html>
