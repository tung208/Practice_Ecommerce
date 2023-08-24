<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function CheckoutStore(Request $request){
        $data= array();
        $data['shipping_name'] = $request-> shipping_name;
        $data['shipping_email'] = $request-> shipping_email;
        $data['shipping_phone'] = $request-> shipping_phone;
        $data['post_code'] = $request-> post_code;
        $data['division_id'] = $request-> division_id;
        $data['district_id'] = $request-> district_id;
        $data['state_id'] = $request-> state_id;
        $data['notes'] = $request-> notes;
        $cartTotal= Cart::subtotal();


        if($request-> payment_method == 'stripe'){
            return view('frontend.payment.stripe',compact('data','cartTotal'));
        }elseif ($request-> payment_method == 'card'){
            return response()-> json('card','Chua lam phan card nay');
        }else{
            return view('frontend.payment.cash',compact('data','cartTotal'));
        }


    }
}
