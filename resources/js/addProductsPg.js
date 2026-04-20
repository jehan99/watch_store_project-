
// //Specification Config

// //Addes  specification inputs feilds
// document.addEventListener("DOMContentLoaded", function(){

//     document.querySelector(".btn-addSpec").addEventListener("click", addSpecification);

//     function addSpecification() {

//         const container = document.querySelector(".spec-elements");

//         const row = document.createElement("div");
//         row.classList.add(
//             "mb-3",
//             "spec-row",
//             "d-grid",
//             "d-lg-flex",
//             "col-12"
//         );

//         row.innerHTML = `
//             <input 
//                 name="specification[key][]"  
//                 style="height:50px; font-weight:bold;"  
//                 class="form-control me-lg-2 mb-3" a
//                 placeholder="Specification"
//             >

//             <textarea 
//                 name="specification[value][]" 
//                 style="height:100px;" 
//                 placeholder="Enter Value" 
//                 class="form-control me-lg-2 mb-3">
//             </textarea>

//             <div class="d-flex justify-content-center justify-content-lg-end">
//                 <button class="btn btn-outline-warning specRemove-btn" style="height:50px;">
//                    (-)
//                 </button>
//             </div>
//         `;

//         container.appendChild(row);
//     }

// });
    
//     /*function addSpecification() {
//         const container = document.getElementById('specifications');
    
//         // wrapper row
//         const div = document.createElement('div');
//         div.classList.add('spec-row');
//         div.style.display = 'flex';
//         div.style.gap = '40px';
//         div.style.marginTop = '20px';
    
//         // input field
//         const input = document.createElement('input');
//         input.name = 'specification[key][]';
//         input.placeholder = 'Specification';
//         input.style.flex = 'none';
//         input.style.width = '350px';
//         input.style.height = '20px';
//         input.style.fontSize = '16px';
//         input.style.fontWeight = '600';
//         input.style.padding = '8px';
    
    
//         // textarea field
//         const textarea = document.createElement('textarea');
//         textarea.name = 'specification[value][]';
//         textarea.placeholder = 'Value';
//         textarea.style.width = '500px';
//         textarea.style.flex = '0 0 550px';
    
//         textarea.style.height = '20px';
//         textarea.style.fontSize = '15px';
//         textarea.style.padding = '8px';
//         textarea.style.resize = 'vertical';
    
        
    
//         // append fields
//         div.appendChild(input);
//         div.appendChild(textarea);
    
//         // append row to container
//         container.appendChild(div);
//     }
//      */
    
    
    
    
//     document.addEventListener("click", function(e){
    
//     const btn = e.target.closest(".specRemove-btn");
//     if(!btn) return;
    
//     e.preventDefault();
    
//     const row = btn.closest(".spec-row");
//     if(!row) return;
    
//     const allRows = document.querySelectorAll(".spec-row");
    
//       // If more than one row → remove it
//       if(allRows.length > 1){
//         row.remove();
//       } 
//       // If this is the LAST row → just clear inputs
//       else {
//         const inputs = row.querySelectorAll("input, textarea, select");
//         inputs.forEach(input => input.value = "");
//       }
    
//     })
    
//     //Add images section
//     /*function previewImage(input) {
//         const box = input.closest('.image-box');
//         const img = box.querySelector('.preview');
//         const placeholder = box.querySelector('.placeholder');
    
//         if (input.files && input.files[0]) {
//             const reader = new FileReader();
    
//             reader.onload = function (e) {
//                 img.src = e.target.result;
//                 img.classList.remove('d-none');
//                 placeholder.style.display = 'none';
//             };
    
//             reader.readAsDataURL(input.files[0]);
//         }
//     }
//     */
    
    
//     document.getElementById("productForm").addEventListener("submit", function (e) {
//         e.preventDefault();
    
//         const form = this;
//         const formData = new FormData(form);
    
    
//         if (mainDropzone.files.length > 0) {
//         formData.append("main_image", mainDropzone.files[0]);
//     } else {
//         alert("Please upload a main image.");
//         return;
//     }
//     //Gallery images 
//     galleryZones.forEach(dz => {
//             if (dz.files.length > 0) {
//                 formData.append("gallery_images[]", dz.files[0]);
//             }
//         });
    
//         fetch(form.action, {
//             method: "POST",
//             body: formData,
//             headers: {
//                 "X-CSRF-TOKEN": "{{ csrf_token() }}"
//             }
//         })
//         .then(response => {
            
//             if (!response.ok) throw new Error("Upload failed");
//             return response.text();
//         })
//         .then(() => {
//             alert("Product Added Successfully!");
    
//         // Reset form inputs
//         form.reset();
    
//         // Clear Dropzones
//         mainDropzone.removeAllFiles(true);
//         galleryZones.forEach(dz => dz.removeAllFiles(true));
    
//         // Optional: remove dynamically added specifications
//         const specs = document.querySelectorAll(".spec-row");
//         specs.forEach((row, index) => {
//             if(index > 0) row.remove();
//         });
//         })
//         .catch(err => {
//             alert(err.message);
//         });
//     });
    
//     //Dropzone configurations 
//     Dropzone.autoDiscover = false;
    
//     const mainDropzone = new Dropzone("#main-dropzone", {
//         url: "#",
//         autoProcessQueue: false,
//         maxFiles: 1,
//         addRemoveLinks: true,
//         thumbnailWidth: 300,
//         thumbnailHeight: 300,
//         init: function () {
//             this.on("maxfilesexceeded", function(file) {
//                 this.removeAllFiles();
//                 this.addFile(file);
//             });
//         }
//     });
    
//     const galleryZones = [];
//     document.querySelectorAll(".gallery-dropzone").forEach((el, index) => {
//         const dz = new Dropzone(el, {
//             url: "#",
//             autoProcessQueue: false,
//             maxFiles: 1,
//             addRemoveLinks: true,

//             init: function () {
//                 this.on("maxfilesexceeded", function(file) {
//                     this.removeAllFiles();
//                     this.addFile(file);
//                 });
//             }
            
//         });
//         galleryZones.push(dz);
//     });
    
    