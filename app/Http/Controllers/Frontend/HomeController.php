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
    public function ProductViewAjax($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);
        $color = $product->product_color_en;
        $product_color = explode(',', $color);
        $size = $product->product_size_en;
        $product_size = explode(',', $size);
        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));

    }

    public function ProductDetail($id)
    {
        $product = Product::findOrFail($id);
        $multiImag = MultiImg::where('product_id', $id)->get();
        $product_color_en = explode(',', $product->product_color_en);
        $product_size_en = explode(',', $product->product_size_en);
        $relatedProduct = Product::where('category_id', $product->category_id)->where('id', '!=', $id)->get();
        $reviewcount = Review::where('product_id', $product->id)->where('status', 1)->latest()->get();
        $avarage = Review::where('product_id', $product->id)->where('status', 1)->avg('rating');
        $reviews = Review::where('product_id', $product->id)->latest()->limit(5)->get();


        return view('frontend.product.product_detail', compact('product', 'multiImag', 'product_color_en', 'product_size_en', 'relatedProduct', 'reviewcount', 'avarage', 'reviews'));
    }

    public function UserLogout()
    {
        Auth::logout();
        return Redirect()->route('login');
    }
    public function AllProduct(Request $request){
        $products = Product::where('status', 1)->paginate(6);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();


        ///  Load More Product with Ajax
        if ($request->ajax()) {
            $grid_view = view('frontend.product.grid_view_product', compact('products'))->render();

            $list_view = view('frontend.product.list_view_product', compact('products'))->render();
            return response()->json(['grid_view' => $grid_view, 'list_view', $list_view]);

        }
        ///  End Load More Product with Ajax

        return view('frontend.product.all_product', compact('products', 'categories'));
    }
    public function ListProduct(Request $request, $cat_id)
    {
        $products = Product::where('status', 1)->paginate(3);
        if ($cat_id != 0) {
            $products = Product::where('status', 1)->where('category_id', $cat_id)->orderBy('id', 'DESC')->paginate(3);
        }

        $cat = Category::findOrFail($cat_id);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();


        ///  Load More Product with Ajax
        if ($request->ajax()) {
            $grid_view = view('frontend.product.grid_view_product', compact('products'))->render();

            $list_view = view('frontend.product.list_view_product', compact('products'))->render();
            return response()->json(['grid_view' => $grid_view, 'list_view', $list_view]);

        }
        ///  End Load More Product with Ajax

        return view('frontend.product.list_product_byCategory', compact('products', 'categories', 'cat'));
    }

    public function SubCatWiseProduct(Request $request, $subcat_id)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $subcat_id)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        $breadsubcat = SubCategory::with(['category'])->where('id', $subcat_id)->get();


        ///  Load More Product with Ajax
        if ($request->ajax()) {
            $grid_view = view('frontend.product.grid_view_product', compact('products'))->render();

            $list_view = view('frontend.product.list_view_product', compact('products'))->render();
            return response()->json(['grid_view' => $grid_view, 'list_view', $list_view]);

        }
        ///  End Load More Product with Ajax

        return view('frontend.product.subcategory_view', compact('products', 'categories', 'breadsubcat'));

    }

    public function SubSubCatWiseProduct(Request $request,$subsubcat_id)
    {
        $products = Product::where('status', 1)->where('subsubcategory_id', $subsubcat_id)->orderBy('id', 'DESC')->paginate(6);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        $breadsubsubcat = SubSubCategory::with(['category', 'subcategory'])->where('id', $subsubcat_id)->get();
        ///  Load More Product with Ajax
        if ($request->ajax()) {
            $grid_view = view('frontend.product.grid_view_product', compact('products'))->render();

            $list_view = view('frontend.product.list_view_product', compact('products'))->render();
            return response()->json(['grid_view' => $grid_view, 'list_view', $list_view]);

        }
        ///  End Load More Product with Ajax

        return view('frontend.product.sub_subcategory_view', compact('products', 'categories', 'breadsubsubcat'));

    }

    public function ProductSearch(Request $request)
    {
        $request->validate(["search" => 'required']);
        $item = $request->search;

        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products = Product::where('product_name_en', 'LIKE', "%$item%")->get();
        return view('frontend.product.search', compact('products', 'categories'));
    }

    public function SearchProduct(Request $request)
    {
        $request->validate(["search" => "required"]);
        $item = $request->search;
        $products = Product::where('product_name_en', 'LIKE', "%$item%")->select('product_name_en', 'product_thumbnail', 'id', 'product_slug_en')->limit(5)->get();
        return view('frontend.product.search_product', compact('products'));
    }
    public function PriceFilter(Request $request){
        $max = $request->input('max', 1500);
        $price= explode(',',$max);
        $minPrice =(int) $price[0];
        $maxPrice =(int) $price[1];

        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products = Product::whereBetween('selling_price', [$minPrice,$maxPrice])-> orderBy('selling_price','ASC')-> paginate(6);
        return view('frontend.product.tags_view', compact('products', 'categories'));
    }
    public function filterProducts($option) {

        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products =  Product::all();
        if ($option === 'price_lowest') {
            $products = $products->orderBy('selling_price', 'asc')->paginate(6);
        }
        if ($option === 'price_highest') {
            $products = Product::orderBy('selling_price', 'desc')->paginate(6);
        }
        if ($option === 'name_a_to_z') {
            $products = $products->orderBy('product_name_en', 'asc')->paginate(6);
        }

        return view('frontend.product.tags_view', compact('products', 'categories'));
    }

    public function TagWiseProduct($tag){
        $products = Product::where('status',1)->where('product_tags_en',$tag)->orderBy('id','DESC')->paginate(6);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('frontend.product.tags_view',compact('products','categories'));

    }
    public function SizeWiseProduct(Request $request,$size){
        $sortBy = $request->input('sort_by');
        $categories = Category::orderBy('category_name_en','ASC')->get();
        if ($sortBy == 'price_lowest') {
            $products = Product::where('status',1)->where('product_size_en','LIKE',"%$size%")->orderBy('selling_price', 'asc')->paginate(6);
        } else if($sortBy == 'price_highest') {
            $products = Product::where('status',1)->where('product_size_en','LIKE',"%$size%")->orderBy('selling_price', 'desc')->paginate(6);
        } else if ($sortBy == 'name_a_to_z') {
            $products = Product::where('status',1)->where('product_size_en','LIKE',"%$size%")->orderBy('product_name_en', 'asc')->paginate(6);
        } else {
            $products = Product::where('status',1)->where('product_size_en','LIKE',"%$size%")->orderBy('id','DESC')->paginate(6);
        }
        return view('frontend.product.tags_view',compact('products','categories'));

    }
    public function ColorWiseProduct($color){
        $products = Product::where('status',1)->where('product_color_en','LIKE',"%$color%")->orderBy('id','DESC')->paginate(6);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('frontend.product.tags_view',compact('products','categories'));

    }
}
