<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Mail\AdminMailController;

class AdminController extends Controller
{

    public function addAdmin(Request $req)
    {
        $validated = $req->validate([
            'email'    => 'required|email|unique:admins,email',
        ]);

        $admin = Admin::create([
            'email'    => $validated['email'],
            'role'     => $req->role,
        ]);

        (new AdminMailController)->addAdminMail($validated['email']);

        return redirect()->back()->withSuccess("Admin added successfully")->withInput();
    }
    public function updateAdmin(Request $req){
        $req->validate([
            'email' => [
                'required',
                Rule::unique('admins', 'email')->ignore($req->id),
            ],
        ]);
        $admin = Admin::findOrFail($req->id);
        $admin->name = $req->name;
        $admin->email = $req->email;
        $admin->role = $req->role;

        if($admin->save()){
            return redirect()->back()->withSuccess('Admin Update Succesfully.');
        }else{
            return redirect()->back()->withError('Admin Not Updated!');
        }
    }
    public function status(Request $req)
    {
        $admin = Admin::findOrFail($req->id);
        $admin->status = $admin->status == 1 ? 0 : 1;

        if ($admin->save()) {
            return redirect()->back()->withSuccess('Status Updated Successfully.');
        } else {
            return redirect()->back()->withError('Status Not Updated!');
        }
    }
    public function deleteAdmin(Request $req)
    {
        $admin = Admin::findOrFail($req->id);
        if ($admin->delete()) {
            return redirect()->back()->withSuccess('Admin Deleted successfully.');
        } else {
            return redirect()->back()->withError('Admin Not Deleted!');
        }
    }


    public function profileUpdate(Request $req, $id){
        $admin = Admin::findOrFail($id);
        $admin->name = $req->name;

        if($admin->save()){
            return redirect()->back()->withSuccess('Profile Update Succesfully.');
        }else{
            return redirect()->back()->withError('Profile Not Update!');
        }
    }

    public function changepassword(Request $req, $id)
    {
        $admin = Admin::findOrFail($id);

        $validated = $req->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($req->old_password, $admin->password)) {
            return redirect()->back()->withError('Old password does not match!');
        }

        $admin->password = Hash::make($req->password);

        if ($admin->save()) {
            return redirect()->back()->withSuccess('New Password Updated.');
        } else {
            return redirect()->back()->withError('Password Not Changed!');
        }
    }


    
}
