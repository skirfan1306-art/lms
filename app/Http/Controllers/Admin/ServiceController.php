<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ServiceController extends Controller
{
   public function form(){
       return view('admin.service.services');
   }
   
   
   public function addService(Request $req){
       $service = new Service();
       $service->title = $req->title;
       $service->svg = $req->svg;
       $service->description = $req->description;
       $service->link = $req->link;
       $service->price = $req->price;
       $service->class = $req->class;
       $save=$service->save();
       
       if($save){
           return redirect()->back()->with('success','Service added successfully.');
       } else{
            return redirect()->back()->with('error','Service not added!.')->withInput();

       }
       
       
   }
   
   public function serviceTable(){
         $service = Service::all();
       return view('admin.service.allServices', compact('service'));
   }
   
   public function toggleStatus(Request $req){
       $service = Service::findOrFail($req->id);
       $service->status = $service->status == 1 ? 0 : 1;
       
       if($service->save()){
           return redirect()->back()->withSuccess('Status Update Successfully');
       }else{
           return redirect()->back()->withError('Status Not Updated!');
       }
   }
   
   
   public function edit($id){
       $service = Service::findOrFail($id);
       return view('admin.service.editService', compact('service'));
   }
   
   public function update(Request $req, $id){
       $service = Service::findOrFail($id);
       $service->title = $req->title;
       $service->svg  = $req->svg;
       $service->description = $req->description;
       $service->link = $req->link;
       $service->price = $req->price;
       $service->class = $req->class;
       $save=$service->save();
       
       if($save){
           return redirect()->back()->with('success','Service Updated Successfully.');
       }else{
           return redirect()->back()->with('error','Service Not Updated!');

       }
       
   }
   
   public function delete(Request $req){

       $service = Service::findOrFail($req->id);
       
       if($service->delete()){
           return  redirect()->back()->withSuccess('Service Delete Successfully');
       }else{
           return  redirect()->back()->withError('Service Not Deleted!');

       }
   }
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
}