<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function ProductViewAjax($id){
        $product = Product::with('category','brand') -> findOrFail($id);
        $color = $product-> product_color_en;
        $product_color = explode(',',$color);
        $size = $product-> product_size_en;
        $product_size = explode(',',$size);
        return response()-> json(array(
           'product' => $product,
           'color' => $product_color,
           'size' =>  $product_size,
        ));

    }
}
