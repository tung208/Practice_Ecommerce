<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Policies\CategoryPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
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

            $category = Category::findOrFail($cate_id);
            unlink($category-> category_icon);
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
                    'updated_at' => Carbon::now(),
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
        $cate = Category::findOrFail($id);
        $response = Gate::inspect('delete', $cate);
        if ($response->allowed()) {
            SubSubCategory::where('category_id', $id)->delete();
            SubCategory::where('category_id', $id)->delete();
            unlink($cate-> category_icon);
            Category::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Category Delete Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Category Delete Fail',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }


    }

    public function viewSubCategory()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subCategory = SubCategory::latest()->get();
        return view('backend.category.view_subcategory', compact('categories', 'subCategory'));
    }

    public function storeSubcategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
        ], [
            'category_id.required' => 'Please select Any option',
            'subcategory_name_en.required' => 'Input SubCategory Name',
        ]);
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function editSubcategory($id)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $sub_category = SubCategory::findOrFail($id);
        return view('backend.category.edit_subcategory', compact('sub_category', 'categories'));

    }

    public function updateSubcategory(Request $request)
    {
        $sub_cate_id = $request->id;
        SubCategory::findOrFail($sub_cate_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'updated_at' => Carbon::now(),
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),

        ]);
        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('admin.viewSubCategory')->with($notification);
    }

    public function deleteSubcategory($id)
    {

        $subcategory = SubCategory::findOrFail($id);
        $sub_sub = SubSubCategory::where('subcategory_id', $id)->delete();
        $subcategory->delete();
        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function viewSubSubCategory()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subsubcategory = SubSubCategory::latest()->get();
        return view('backend.category.view_subsubcategory', compact('subsubcategory', 'categories'));

    }

    public function getSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcat);
    }

    public function getSubSubCategory($subcategory_id)
    {
        $sub_subcat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($sub_subcat);
    }

    public function storeSubSubcategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
        ], [
            'category_id.required' => 'Please select any option',
            'subcategory_id.required' => 'Please select any option',
            'subsubcategory_name_en' => 'Please input sub sub category name',
        ]);
        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_slug_en)),
            'created_at' => Carbon::now(),
        ]);
        $noti = array(
            'message' => 'Add sub sub category success',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($noti);
    }

    public function editSubSubcategory($id)
    {
        $subsubcat = SubSubCategory::findOrFail($id);
        $category = Category::findOrFail($subsubcat->category_id);
        $subcategories = SubCategory::where('category_id', $subsubcat->category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return view('backend.category.edit_subsubcategory', compact('category', 'subcategories', 'subsubcat'));


    }

    public function updateSubSubcategory(Request $request)
    {
        $sub_sub_cat_id = $request->id;
        SubSubCategory::findOrFail($sub_sub_cat_id)
            ->update([
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_name_en' => $request->subsubcategory_name_en,
                'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
                'updated_at' => Carbon::now(),
            ]);
        $notification = array(
            'message' => 'Sub-SubCategory Update Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all.subsubcategory')->with($notification);
    }

    public function deleteSubSubcategory($id)
    {
        SubSubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Sub-SubCategory Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
