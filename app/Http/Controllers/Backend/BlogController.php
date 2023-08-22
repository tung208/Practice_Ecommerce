<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogPostCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

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
        return view('backend.blog.post.add_post',compact('blogpost','blogcategory'));

    }
    public function BlogPostStore(Request $request){
        $request -> validate([
            'post_title_en' => 'required',
            'post_image' => 'required'
        ],[
            'post_title_en.required' => 'Please input post title',
            'post_image.required' => 'Please input post image',
        ]);

        $image = $request-> file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image-> getClientOriginalExtension();
        $save_url = 'upload/blog/'.$name_gen;
        Image::make($image) ->resize(780,433) -> save($save_url);

        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title_en' => $request->post_title_en,
            'post_slug_en' => strtolower(str_replace(' ', '-',$request->post_title_en)),
            'post_image' => $save_url,
            'post_details_en' => $request->post_details_en,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Add Blog Successfully',
            'alert-type' => 'success'
        );
        return redirect()-> route('list.blog') -> with($notification);
    }

    public function DeleteBlogPost($id){
     $blog=  BlogPost::findOrFail($id);
     unlink($blog-> post_image);
     $blog-> delete();
        $notification = array(
            'message' => 'Delete Blog Successfully',
            'alert-type' => 'success'
        );
        return redirect()-> route('list.blog') -> with($notification);

    }
    public function EditBlogPost($id){
        $blog= BlogPost::findOrFail($id);
        $blog_cate = BlogPostCategories::latest()-> get();
        return view('backend.blog.post.edit_blog',compact('blog','blog_cate'));
    }
    public function BlogPostUpdate(Request $request){
        $blog_id = $request -> id;
        if($request -> file('post_image')) {
            $blog =  BlogPost::findOrFail($blog_id);
            unlink($blog -> post_image);
            $image = $request-> file('post_image');
            $name_gen = hexdec(uniqid()).'.'.$image-> getClientOriginalExtension();
            $save_url = 'upload/blog/'.$name_gen;
            Image::make($image) ->resize(780,433) -> save($save_url);

            BlogPost::findOrFail($blog_id)->update([
                'category_id' => $request->category_id,
                'post_title_en' => $request->post_title_en,
                'post_slug_en' => strtolower(str_replace(' ', '-', $request->post_title_en)),
                'post_image' => $save_url,
                'post_details_en' => $request->post_details_en,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Update Blog Successfully',
                'alert-type' => 'success'
            );
            return redirect()-> back() -> with($notification);
        } else {
            BlogPost::findOrFail($blog_id)->update([
                'category_id' => $request->category_id,
                'post_title_en' => $request->post_title_en,
                'post_slug_en' => strtolower(str_replace(' ', '-', $request->post_title_en)),
                'post_details_en' => $request->post_details_en,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Update Blog Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()-> back() -> with($notification);
        }
    }
}
