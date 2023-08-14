<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class CategoryController extends Controller
{
    //
    public function viewCategory()
    {
        $category = Category::latest()->get();
        return view('backend.category.view_category', compact('category'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name_en' => 'required',
            'category_icon' => 'required',
        ], [
            'category_name_en.required' => 'Please Input Category Name',
            'category_icon.required' => 'Please Input Category Icon',
        ]);
        $image = $request->file('category_icon');
        $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalName();
        Image::make($image)->resize(183, 199)->save('upload/category/' . $name_gen);
        $save_url = 'upload/category/' . $name_gen;
        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_icon' => $save_url,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.edit_category', compact('category'));
    }

    public function updateCategory(Request $request)
    {
        $cate_id = $request->id;
        $request->validate([
            'category_name_en' => 'required',

        ], [
            'category_name_en.required' => 'Please Input Category Name',

        ]);
        if ($request->file('category_icon')) {
            $image = $request->file('category_icon');
            $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalName();
            Image::make($image)->resize(183, 199)->save('upload/category/' . $name_gen);
            $save_url = 'upload/category/' . $name_gen;
            Category::findOrFail($cate_id)
                ->update([
                    'category_name_en' => $request->category_name_en,
                    'category_icon' => $save_url,
                    'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                    'updated_at' => Carbon::now(),
                ]);
            $notification = array(
                'message' => 'Category Update Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            Category::findOrFail($cate_id)
                ->update([
                    'category_name_en' => $request->category_name_en,
                    'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                ]);
            $notification = array(
                'message' => 'Category Update Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function viewSubCategory()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subCategory = SubCategory::latest()->get();
        return view('backend.category.view_subcategory', compact('categories', 'subCategory'));
    }
    public function storeSubcategory(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
        ],[
            'category_id.required' => 'Please select Any option',
            'subcategory_name_en.required' => 'Input SubCategory Name',
        ]);
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
        ]);
        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function editSubcategory($id)
    {
        $categories = Category::orderBy('category_name_en','ASC') -> get();
        $sub_category = SubCategory::findOrFail($id);
        return view('backend.category.edit_subcategory', compact('sub_category','categories'));

    }

    public function updateSubcategory(Request $request)
    {
        $sub_cate_id = $request-> id;
        SubCategory::findOrFail($sub_cate_id) -> update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,

            'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),

        ]);
        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('admin.viewSubCategory')->with($notification);
    }

    public function viewSubSubCategory()
    {

    }
}
