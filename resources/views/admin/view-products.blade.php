@extends('layouts.admin')

@section('content')

<!-- @php
$hideSidebar = true;
@endphp -->

@if(session('success'))


<div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert"
    id="success-alert">
    <i class="fa fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

<script>
    setTimeout(function() {
        let alert = document.getElementById('success-alert');
        if (alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000); // 5 seconds
</script>
@endif


<div id="alertBox"></div>


<div class="container-fluid">
    <div class="row d-flex justify-content-center">

        <div class="body-sec">


            <h1>Product Listing</h1>

            <!-- <div class="table-responsive"> -->
            <table class="table table-secondary table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Specifications</th>
                        <th>Availability</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Delete/Update</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($products as $product)

                    <tr>
                        <th scope="row">{{$product->id}}</th>


                        <td>
                            {{-- Main Image with null check --}}
                            <div class="d-flex justify-content-center">

                                @if($product->mainImage)
                                <img src="{{ asset('storage/' . $product->mainImage->image_path) }}" alt="Main Image" width="70">
                                @else
                                <img src="{{ asset('storage/default.png') }}" alt="No Main Image" style="object-fit:cover;">
                                @endif
                            </div>

                            <div class="d-flex mt-1">
                                {{-- Gallery Images --}}
                                @foreach($product->galleryImages as $img)
                                <img src="{{ asset('storage/' . $img->image_path) }}" alt="Gallery Image" style="object-fit:cover;" width="60" class="me-1">
                                @endforeach
                            </div>

                        </td>

                        <td>{{$product->title}}</td>
                        <td>{{$product->description}}</td>
                        <td>
                            <ul class="mb-0">
                                @foreach ($product->specifications as $key => $value)
                                <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            @if($product->availability !== 'in_stock')
                            <p class="text-danger fw-bold text-center"> Out Of Stock</p>
                            @else
                            <p class="text-success fw-bold text-center">In Stock</p>
                            @endif
                        </td>


                        <td>{{$product->price}}</td>
                        <td>{{$product->stock}}</td>

                        <td class="text-center pt-3">


                            <a href="{{route('productsUpdatePg', $product->id)}}"> <button type="button" class="btn btn-warning mb-3 ">Update</button></a>

                            <form method="POST" action="{{ route('product.delete', $product->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger "
                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                    Delete
                                </button>


                            </form>

                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>


</div>
</div>

@endsection