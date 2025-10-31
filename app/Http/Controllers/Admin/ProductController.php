<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $brand = Brand::orderBy('name')->get();
        $category = Category::orderBy('name')->get();
        return view('admin.product.add', compact('category', 'brand'));
    }

    public function show()
    {
        $products = Product::latest()->get();
        // return $products;
        return view('admin.product.products', compact('products'));
    }

    private function generateSku()
    {
        do {
            $sku = mt_rand(1000000, 9999999);
        } while (Product::where('sku', $sku)->exists());

        return $sku;
    }

    public function create(Request $req)
    {
        $req->validate([
            'name'        => 'required|unique:products,name',
            'description' => 'required',
            'pack_size'   => 'required',
            'quantity'    => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id'    => 'required|exists:brands,id',
            'old_price'   => 'required|numeric',
            'sale_price'  => 'required|numeric',
            'thumbnail'   => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'specification.*' => 'nullable|string',
            'value.*'        => 'nullable|string',
            'format'      => 'nullable',
            'product'     => 'nullable',
            'tag'         => 'nullable|string',
            'search'      => 'nullable|string',
            'status'      => 'required|boolean',
        ]);

        $sku = $this->generateSku();
        $slug = Str::slug($req->name);

        // ---------- Thumbnail Upload ----------
        $thumbnail = null;
        if ($req->hasFile('thumbnail')) {
            if ($req->has('make_webp')) {
                $thumbnail = $this->uploadFileWebp($req->file('thumbnail'), 'thumbnail');
            } else {
                $thumbnail = $this->uploadFileNormally($req->file('thumbnail'), 'thumbnail');
            }
        }

        // ---------- Gallery Upload ----------
        $gallery = [];
        if ($req->hasFile('images')) {
            foreach ($req->file('images') as $img) {
                if ($req->has('make_webp')) {
                    $gallery[] = $this->uploadFileWebp($img, 'gallery');
                } else {
                    $gallery[] = $this->uploadFileNormally($img, 'gallery');
                }
            }
        }

        // ---------- Specifications ----------
        $specifications = [];
        if ($req->has('specification') && $req->has('value')) {
            foreach ($req->specification as $index => $spec) {
                if (!empty($spec) && !empty($req->value[$index])) {
                    $specifications[] = [
                        'specification' => $spec,
                        'value'         => $req->value[$index],
                    ];
                }
            }
        }

        // ---------- Attributes ----------
        $attributes = [
            'format'  => $req->format,
            'product' => $req->product,
        ];

        // ---------- Save Product ----------
        $product = Product::create([
            'sku'            => $sku,
            'name'           => $req->name,
            'slug'           => $slug,
            'category_id'    => $req->category_id,
            'brand_id'       => $req->brand_id,
            'old_price'      => $req->old_price,
            'sale_price'     => $req->sale_price,
            'pack_size'      => $req->pack_size,
            'quantity'       => $req->quantity,
            'attributes'     => json_encode($attributes),
            'specifications' => json_encode($specifications),
            'description'    => $req->description,
            'policy'         => $req->policy,
            'thumbnail'      => $thumbnail,
            'images'         => json_encode($gallery),
            'tag'            => $req->tag,
            'search_keyword' => $req->search,
            'status'         => $req->status,
        ]);

        return back()->with($product ? 'success' : 'error', $product ? 'Product created successfully!' : 'Failed to create product!');
    }
    
public function edit($id)
{
    $edit = Product::findOrFail($id)->first();
    $brand = Brand::orderBy('name')->get();
    $category = Category::orderBy('name')->get();
    return view('admin.product.edit', compact('edit', 'category', 'brand'));
}

