<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class FrontPageController extends Controller
{
    public function products($category = null)
    {
        $query = Product::query();

        if ($category) {
            $cat = Category::where('slug', $category)
                           ->where('status', 1)
                           ->first();

            if ($cat) {
                $query->where('category_id', $cat->id);
            }
        }

        $products = $query->inRandomOrder()->get();

        $allProducts = Product::all();

        $brands = $allProducts->pluck('brand_id')->unique();
        $packSizes = $allProducts->pluck('pack_size')->unique();

        return view('front.products', compact('products', 'brands', 'packSizes'));
    }
}
