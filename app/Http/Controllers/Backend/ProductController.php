<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class ProductController extends Controller
{
    //
    public function viewProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.view_product', compact('products'));
    }

    public function addProduct()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.product.add_product', compact('brands', 'categories'));
    }

    public function storeProduct(Request $request)
    {

        /*  $request->validate([
              'file' => 'required|mimes:jpeg,png,jpg,zip,pdf|max:2048',
          ]);

          if ($files = $request->file('file')) {
              $destinationPath = 'upload/pdf'; // upload path
              $digitalItem = date('YmdHis') . "." . $files->getClientOriginalExtension();
              $files->move($destinationPath,$digitalItem);
          }*/


        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_code' => $request->product_code,

            'product_qty' => $request->product_qty,
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

            'status' => 1,
            'created_at' => Carbon::now(),

        ]);


        ////////// Multiple Image Upload Start ///////////

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi_image/' . $make_name);
            $uploadPath = 'upload/products/multi_image/' . $make_name;

            MultiImg::insert([

                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),

            ]);

        }

        ////////// Een Multiple Image Upload Start ///////////


        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.viewProduct')->with($notification);


    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::latest()->get();
        $sub_category = SubCategory::latest()->get();
        $sub_sub_category = SubSubCategory::latest()->get();
        $brands = Brand::latest()->get();
        $multi_img = MultiImg::where('product_id', $id)->get();

        return view('backend.product.edit_product', compact('product', 'categories', 'sub_category', 'sub_sub_category', 'brands', 'multi_img'));

    }

    public function updateProduct(Request $request)
    {
        $product_id = $request->id;
        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),

            'product_code' => $request->product_code,

            'product_qty' => $request->product_qty,
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
            'status' => 1,


        ]);

        $notification = array(
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.viewProduct')->with($notification);


    } // end method

    public function updateProductImage(Request $request)
    {
        $product_id = $request->product_id;
        $multi_image = $request->multi_img;
        foreach ($multi_image as $img) {
            $multi_id=$img-> id;
            $unlink_img = MultiImg::findOrFail($multi_id);
            unlink($unlink_img->photo_name);
            $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image:: make($img)->resize(917, 1000)->save('upload/products/multi_image/' . $name_gen);
            $save_url = 'upload/products/multi_image/' . $name_gen;
            $multi = MultiImg::where('product_id', $product_id)->get();
            $multi->where('id', $img->id)->update([
                'photo_name' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'Product Image Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function updateProductThumbnail(Request $request)
    {
        $product_id = $request->id;
        $old_image = $request->old_img;
        unlink($old_image);
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = 'upload/products/thumbnail/' . $name_gen;
        Image::make($image)->resize(917, 1000)->save($save_url);
        Product::findOrFail($product_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);
        $noti = array(
            'message' => 'Product Image Thumbnail Update Success',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($noti);

    }

    public function MultiImageDelete()
    {

    }

    public function deleteProduct($id)
    {

    }

    public function ProductInactive($id)
    {

    }

    public function ProductActive($id)
    {

    }
}
