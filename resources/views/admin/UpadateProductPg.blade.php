@extends('layouts.admin')

@section('title', 'updateProductsPage')


@section('content')

<h2 class="text-center">UPDATE PRODUCTS </h2>


<form method="POST" action="{{ route('product.update', $product->id) }}" id="productForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="container">
        <div class="row">
            <div class="col-10 col-sm-12 col-md-10 col-lg-6 mt-5 mx-auto">
                <div class="mb-3">
                    <label class="form-label">Item Title:</label>
                    <input type="text" name="title" class="form-control  fw-bold fs-3" value="{{$product->title}}">
                </div>

                <div class="mb-3">
                    <label> Item Description: </label>
                    <textarea name="description" class="form-control" rows="4" maxlength="500">{{$product->description}}</textarea>
                </div>

                <div class="mb-3">
                    <label> Price: </label>
                    <input name="price" type="number" class="form-control w-50 py-2" placeholder="LKR" value="{{$product->price}}">
                </div>

                <div class="mb-3">
                    <label> Stock: </label>
                    <input name="stock" type="number" class="form-control w-25 py-2" value="{{ $product->stock }}">
                </div>


                <div class="mb-3 ">
                    <label>Main Image</label>

                    <div class="d-flex justify-content-center">
                        <div id="main-dropzone" class="dropzone" style="height:200px;"></div>
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
                </div>


                <div id="specifications">

                    <div class="mb-3 d-flex align-items-center">
                        <label class="me-4">Specifications:</label>
                        <button type="button" onclick="addSpecification()" class="btn btn-outline-secondary btn-addSpec">
                            + Add Specification
                        </button>
                    </div>

                    <div>


                        <div class="spec-elements d-grid justify-content-center">

                            @foreach ($product->specifications as $key => $value)



                            <div class="mb-3 d-grid d-lg-flex spec-row col-12 col-sm-12">


                                <input
                                    name="specification[key][]"
                                    style="height:65px; font-weight:bold;"
                                    class="form-control me-2 mb-3"
                                    placeholder="Specification"
                                    value="{{ $key }}">

                                <textarea
                                    name="specification[value][]"
                                    style="height:65px;"
                                    placeholder="Enter Value"
                                    class="form-control me-2 mb-3">{{ $value }}</textarea>

                                <div class="d-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-end">
                                    <button class="btn btn-outline-warning specRemove-btn col-4" style="width: auto; height:65px;">
                                        (-)
                                    </button>
                                </div>

                            </div>



                            @endforeach
                        </div>


                        <div class="text-center mt-1">

                            <button type="button" class="btn btn-success btn-update">
                                <span class="btn-text">Update Product</span>
                                <span class="spinner-border spinner-border-sm d-none ms-2" role="status"></span>
                            </button>

                        </div>



                    </div>
                </div>
            </div>
</form>

<!-- @if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
alert("{{session('success')}}");
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>

@endif -->



@push('scripts')

@if($product->mainImage)
<script>
    //main image preload
    window.mainImage = {
        name: "Main Image",
        size: 123456, // approximate size
        url: "{{ asset('storage/' . $product->mainImage->image_path) }}"
    };
</script>
@endif


<script>
  window.galleryImages = [
    @foreach($product -> galleryImages as $index => $img) {
        id: {{$img->id}},
        index: {{$index}},
        name: "Gallery Image",
        size: 123456,
        url: "{{ asset('storage/' . $img->image_path) }}"
    }
    @if(!$loop-> last),
    @endif
    @endforeach
];
</script>





<script>

// function addSpecification() {
//     const container = document.querySelector(".spec-elements");

//     const newRow = document.createElement("div");
//     newRow.classList.add("mb-1", "d-grid", "d-lg-flex", "spec-row", "col-12", "col-sm-12");

//     newRow.innerHTML = `
//         <input
//             name="specification[key][]"
//             style="height:65px; font-weight:bold;"
//             class="form-control me-2 mb-2"
//             placeholder="Specification">

//         <textarea
//             name="specification[value][]"
//             style="height:65px;"
//             placeholder="Enter Value"
//             class="form-control me-2 mb-1 ps-0 text-start"></textarea>

//         <div class="d-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-end">
//             <button type="button" class="btn btn-outline-warning specRemove-btn w-100 mb-3" style="height:65px;">(-)</button>
//         </div>
//     `;

