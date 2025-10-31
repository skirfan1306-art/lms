<?php
namespace App\Http\Controllers\Admin;

use App\Models\Homepage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    public function showBanners(){
        
        $homebanners = Homepage::orderBy('id', 'asc')->get();
        return view('admin.home.homeslider', compact('homebanners'));
    }
    
    public function addBanner(Request $req){
        
        $req->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'desktopImg' => 'required|image',
            'mobileImg' => 'required|image',
            
        ]);
        
        $homebanner = new Homepage();
        
        $homebanner->title = $req->title;
        $homebanner->subtitle = $req->subtitle;
        
        if($req->hasFile('desktopImg')){
            $desktopImgfile = $req->file('desktopImg');
            $desktopImgfileName = 'home-banner-desktop-'.time().".".$desktopImgfile->getClientOriginalExtension();
            $desktopImgfile->move(('assets/front/images/homepage/'), $desktopImgfileName);
            $homebanner->desktop_img = $desktopImgfileName;
        }
        if($req->hasFile('mobileImg')){
            $mobileImgfile = $req->file('mobileImg');
            $mobileImgfileName = 'home-banner-mobile-'.time().".".$mobileImgfile->getClientOriginalExtension();
            $mobileImgfile->move(('assets/front/images/homepage/'), $mobileImgfileName);
            $homebanner->mobile_img = $mobileImgfileName;
        }
        
        $homebanner->save();
        
         return back()->with($homebanner ? 'success' : 'error',
        $homebanner ? 'Banner added successfully!' : 'Banner not added!'
    );
        
    }
    
    public function homebannerstatus(string $id){
        
        
        $homebanner = Homepage::findOrFail($id);
        
        if($homebanner->status == 'Active'){
            
            $homebanner->status = 'Inactive';
        }else{
            $homebanner->status = 'Active';
        }
        
        $homebanner->save();
        
        if($homebanner){
           return response()->json([
                'success' => true,
                'status' => $homebanner->status
                 
            ]);
        }else{
            return response()->json([
                'error' => 'Unable to Update',
            ]);
        }
    }
    
    public function updateBanner(Request $req){
         $req->validate([
             'title' => 'required',
             'subtitle' => 'required',
             ]);
             
             $data =  Homepage::findOrFail($req->hid);
             
             
             $data->title = $req->title;
             $data->subtitle = $req->subtitle;
             
            //  desktop image update
             $olddeskImage = $data->desktop_img;
             
             if($req->hasFile('desktopImg')){
                 $path = base_path('assets/front/images/homepage/');
                  
                 if(!empty($path.$olddeskImage) && file_exists($path.$olddeskImage)){
                      unlink($path.$olddeskImage);
                 }
                 
                 $newdeskimg = $req->file('desktopImg');
                 $newdeskimgname = 'home-banner-desktop-'.time().".".$newdeskimg->getClientOriginalExtension();
                 $newdeskimg->move('assets/front/images/homepage/', $newdeskimgname);
                 $data->desktop_img = $newdeskimgname;
                 
                 
             }
             
            //  mobile image update
            
            $oldMobiImg = $data->mobile_img;
            if($req->hasFile('mobileImg')){
                $path = base_path('assets/front/images/homepage/');
                
                if(!empty($path.$oldMobiImg) && file_exists($path.$oldMobiImg)){
                    unlink($path.$oldMobiImg);
                }
                
                $newmobiimg = $req->file('mobileImg');
                $newmobiimgname = 'home-banner-mobile-'.time().".".$newmobiimg->getClientOriginalExtension();
                $newmobiimg->move('assets/front/images/homepage/',$newmobiimgname );
                $data->mobile_img = $newmobiimgname;
                
                
            }
            
             $saved = $data->save();
            return back()->with($saved ? 'success' : 'error',
        $saved ? 'Home Banner updated successfully!' : 'Home Banner not updated!'
    );
             
             
             
    }

 


}