public function update(Request $req, $id)
{
    $product = Product::findOrFail($id);

    $req->validate([
        'name'        => 'required|unique:products,name,' . $product->id,
        'description' => 'required',
        'pack_size'   => 'required',
        'quantity'    => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'brand_id'    => 'required|exists:brands,id',
        'old_price'   => 'required|numeric',
        'sale_price'  => 'required|numeric',
        'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'specification.*' => 'nullable|string',
        'value.*'        => 'nullable|string',
        'status'      => 'required|boolean',
    ]);

    $slug = Str::slug($req->name);

    // ---------- Handle Thumbnail ----------
    $thumbnail = $product->thumbnail;
    if ($req->hasFile('thumbnail')) {

        $oldThumbPath = base_path('assets/front/images/products/' . $product->thumbnail);
        if ($product->thumbnail && file_exists($oldThumbPath)) {
            unlink($oldThumbPath);
        }

        if ($req->has('make_webp')) {
            $thumbnail = $this->uploadFileWebp($req->file('thumbnail'), 'thumbnail');
        } else {
            $thumbnail = $this->uploadFileNormally($req->file('thumbnail'), 'thumbnail');
        }
    }

    // ---------- Handle Gallery ----------
    $existingGallery = $product->images ? json_decode($product->images, true) : [];

    // Remove deleted images
    if ($req->filled('delete_images')) {
        $deleteImages = json_decode($req->delete_images, true);
        foreach ($deleteImages as $img) {
            $imgPath = base_path('assets/front/images/products/' . $img);
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
            $existingGallery = array_diff($existingGallery, [$img]);
        }
    }

    // Add new images
    if ($req->hasFile('images')) {
        foreach ($req->file('images') as $img) {
            if ($req->has('make_webp')) {
                $existingGallery[] = $this->uploadFileWebp($img, 'gallery');
            } else {
                $existingGallery[] = $this->uploadFileNormally($img, 'gallery');
            }
        }
    }

    // ---------- Specifications ----------
    $specifications = [];
    if ($req->has('specification') && $req->has('value')) {
        foreach ($req->specification as $index => $spec) {
            if (!empty($spec) && !empty($req->value[$index])) {
                $specifications[] = [
                    'specification' => $spec,
                    'value'         => $req->value[$index],
                ];
            }
        }
    }

    // ---------- Attributes ----------
    $attributes = [
        'format'  => $req->format,
        'product' => $req->product,
    ];

    // ---------- Update Product ----------
    $updated = $product->update([
        'name'           => $req->name,
        'slug'           => $slug,
        'category_id'    => $req->category_id,
        'brand_id'       => $req->brand_id,
        'old_price'      => $req->old_price,
        'sale_price'     => $req->sale_price,
        'pack_size'      => $req->pack_size,
        'quantity'       => $req->quantity,
        'attributes'     => json_encode($attributes),
        'specifications' => json_encode($specifications),
        'description'    => $req->description,
        'policy'         => $req->policy,
        'thumbnail'      => $thumbnail,
        'images'         => json_encode(array_values($existingGallery)),
        'tag'            => $req->tag,
        'search_keyword' => $req->search,
        'status'         => $req->status,
    ]);

    return back()->with($updated ? 'success' : 'error', $updated ? 'Product updated successfully!' : 'Failed to update product!');
}


    private function uploadFileNormally($file, $field, $folder = 'assets/front/images/products/')
    {
        $destination = base_path($folder);
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        $name = time() . '_' . uniqid() . "_$field." . $file->getClientOriginalExtension();
        $file->move($destination, $name);

        return $name;
    }

    private function uploadFileWebp($file, $field, $folder = 'assets/front/images/products/')
    {
        $destination = base_path($folder);
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        $ext = strtolower($file->getClientOriginalExtension());
        $name = time() . '_' . uniqid() . "_$field.webp";
        $fullPath = $destination . '/' . $name;

        if (in_array($ext, ['jpg', 'jpeg'])) {
            $img = imagecreatefromjpeg($file->getPathname());
        } elseif ($ext === 'png') {
            $img = imagecreatefrompng($file->getPathname());
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);
        } elseif ($ext === 'gif') {
            $img = imagecreatefromgif($file->getPathname());
        } else {
            // fallback: normal upload if format not supported
            $rawName = time() . '_' . uniqid() . "_$field." . $ext;
            $file->move($destination, $rawName);
            return $folder . $rawName;
        }

        imagewebp($img, $fullPath, 80);
        imagedestroy($img);

        return $name;
    }
    
public function view($id)
{
    $view = Product::findOrFail($id)->first();
    return view('admin.product.view', compact('view'));
}
}
