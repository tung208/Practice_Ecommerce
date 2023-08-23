<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Whishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function AddToWishlist(Request $request, $product_id){
        $product = Product::findOrFail($product_id);
        if(Auth::check()){
            $exist = Whishlist::where('user_id',Auth::id())-> where('product_id',$product_id)-> first();

            if(!$exist){
                Whishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),

                ]);

                return response() -> json(['success'=>'Successfully Added On Your Wishlist']);

            }else{
                return response() -> json(['error'=>'This Product has Already on Your Wishlist']);
            }
        }else{
            return response()->json(['error' => 'At First You Must Login Your Account']);
        }
    }
    public function GetWishList(){
        $wishlist = Whishlist::with('product') -> where('user_id',Auth::id())->  get();
        return view('frontend.wishlist.view_wishlist',compact('wishlist'));
    }
    public function RemoveWishlist($product_id){
        Whishlist::findOrFail($product_id) -> delete();
        $notification = array(
            'message' => 'Remove Product From Wishlist Successfully',
            'alert-type' => 'success'
        );
        return redirect()-> back()-> with($notification);
    }
    public function AddToCart(Request $request,$id){
        $product = Product::findOrFail($id);
        if($product -> discount_price == null){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,

                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'image' => $product->product_thumbnail,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }
    }
    public function AddMiniCart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();
        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,

        ));
    }
    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Removed from Cart']);
    }
public function CheckoutCreate(){

}
}
