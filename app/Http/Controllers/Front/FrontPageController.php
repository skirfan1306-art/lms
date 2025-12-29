<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Blogcategory;
use App\Models\ContactForm;

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
    
    
    public function contactPage(){
        return view('front.contact');
    }
    
    
    public function contactFrom(Request $request)
    {
        try {
    
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'contact' => 'required|regex:/^[0-9]+$/|max:255',
                'subject' => 'required|string',
                'message' => 'required|string'
            ]);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
    
            // Force redirect with #contact-form
            $e->redirectTo = url()->previous() . '#contact-form';
            throw $e;
        }
    
        // Save data
        $contact = new ContactForm();
        $contact->name = $request->name;
        $contact->contact = $request->contact;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->created_at = date('Y-m-d');
        $contact->save();
    
        return redirect()->back()->with('success', 'Your message has been sent successfully.')->withFragment('contact-form');
    }

 

}
