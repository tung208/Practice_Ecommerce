<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class BrandController extends Controller
{
    //
    public function viewBrand(){
        $brands= Brand::latest() -> get();
        return view('backend.brand.view_brand',compact('brands'));
    }
    public function storeBrand(Request $request){
        $request-> validate([
           'brand_name_en' => 'required',
            'brand_image' => 'required',
        ],[
            'brand_name_en.required' => 'Please input brand name',
            'brand_image.required' => 'Please input brand name',
        ]);
        $brand_image = $request-> file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$brand_image-> getClientOriginalName();
        Image:: make($brand_image) -> resize(200,200) -> save('upload/brand/'.$name_gen);
        $save_url= 'upload/brand/'.$name_gen;

        Brand::insert([
           'brand_name_en' => $request -> brand_name_en,
            'brand_slug_en' => strtolower(str_replace(' ','-',$request-> brand_name_en)),
            'brand_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );

       return redirect()-> back() -> with($notification);
    }
    public function editBrand($id){
        $brand = Brand::findOrFail($id);
        return view('backend.brand.edit_brand',compact('brand'));
    }
    public function updateBrand(Request $request){
        $brand_id = $request-> id;
        $old_image = $request-> old_image;
        if($request-> file('brand_image')){
            unlink($old_image);
            $image = $request-> file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image ->getClientOriginalName();
            $img_url= 'upload/brand/'.$name_gen;
            Image:: make($image) -> resize(200,200) -> save($img_url);
            Brand::findOrFail($brand_id)-> update([
                'brand_name_en' => $request -> brand_name_en,
                'brand_slug_en' => strtolower(str_replace(' ','-',$request-> brand_name_en)),
                'brand_image' => $img_url,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Brand Update Successfully',
                'alert-type' => 'success'
            );
            return redirect() -> back() -> with($notification);
        }else{
            Brand::findOrFail($brand_id)-> update([
                'brand_name_en' => $request -> brand_name_en,
                'brand_slug_en' => strtolower(str_replace(' ','-',$request-> brand_name_en)),
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Brand Update Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect() -> route('admin.viewBrand') -> with($notification);
        }
    }
    public function deleteBrand($id){
        Brand::findOrFail($id) -> delete();
        $notification = array(
            'message' => 'Brand Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect() -> back() -> with($notification);
    }

}
