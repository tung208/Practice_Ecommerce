<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    //
    public function viewProduct(){
        $products = Product::latest()-> get();
        return view('backend.product.view_product',compact('products'));
    }
    public function addProduct(){
        $brands = Brand::latest() -> get();
        $categories = Category::latest() -> get();
        return view('backend.product.add_product',compact('brands','categories'));
    }
    public function storeProduct(Request $request){
        $request -> validate([
            'file' => 'required|mines: jpeg,png,jpg,zip,pdf| max : 2048',
        ]);
        if($file = $request -> file('file')){
            $destination = 'upload/pdf';
            $digitalItem = date('YmdHis').'.'.$file-> getClientOriginalExtension();
            $file -> move($destination,$digitalItem);
        }
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;
        $product_id= Product::insertGetId([
            'brand_id' => $request-> brand_id,
            'category_id' => $request -> category_id,
            'subcategory_id' => $request -> subcategory_id,
            'subsubcategory_id' => $request -> subsubcategory_id,
            'product_name_en' => $request -> product_name_en,
            'product_slug_en' => strtolower(str_replace(' ','-', $request-> product_name_en)),
            'product_code' => $request -> product_code,
            'product_qty' => $request -> product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_size_en' => $request->product_size_en,
            'product_color_en' => $request->product_color_en,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'long_descp_en' => $request->long_descp_en,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'product_thumbnail' => $save_url,
            'digital_file' => $digitalItem,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $multi_image = $request-> file('multi_img');
        foreach ($multi_image as $img){
            $make_name= hexdec(uniqid()).'.'.$img-> getClientOriginalExtension();
            Image: make($img) -> resize(152,165) -> save('upload/products/multi_image/'.$make_name);
            $uploadPath= 'upload/products/multi_image/'.$make_name;
            MultiImg::insert([

                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),

            ]);
        }
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.viewProduct')->with($notification);



    }
    public function editProduct($id){

    }
    public function updateProduct(Request $request){

    }
    public function deleteProduct($id){

    }
}
