<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartPageController extends Controller
{
    //
    public function MyCart(){
        return view('frontend.wishlist.view_cart');
    }
}
