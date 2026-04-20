@extends('layouts.admin')

@section('title', 'addProductsPage')


@section('content')


<div id="alertBox"></div>


<h2 class="text-center">ADD PRODUCTS </h2>


<form method=POST  action="{{ route('enterProductsDB') }}" enctype="multipart/form-data" id="productForm">
@csrf

<div class="container">
<div class="row">
<div class="col-10 col-sm-12 col-md-10 col-lg-6 mt-5 mx-auto">
  <div class="mb-3">
    <label  class="form-label">Item Title:(max: 20 characters)</label>
    <input type="text" name="title" class="form-control  fw-bold fs-3" maxlength="20">
  </div>

  <div class="mb-3">
  <label> Item Description: (max characters 500)  </label>
  <textarea name="description" class="form-control" rows="4" maxlength="500"></textarea>
  </div>
    
  <div class="mb-3">
  <label> Price:  </label> 
  <input name="price" type="number" class="form-control w-50 py-2" placeholder="LKR">
  </div>

  <div class="mb-3">
  <label> Stock:  </label> 
  <input name="stock" type="number" class="form-control w-25 py-2" >
  </div>

    <div class="mb-3 "> 
    <label>Main Image</label> 
  
    <div class="d-flex justify-content-center">
        <div id="main-dropzone" class="dropzone" style="height:200px;"></div>
        <input type="file" name="main_image" id="mainImageInput" hidden>

    </div>

  </div>

    <div class="container mb-3">
  <label>Gallery Images</label>

  <div class="gallery-images d-flex flex-wrap" style="gap: 10px; justify-content: center;">
    <div class="gallery-dropzone dropzone" data-index="0"></div>
    <div class="gallery-dropzone dropzone" data-index="1"></div>
    <div class="gallery-dropzone dropzone" data-index="2"></div>
    <div class="gallery-dropzone dropzone" data-index="3"></div>
  </div>
  <input type="file" name="gallery_images[]" id="galleryImagesInput" multiple hidden>

</div>

<div id="specifications">

    <div class="mb-3 d-flex align-items-center">
        <label class="me-4">Specifications:</label>  
        <button type="button" onclick="addSpecification()" class="btn btn-outline-secondary btn-addSpec">
            + Add Specification
        </button>
    </div>

    <div class="spec-elements d-grid justify-content-center">

    <div class="mb-1 d-grid d-lg-flex spec-row col-12 col-sm-12">


            <input 
                name="specification[key][]"  
                style="height:65px; font-weight:bold;"  
                class="form-control me-2 mb-2" 
                placeholder="Specification"
            >

            <textarea 
                name="specification[value][]" 
                style="height:65px;" 
                placeholder="Enter Value" 
                class="form-control me-2 mb-1 ps-0 text-start">
            </textarea>

            <div class="d-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-end">
            <button type="button" class="btn btn-danger specRemove-btn w-100 mb-3" style="height:65px;" >X</button>
</div> 

        </div>

    </div>

</div>


  <div class="text-center mt-4">
<button type="submit" class="btn btn-success btn-addProduct">
<span class="btn-text">Add Product</span>
<span class="spinner-border spinner-border-sm d-none ms-2" role="status"></span>

</button> 
  </div>
 


</div>
</div>
</div>
</form>


<script>
document.addEventListener("DOMContentLoaded", function () {

    // =====================
    // DROPZONE INIT
    // =====================
    Dropzone.autoDiscover = false;

    const mainDropzone = new Dropzone("#main-dropzone", {
        url: "#",
        autoProcessQueue: false,
        maxFiles: 1,
        addRemoveLinks: true
    });

    const galleryZones = [];

    document.querySelectorAll(".gallery-dropzone").forEach((el) => {
        const dz = new Dropzone(el, {
            url: "#",
            autoProcessQueue: false,
            maxFiles: 1,
            addRemoveLinks: true
        });

        galleryZones.push(dz);
    });


    // =====================
    // IMAGE COMPRESSION
    // =====================
    async function compressImage(file) {
        const options = {
            maxSizeMB: 1,
            maxWidthOrHeight: 1920,
            useWebWorker: true
        };

        return await imageCompression(file, options);
    }


    // =====================
    // FORM SUBMIT
    // =====================
    document.getElementById("productForm").addEventListener("submit", async function (e) {
        e.preventDefault();

        const submitBtn = document.querySelector(".btn-addProduct");
        const btnText = submitBtn.querySelector(".btn-text");
        const spinner = submitBtn.querySelector(".spinner-border");
        const alertBox = document.getElementById("alertBox");

        const formData = new FormData(this);

        // START LOADING
        submitBtn.disabled = true;
        btnText.textContent = "Adding...";
        spinner.classList.remove("d-none");

        try {

            // =====================
            // MAIN IMAGE
            // =====================
            const mainFile = mainDropzone.getAcceptedFiles()[0];
            if (!mainFile) throw new Error("Main image is required");

            const compressedMain = await compressImage(mainFile);
            formData.append("main_image", compressedMain);

            // =====================
            // GALLERY IMAGES
            // =====================
            for (let dz of galleryZones) {
                const file = dz.getAcceptedFiles()[0];
                if (file) {
                    const compressed = await compressImage(file);
                    formData.append("gallery_images[]", compressed);
                }
            }

            // =====================
            // SEND TO LARAVEL
            // =====================
            const response = await fetch(this.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || "Upload failed");
            }

            // =====================
            // SUCCESS ALERT
            // =====================
            alertBox.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${data.message || "Product added successfully!"}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;

            alertBox.scrollIntoView({
                behavior: "smooth",
                block: "center"
            });

            // AUTO CLOSE ALERT
            setTimeout(() => {
                const alertEl = alertBox.querySelector(".alert");
                if (alertEl && window.bootstrap) {
                    new bootstrap.Alert(alertEl).close();
                }
            }, 3000);

            // =====================
            // RESET FORM
            // =====================
            this.reset();
            mainDropzone.removeAllFiles(true);
            galleryZones.forEach(dz => dz.removeAllFiles(true));

        } catch (err) {
            console.error(err);
            alert(err.message);

        } finally {
            // STOP LOADING
            submitBtn.disabled = false;
            btnText.textContent = "Add Product";
            spinner.classList.add("d-none");
        }
    });

});
</script>
@endsection