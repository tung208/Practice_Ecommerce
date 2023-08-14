<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function viewProduct(){
        $products = Product::latest()-> get();
        return view('backend.product.view_product',compact('products'));
    }
    public function addProduct(){
        return view('backend.product.add_product');
    }
    public function storeProduct(Request $request){

    }
    public function editProduct($id){

    }
    public function updateProduct(Request $request){

    }
    public function deleteProduct($id){

    }
}
