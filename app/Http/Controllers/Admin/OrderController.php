<?php

namespace App\Http\Controllers\Admin;

use App\Models\Instructor;
use App\Models\Course;
use App\Models\CourseOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Mail\InstructorMailController;

class OrderController extends Controller
{
    
    public function index()
    {
        $orders = CourseOrder::with('user')
            ->selectRaw('
                MIN(id) as id,
                order_no,
                user_id,
                total_amount,
                pay_amount,
                coupon_discount,
                payment_method,
                payment_status,
                order_status,
                transaction_id,
                created_at
            ')
            ->groupBy(
                'order_no',
                'user_id',
                'total_amount',
                'pay_amount',
                'coupon_discount',
                'payment_method',
                'payment_status',
                'order_status',
                'transaction_id',
                'created_at'
            )
            ->orderByDesc('id')->get();
    
        return view('admin.order.index', compact('orders'));
    }


    public function show()
    {
        $instructors = Instructor::all();

        return view('admin.instructor.index', compact('instructors'));
    }
    
    public function view($id)
    {
        $order = CourseOrder::findOrFail($id);
    
        $items = CourseOrder::with('course')->where('order_no', $order->order_no)->get();
    
        return view('admin.order.view', compact('order','items'));
    }

    
    public function edit($id)
    {
        $instructor = Instructor::findOrFail($id);

        return view('admin.instructor.edit', compact('instructor'));
    }



    public function create(Request $req)
    {
        $req->validate([
            'image'        => 'required|image|mimes:jpg,jpeg,png,webp',
            'name'         => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'email'        => 'required|email|unique:instructors,email',
            'number'       => 'required|numeric',
            'designation'  => 'required|string',
            'description'  => 'required|string',
        ]);
    
        $instructor = new Instructor();
    
        $pass = $req->password ?? Str::random(8);
    
        $instructor->fill($req->only([
            'name',
            'email',
            'number',
            'designation',
            'description'
        ]));
    
        $instructor->password = Hash::make($pass);
    
        if ($req->hasFile('image')) {
            $imageName = time() . 'I' . uniqid() . '.' . $req->image->extension();
            $req->image->move(
                base_path('assets/front/images/instructor/'),
                $imageName
            );
            $instructor->image = $imageName;
        }
    
        $instructor->verified = 1;
    
        if ($instructor->save()) {
            (new InstructorMailController)->wellcomeMail($instructor, $pass);
            return back()->with('success', 'Instructor Added Successfully!');
        }
    
        return back()->with('error', 'Instructor not added!')->withInput();
    }

    
    public function update(Request $req)
    {
        $req->validate([
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'name'         => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'email'        => 'required|email|unique:instructors,email,' . $req->id,
            'number'       => 'required|numeric',
            'designation'  => 'required|string',
            'description'  => 'required|string',
        ]);
    
        $instructor = Instructor::findOrFail($req->id);
        $instructor->fill($req->only(['name', 'email', 'number', 'designation', 'description','facebook', 'linkedin', 'twitter', 'instagram']));

        if ($req->hasFile('image')) {
            $oldThumbPath = base_path('assets/front/images/instructor/' . $instructor->image);
            if ($instructor->image && file_exists($oldThumbPath)) {
                unlink($oldThumbPath);
            }
        
            $imageName = time() . 'I' . uniqid() . '.' . $req->image->extension();
            $req->image->move(base_path('assets/front/images/instructor/'), $imageName);
        
            $instructor->image = $imageName;
        }
    
        $saved = $instructor->save();
    
        if ($saved) {
            return back()->with('success', 'Instructor Updated Successfully!');
        } else {
            return back()->with('error', 'Instructor not Updated!')->withInput();
        }
    }
    

    public function status(Request $req)
    {
        $instructor = Instructor::findOrFail($req->id);
        $instructor->status = $instructor->status == 1 ? 0 : 1;

        if ($instructor->save()) {
            return redirect()->back()->withSuccess('Status Updated Successfully.');
        } else {
            return redirect()->back()->withError('Status Not Updated!');
        }
    }

    
    public function delete(Request $req)
    {
        $instructor = Instructor::findOrFail($req->id);
        
        if (!empty($instructor->image) && file_exists(base_path('assets/front/images/instructor/') . $instructor->image)) {
            unlink(base_path('assets/front/images/instructor/') . $instructor->image);
        }
        
        $deleted = $instructor->delete();

        if ($deleted) {
            return back()->with('success', 'Instructor Deleted Successfully!');
        } else {
            return back()->with('error', 'Instructor not Deleted!');
        }
    }




}