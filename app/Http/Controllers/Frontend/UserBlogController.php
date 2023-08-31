<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogPostCategories;
use Illuminate\Http\Request;

class UserBlogController extends Controller
{
    //
    public function AddBlogPost(){

        $blogcategory = BlogPostCategories::latest()->get();
        $blogpost = BlogPost::latest()->get();
        return view('frontend.blog.blog_list',compact('blogpost','blogcategory'));

    } // end method


    public function DetailsBlogPost($id){

        $blogcategory = BlogPostCategories::latest()->get();
        $blogpost = BlogPost::findOrFail($id);
        return view('frontend.blog.blog_details',compact('blogpost','blogcategory'));
    }



    public function HomeBlogCatPost($category_id){

        $blogcategory = BlogPostCategories::latest()->get();
        $blogpost = BlogPost::where('category_id',$category_id)->orderBy('id','DESC')->get();
        return view('frontend.blog.blog_cat_list',compact('blogpost','blogcategory'));

    } // end mehtod
}
