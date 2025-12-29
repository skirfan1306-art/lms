<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Blogcategory;
use App\Models\ContactForm;
use App\Models\Course;
use App\Models\CourseOrder;
use App\Models\user;

class InstructorController extends Controller
{

    public function dashboard(){
        
        // $user = Auth::user();
        // $orders = CourseOrder::with(['user', 'course'])
        //     ->where('payment_status', 'paid')
        //     ->where('user_id', $user->id)
        //     ->whereIn('id', function ($q) use ($user) {
        //         $q->selectRaw('MIN(id)')
        //           ->from('course_orders')
        //           ->where('payment_status', 'paid')
        //           ->where('user_id', $user->id)
        //           ->groupBy('order_no');
        //     })->orderBy('id', 'desc')->get();
        
        $orders = null;

        return view('instructor.index',compact('orders'));
    }

    public function orderDetails($id){
        $user = Auth::user();
        $orders = CourseOrder::with(['user', 'course'])->where('order_no', $id)->where('user_id', $user->id)->get();
        
        if($orders->count() == 0){
            return redirect()->back()->withError('Order not found!');
        }
        
        return view('user.order-detail', compact('orders'));
    }
    
    public function myCourse(){
        return view('user.my-course');
    }
    
    public function certificate(){
        return view('user.certificate');
    }
    
    public function profile(){
        return view('user.profile');
    }
    
    public function profileUpdate(Request $request)
    {
        // return $request->number;
        // $user = user::where('id', $request->id)->first();
        $user = Auth::user();
        
        if(!$user){
               return redirect()->back()->withError('User not found');
        }else if($user->email != $request->email){
            return redirect()->back()->withError("Email can't be change. Please contact support");
            
        }else{
            
        $request->validate([
          'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
          'name' => 'required|string|max:225',
          'number'   => 'required|numeric'
            
        ]);
        
        // ---- File Upload ----
        if ($request->hasFile('image')) {
             if ($user->image && file_exists(base_path('assets/front/images/users/' . $user->image))) {
                    unlink(base_path('assets/front/images/users/' . $user->image));
                }
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
        
            $file->move(base_path('assets/front/images/users'), $filename);
            
            
            $user->image = $filename;
        }
            
        $user->name = $request->name;
        $user->number = $request->number;
        $user->save();
        return redirect()->back()->withSuccess('Profile updated successfully!');
        
        }
    }
    
    public function passwordUpdate(Request $request){
       $validated = $request->validate([
            'password' => [
                            'required',
                            'confirmed',
                            'min:8',
                            'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/'
                        ],
            ],
            [
            'password.confirmed' => 'Passwords do not match.',
            'password.min'       => 'Password must be at least :min characters long.',
            'password.regex'     => 'Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.', 
            ]
            );
            
   
      
        $user = user::where('id', $request->id)->first();
         $user->password = Hash::make($validated['password']);
         
        $user->save();
        return redirect()->back()->withSuccess('Password updated successfully!');
        
        
    }

 

}