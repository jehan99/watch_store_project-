<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

public function productHandler (Request $request ){
    


    $request->validate([
        'title'        => 'required|string|max:255',
        'description'  => 'required|string',
        'price'        => 'required|numeric',
        'stock'        => 'required|numeric',

        'main_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        'gallery_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        
    ]);

    $specifications = [];
    
    if ($request->has('specification')) {
        foreach ($request->specification['key'] as $index => $key) {
            if (!empty($key) && !empty($request->specification['value'][$index])) {
                $specifications[$key] = $request->specification['value'][$index];
            }
        }
    }
    
   
    $availability = $request->stock > 0 ? 'in_stock' : 'out_of_stock';


$product= Product::create([
'title'          => $request -> title,
'description'    => $request -> description,
'price'          => $request -> price,
'stock'          => $request->stock,
'availability'   => $availability,
'specifications' => $specifications,


]);



$mainPath = $request->file('main_image')->store('products', 'public');

ProductImage::create([
    'product_id' => $product->id,
    'image_path' => $mainPath,
    'is_main'    => true,
]);

/** Store GALLERY IMAGES **/
if ($request->hasFile('gallery_images')) {
    foreach ($request->file('gallery_images') as $image) {
        $path = $image->store('products', 'public');

        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $path,
            'is_main'    => false,
        ]);
    }
}

return response()->json([
    'status' => 'success',
    'message' => 'Product created successfully'
]);


}

public function displayProductsAdmin(){
     $products = Product::latest()->get(); // get all products
      return view('admin.view-products', compact('products')); 
    
}


public function displayProductToHomePg()
{
    $products = Product::with('mainImage')->latest()->get();

    return view('HomePage', compact('products'));
}



//Admin Pannel
public function deleteProduct($id)
{
    // Find the product by ID
    $product = Product::with('images')->findOrFail($id);

    // Delete all images from storage
    foreach ($product->images as $image) {
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
    }

    // Delete image records from DB
    $product->images()->delete();

    // Delete the product
    $product->delete();

    return redirect()->back()->with('success','Product delelted successfully!');
        
}





//Admin Pannel

public function upadateProductsPg($id)
{
    $product = Product::with(['mainImage', 'galleryImages'])->findOrFail($id);

    return view('admin.UpadateProductPg', compact('product'));
}



//Admin Pannel
public function updateProduct(Request $request, $id){



    $request->validate([
        'title'        => 'required|string|max:255',
        'description'  => 'required|string |max:500',
        'price'        => 'required|numeric',
        'stock'       =>  'required|numeric',
        'main_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp | max:5120',

    ]);

    //$product = Product::findOrFail($id);

    $product = Product::with('images')->findOrFail($id);


    $specs = [];

    $keys    = $request->input('specification.key', []);
    $values  = $request->input('specification.value', []);
    $removed = $request->input('remove_specs', []);
    
    foreach ($keys as $i => $key) {
    
        $key   = trim($key);
        $value = trim($values[$i] ?? '');
    
        // skip empty rows
        if ($key === '' || $value === '') continue;
    
        // skip removed specs
        if (in_array($key, $removed)) continue;
    
        $specs[$key] = $value;
    }

    $availability = $request->stock > 0 ? 'in_stock' : 'out_of_stock';

    $product->update([
        'title'  => $request->title,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'availability' => $availability,
        'specifications' => $specs,

    ]);

    if ($request->hasFile('main_image')) {
        $oldMain = $product->mainImage;

        if ($oldMain && Storage::disk('public')->exists($oldMain->image_path)) {
            Storage::disk('public')->delete($oldMain->image_path);
            $oldMain->delete();
        }

        $path = $request->file('main_image')->store('products', 'public');

        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $path,
            'is_main' => true,
        ]);
    }



    
    if ($request->hasFile('gallery_images')) {

   
        if ($request->filled('remove_gallery_images')) {
            foreach ($request->remove_gallery_images as $imageId) {
                $img = ProductImage::where('id', $imageId)
                    ->where('product_id', $product->id)
                    ->first();
        
                if ($img) {
                    Storage::disk('public')->delete($img->image_path);
                    $img->delete();
                }
            }
        }
        

        // store new gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('products', 'public');
        
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_main' => false,
                ]);
            }
        }
        

}
return redirect()->route('admin.products');


}



public function showClickedProduct($id)
{
    $product = Product::with(['mainImage', 'galleryImages'])->findOrFail($id);

    return view('clickedProductPg', compact('product'));
}




}