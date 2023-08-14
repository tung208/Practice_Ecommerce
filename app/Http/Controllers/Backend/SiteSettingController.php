<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Image;

class SiteSettingController extends Controller
{
    //
    public function changeProfileCompany(){
        $setting = SiteSetting::find(1);
        return view('backend.company_profile_setup',compact('setting'));
    }
    public function updateProfileCompany(Request $request)
    {
        $setting_id = $request->id;
        if ($request->file('logo')) {
            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()) . '_' . $image->getClientOriginalName();
            Image::make($image)->resize(153, 64)->save('upload/logo/' . $name_gen);
            $save_url = 'upload/logo/' . $name_gen;
            SiteSetting::findOrFail($setting_id)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
                'logo' => $save_url,
            ]);
            $notification = array(
                'message' => 'Setting Update With Image Success',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } else{
            SiteSetting::findOrFail($setting_id)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
            ]);
            $notification = array(
                'message' => 'Setting Update Without Image Success',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }
    }
}
