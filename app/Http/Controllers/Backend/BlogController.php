<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogPostCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    //
    public function BlogCategory()
    {
        $blogcategory = BlogPostCategories::latest()->get();
        return view('backend.blog.blog_category.view_blog_category', compact('blogcategory'));
    }

    public function BlogCategoryStore(Request $request)
    {
        $request->validate([
            'blog_category_name_en' => 'required',

        ], [
            'blog_category_name_en.required' => 'Input Blog Category English Name',
        ]);
        BlogPostCategories::insert([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_slug_en' => strtolower(str_replace(' ', '-', $request->blog_category_name_en)),
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function BlogCategoryEdit($id)
    {
        $blogcategory = BlogPostCategories::findOrFail($id);
        return view('backend.blog.blog_category.edit_blog_category', compact('blogcategory'));
    }

    public function BlogCategoryUpdate(Request $request)
    {
        $blog_cat_id = $request->id;
        BlogPostCategories::findOrFail($blog_cat_id)->update([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_slug_en' => strtolower(str_replace(' ', '-', $request->blog_category_name_en)),
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Blog Category Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('view.blog.category')->with($notification);
    }

    public function BlogCategoryDelete($id)
    {
        BlogPostCategories::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Category Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('view.blog.category')->with($notification);
    }

    public function ListBlogPost()
    {
        $blogpost = BlogPost::with('category')->latest()->get();
        return view('backend.blog.post.list_post',compact('blogpost'));
    }
    public function AddBlogPost(){

        $blogcategory = BlogPostCategories::latest()->get();
        $blogpost = BlogPost::latest()->get();
        return view('backend.blog.post.view_post',compact('blogpost','blogcategory'));

    }

}
