<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartPageController extends Controller
{
    //
    public function MyCart(){
        $carts =Cart::content();
        return view('frontend.wishlist.view_cart',compact('carts'));
    }
    public function GetCartProduct(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,

        ));
    }
    public function RemoveCartProduct($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Removed from Cart']);
    }
    public function CartIncrement($rowId){
        $cart = Cart::get($rowId);
        Cart::update($rowId,$cart->qty+1);
        return response()->json('increment');
    }
    public function CartDecrement($rowId){
        $cart = Cart::get($rowId);
        Cart::update($rowId,$cart->qty-1);
        return response()->json('decrement');
    }
}