//     container.appendChild(newRow);
// }


    async function compressImage(file) {
        const options = {
            maxSizeMB: 1,
            maxWidthOrHeight: 1920,
            useWebWorker: true
        };

        return await imageCompression(file, options);
    }

    Dropzone.autoDiscover = false;

    const mainDropzone = new Dropzone("#main-dropzone", {
        url: "#",
        autoProcessQueue: false,
        maxFiles: 1,
        addRemoveLinks: true,
        thumbnailWidth: 500,
        thumbnailHeight: 500
    });



    let mainImageExists = !!window.mainImage;

    mainDropzone.on("addedfile", function(file) {
        mainImageExists = true;



    });

    mainDropzone.on("removedfile", function(file) {
        // Only set false if there is no file left
        if (mainDropzone.files.length === 0) {
            mainImageExists = false;

        }
    });





    //Preloadgin Main image
    if (window.mainImage) {
        let mockFile = {
            name: window.mainImage.name,
            size: window.mainImage.size,
            isExisting: true
        };

        mainDropzone.emit("addedfile", mockFile);
        mainDropzone.emit("thumbnail", mockFile, window.mainImage.url);
        mainDropzone.emit("complete", mockFile);

        mainDropzone.files.push(mockFile);
        mainImageExists = true;

    }



    const galleryZones = [];
    document.querySelectorAll(".gallery-dropzone").forEach((el, index) => {

        const dz = new Dropzone(el, {
            url: "#",
            autoProcessQueue: false,
            maxFiles: 1,
            addRemoveLinks: true,
            thumbnailWidth: 500,
            thumbnailHeight: 500
        });

        // BLOCK auto-replace
        dz.on("addedfile", function(file) {
            const existingFile = this.files.find(f => f.isExisting);

            if (existingFile && file !== existingFile) {
                this.removeFile(file); // remove NEW upload
                alert("Please remove the existing image first.");
            }
        });

        //  Track manual removals only
        dz.on("removedfile", function(file) {
            if (file.isExisting && file.imageId) {
                let input = document.createElement("input");
                input.type = "hidden";
                input.name = "remove_gallery_images[]";
                input.value = file.imageId;
                document.getElementById("productForm").appendChild(input);
            }
        });

        galleryZones.push(dz);
    });




    window.galleryImages.forEach(image => {

const dz = galleryZones[String(image.index)];

if (!dz) return;

let mockFile = {
    name: image.name,
    size: image.size,
    imageId: image.id,
    isExisting: true
};

dz.emit("addedfile", mockFile);
dz.emit("thumbnail", mockFile, image.url);
dz.emit("complete", mockFile);

dz.files.push(mockFile);
});

    function getGalleryImageCount() {
        let count = 0;

        galleryZones.forEach(zone => {
            zone.files.forEach(file => {
                // count only if the file still exists (not removed)
                if (!file._removed) {
                    count++;
                }
            });
        });

        return count;
    }





    //specification btn configuration 
    document.addEventListener("click", function(e) {

        const btn = e.target.closest(".specRemove-btn");
        if (!btn) return;

        e.preventDefault();

        const row = btn.closest(".spec-row");
        if (!row) return;

        // GET ORIGINAL DB KEY
        const originalKey = row.dataset.originalKey;

        // MARK FOR BACKEND DELETE (ONLY when update button pressed later)
        if (originalKey) {
            let hidden = document.createElement("input");
            hidden.type = "hidden";
            hidden.name = "remove_specs[]";
            hidden.value = originalKey;
            document.getElementById("productForm").appendChild(hidden);
        }

        const allRows = document.querySelectorAll(".spec-row");

        // If more than one row → remove it
        if (allRows.length > 1) {
            row.remove();
        }
        // If this is the LAST row → just clear inputs
        else {
            const inputs = row.querySelectorAll("input, textarea, select");
            inputs.forEach(input => input.value = "");
        };

    })

    document.querySelector(".btn-addSpec").addEventListener("click", function() {
        const container = document.querySelector(".spec-elements");

        const row = document.createElement("div");
        row.className = "spec-row gap-1 mb-1";

        row.innerHTML = `
        <div class="d-grid d-lg-flex">
        <hr>
            <input name="specification[key][]" class="form-control mb-2 me-2" placeholder="Specification" style="height:65px; font-weight:bold;">
            <textarea name="specification[value][]" class="form-control me-2 mb-2" style="height:65px; font-weight:bold;"></textarea>
            <div class="d-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-end">
            <button type="button" class="btn btn-outline-warning specRemove-btn w-100 mb-3" style="height:65px;">(-)</button>
        </div>
            
            `;

        container.appendChild(row);
    });



    document.querySelector(".btn-update").addEventListener("click", async function(e) {

        const upDateBtn = document.querySelector(".btn-update");
        const btnText = upDateBtn.querySelector(".btn-text");
        const spinner = upDateBtn.querySelector(".spinner-border");


        e.preventDefault();

        upDateBtn.disabled = true;
        btnText.textContent = "Updating..";
        spinner.classList.remove("d-none");

        try {
            if (!mainImageExists) {
                alert("Please upload a main image.");


                upDateBtn.disabled = false;
                btnText.textContent = "Update Product";
                spinner.classList.add("d-none");

                return; // STOP — no fetch, no redirect

            }


            const galleryCount = getGalleryImageCount();

            if (galleryCount !== 4) {

                upDateBtn.disabled = false;
                btnText.textContent = "Update Product";
                spinner.classList.add("d-none");
                alert("Please enter total 4 gallery images.");
                return;
            }



            let form = document.getElementById("productForm");
            let formData = new FormData(form);
            formData.append('_method', 'PUT');

            // Attach main image
            const mainFiles = mainDropzone.getAcceptedFiles();

            if (mainFiles.length > 0 && !mainFiles[0].isExisting) {

                const compressedMain = await compressImage(mainFiles[0]);
                formData.append("main_image", compressedMain);

            }

            // Attach gallery images
            for (let zone of galleryZones) {
                const file = zone.getAcceptedFiles()[0];

                if (file && !file.isExisting) {
                    const compressedGallery = await compressImage(file);
                    formData.append("gallery_images[]", compressedGallery);
                }
            }


            // fetch MUST BE OUTSIDE the loop
            fetch("{{ route('product.update', $product->id) }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            }).then(() => {
                alert("Product Updated Successfully");
                window.location.href = "{{ route('updatedPorductView') }}";




            });


        } catch (err) {
            console.error(err);
            alert(err.message);

        } finally {
            // STOP LOADING
            upDateBtn.disabled = false;
            btnText.textContent = "Update Product";
            spinner.classList.add("d-none");
        }

    });
</script>
@endpush






@endsection