<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    //
    public function MyOrders(){
        $orders = Order::where('user_id',Auth::id())-> orderBy('id','DESC')-> get();
        return view('frontend.order.order_list',compact('orders'));
    }
    public function OrderDetails($order_id){
        $order = Order::with('division','district','state','user')-> where('id',$order_id) -> where('user_id',Auth::id())-> first();
        $orderItem= OrderItem::with('product')-> where('order_id',$order_id)-> orderBy('id','DESC') -> get();

        return view('frontend.order.order_detail',compact('order','orderItem'));
    }
}
