<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

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
    public function InvoiceDownload($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        // return view('frontend.user.order.order_invoice',compact('order','orderItem'));
        $pdf = PDF::loadView('frontend.order.order_invoice',compact('order','orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');



    }
    public function ReturnOrderList(){

        $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->orderBy('id','DESC')->get();
        return view('frontend.order.return_order',compact('orders'));

    }
    public function ReturnOrder(Request $request,$order_id){
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_status' => 1,
        ]);


        $notification = array(
            'message' => 'Return Request Send Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('my.orders')->with($notification);
    }
    public function CancelOrder(Request $request,$order_id){
        Order::findOrFail($order_id)->update([
            'cancel_date' => Carbon::now()->format('d F Y'),
            'cancel_reason' => $request->cancel_reason,
            'cancel_status' => 1,
        ]);


        $notification = array(
            'message' => 'Cancel Request Send Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('my.orders')->with($notification);
    }
    public function CancelOrdersList(){

        $orders = Order::where('user_id',Auth::id())->where('cancel_reason','!=',NULL)->orderBy('id','DESC')->get();
        return view('frontend.order.cancel_order',compact('orders'));

    }
}
