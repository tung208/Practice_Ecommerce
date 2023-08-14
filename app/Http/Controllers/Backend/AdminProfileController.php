<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    //
    public function changePassword(){
        return view('backend.admin_changePassword');
    }
    public function updatePassword(Request $request){
        $validateData= $request-> validate([
            'old_password' => 'required',
            'password'=> 'required|confirmed'
        ]);
        $hashedPassword= Auth::user() -> password;
        if(Hash::check($request-> old_password,$hashedPassword)){
            $admin= Admin::find(Auth::id());
            $admin-> password= Hash::make($request-> password);
            $admin-> save();
            $notification = array(
                'message' => 'Password Updated Successfully',
                'alert-type' => 'success'
            );
            Auth::logout();
            return redirect()-> route('admin.login')-> with($notification);
        }else{
            $notification = array(
                'message' => 'Password Updated Fail',
                'alert-type' => 'fail'
            );
            return redirect()-> back()->with($notification);
        }
    }
}
