<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Course;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class AdminCouponController extends Controller
{

    public function index()
    {
        $courses = Course::where('status', 1)->get(); 
        $coupons = Coupon::latest()->get(); 
                          
        return view('admin.coupon', compact('courses', 'coupons'));
    }
    

    public function create(Request $request)
    {
        $data = $this->validateData($request);

        if (strtolower($data['apply_type']) !== 'course') {
            $data['course_id'] = null;
        }

        $data['used_count'] = 0;
        $data['status'] = '1';

        DB::transaction(function () use ($data) {
            Coupon::create($data);
        });

        return redirect()->back()->with('success', 'Coupon created successfully.');
    }


    public function update(Request $request)
    {
        $id = $request->input('id');
        $coupon = Coupon::findOrFail($id);

        $data = $this->validateData($request, $coupon->id);

        if (strtolower($data['apply_type']) !== 'course') {
            $data['course_id'] = null;
        }

        if (isset($data['used_count']) && isset($data['usage_limit']) && $data['used_count'] > $data['usage_limit']) {
            return redirect()->back()->withErrors(['used_count' => 'Used count cannot exceed usage limit.'])->withInput();
        }

        DB::transaction(function () use ($coupon, $data) {
            $coupon->update($data);
        });

        return redirect()->back()->with('success', 'Coupon updated successfully.');
    }



protected function validateData(Request $request, $ignoreId = null)
{
    $rules = [
        'code' => [
            'required',
            'string',
            'max:100',
            $ignoreId
                ? Rule::unique('coupons', 'code')->ignore($ignoreId)
                : Rule::unique('coupons', 'code'),
        ],
        'apply_type'    => ['required', 'string', Rule::in(['cart', 'course'])],
        'course_id'     => ['nullable', 'integer', 'exists:courses,id'],
        'discount_type' => ['required', 'string', Rule::in(['percent', 'fixed'])],
        'discount_value'=> ['required', 'numeric', 'min:0'],
        'min_purchase'  => ['nullable', 'numeric', 'min:0'],
        'start_date'    => ['required', 'date'],
        'end_date'      => ['required', 'date', 'after_or_equal:start_date'],
        'usage_limit'   => ['required', 'integer', 'min:1'],
        'used_count'    => ['nullable', 'integer', 'min:0'],
        'status'        => ['nullable', 'boolean'],
    ];

    // This will throw ValidationException and redirect automatically on failure
    $validated = $request->validate($rules);

    // Normalize apply_type
    $applyType = strtolower($validated['apply_type'] ?? '');
    if ($applyType === 'course') {
        // ensure course_id provided for course apply type
        $request->validate([
            'course_id' => ['required', 'integer', 'exists:courses,id'],
        ]);
        $validated['apply_type'] = 'course';
    } else {
        $validated['apply_type'] = 'cart';
    }

    // Normalize discount_type (keep as provided if valid)
    $validated['discount_type'] = $validated['discount_type'];

    // If percentage ('percent') enforce <= 100 — throw ValidationException if invalid
    if ($validated['discount_type'] === 'percent' && $validated['discount_value'] > 100) {
        throw ValidationException::withMessages([
            'discount_value' => ['Percentage discount cannot be more than 100.'],
        ]);
    }

    // Ensure used_count exists in validated data (default 0)
    if (!array_key_exists('used_count', $validated)) {
        $validated['used_count'] = $request->input('used_count', 0);
    }

    // Cast numeric types
    $validated['discount_value'] = (float) $validated['discount_value'];
    $validated['usage_limit']    = (int)   $validated['usage_limit'];
    $validated['used_count']     = (int)   $validated['used_count'];
    $validated['min_purchase']   = isset($validated['min_purchase']) ? (float) $validated['min_purchase'] : null;
    $validated['status']         = isset($validated['status']) ? (bool) $validated['status'] : 1;

    // Keep date strings as-is (DB accepts 'Y-m-d')
    $validated['start_date'] = $validated['start_date'];
    $validated['end_date']   = $validated['end_date'];

    return $validated;
}


    public function status(Request $req)
    {
        $coupon = Coupon::findOrFail($req->id);
        $coupon->status = $coupon->status == '1' ? '0' : '1';

        if ($coupon->save()) {
            return redirect()->back()->withSuccess('Status Updated Successfully.');
        } else {
            return redirect()->back()->withError('Status Not Updated!');
        }
    }
    
    public function delete(Request $req)
    {
        $coupon = Coupon::findOrFail($req->id);

        if ($coupon->delete()) {
            return redirect()->back()->withSuccess('Coupon Deleted successfully.');
        } else {
            return redirect()->back()->withError('Coupon Not Deleted!');
        }
    }
    

}
