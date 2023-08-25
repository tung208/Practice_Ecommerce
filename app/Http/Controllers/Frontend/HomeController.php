<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Review;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function UserLogout(){
        Auth::logout();
        return Redirect()->route('login');
    }

    public function ListProduct($cat_id){
        if($cat_id==0){
            $products = Product::latest()-> where('status',1)->orderBy('id','DESC')->get();
            return view('frontend.product.list_product_byCategory',compact('products'));
        }else {
            $products = Product::latest()->where('status', 1)->where('category_id', $cat_id)->orderBy('id', 'DESC')->get();
            return view('frontend.product.list_product_byCategory', compact('products'));
        }
    }
    public function SubCatWiseProduct(Request $request, $subcat_id){
        $products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en','ASC')->get();

        $breadsubcat = SubCategory::with(['category'])->where('id',$subcat_id)->get();


        ///  Load More Product with Ajax
        if ($request->ajax()) {
            $grid_view = view('frontend.product.grid_view_product',compact('products'))->render();

            $list_view = view('frontend.product.list_view_product',compact('products'))->render();
            return response()->json(['grid_view' => $grid_view,'list_view',$list_view]);

        }
        ///  End Load More Product with Ajax

        return view('frontend.product.subcategory_view',compact('products','categories','breadsubcat'));

    }
    public function SubSubCatWiseProduct($subsubcat_id){
        $products = Product::where('status',1)->where('subsubcategory_id',$subsubcat_id)->orderBy('id','DESC')->paginate(6);
        $categories = Category::orderBy('category_name_en','ASC')->get();

        $breadsubsubcat = SubSubCategory::with(['category','subcategory'])->where('id',$subsubcat_id)->get();

        return view('frontend.product.sub_subcategory_view',compact('products','categories','breadsubsubcat'));

    }
}
