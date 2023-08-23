<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Review;
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
    public function ProductDetail($id){
        $product = Product::findOrFail($id);
        $multiImag = MultiImg::where('product_id',$id)-> get();
        $product_color_en = explode(',',$product-> product_color_en);
        $product_size_en= explode(',',$product-> product_size_en);
        $relatedProduct = Product::where('category_id',$product-> category_id)-> where('id','!=',$id)-> get();
        $reviewcount = Review::where('product_id',$product->id)->where('status',1)->latest()->get();
        $avarage = Review::where('product_id',$product->id)->where('status',1)->avg('rating');
        $reviews = Review::where('product_id',$product->id)->latest()->limit(5)->get();


        return view('frontend.product.product_detail',compact('product','multiImag','product_color_en','product_size_en','relatedProduct','reviewcount','avarage','reviews'));
    }
}
