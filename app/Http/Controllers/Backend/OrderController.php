<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function PendingOrders(){
       $orders= Order::where('status','pending')-> orderBy('id','DESC')-> get();
        return view('backend.order.pending_order',compact('orders'));
    }
    public function PendingOrdersDetails($order_id){
        $order= Order::with('division','district','state','user')-> where('id',$order_id)->first();
        $orderItem = OrderItem::with('product')-> where('order_id',$order_id)-> orderBy('id','DESC')-> get();
        return view('backend.order.pending_order_detail',compact('order','orderItem'));
    }
    public function ConfirmedOrders(){
        $orders= Order::where('status','confirmed')-> orderBy('id','DESC')-> get();
        return view('backend.order.confirmed_orders',compact('orders'));
    }
    public function ProcessingOrders(){
        $orders= Order::where('status','processing')-> orderBy('id','DESC')-> get();
        return view('backend.order.processing_orders',compact('orders'));
    }
    public function PickedOrders(){
        $orders= Order::where('status','picked')-> orderBy('id','DESC')-> get();
        return view('backend.order.picked_orders',compact('orders'));
    }
    public function ShippedOrders(){
        $orders = Order::where('status','shipped')->orderBy('id','DESC')->get();
        return view('backend.order.shipped_orders',compact('orders'));

    }
    public function DeliveredOrders(){
        $orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
        return view('backend.order.delivered_orders',compact('orders'));

    }
    public function CancelOrders(){
        $orders = Order::where('status','cancel')->orderBy('id','DESC')->get();
        return view('backend.order.cancel_orders',compact('orders'));

    }
    public function PendingToConfirm($id){
        Order::findOrFail($id)-> update([
            'status'=>'confirmed',
            'updated_at' => Carbon::now(),
        ]);
        $noti = array(
            'message' => 'Order Confirm Success',
            'alert-type' => 'success'
        );
        return redirect() -> route('pending-orders')-> with($noti);
    }
    public function ConfirmToProcessing($id){
        Order::findOrFail($id)-> update([
            'status'=>'processing',
            'updated_at' => Carbon::now(),
        ]);
        $noti = array(
            'message' => 'Order Processing Success',
            'alert-type' => 'success'
        );
        return redirect() -> route('confirmed-orders')-> with($noti);
    }
    public function ProcessingToPicked($id){
        Order::findOrFail($id)-> update([
            'status'=>'picked',
            'updated_at' => Carbon::now(),
        ]);
        $noti = array(
            'message' => 'Order Picked Success',
            'alert-type' => 'success'
        );
        return redirect() -> route('processing-orders')-> with($noti);
    }
    public function PickedToShipped($id){
        Order::findOrFail($id)-> update([
            'status'=>'shipped',
            'updated_at' => Carbon::now(),
        ]);
        $noti = array(
            'message' => 'Order Shipped Success',
            'alert-type' => 'success'
        );
        return redirect() -> route('picked-orders')-> with($noti);
    }
    public function ShippedToDelivered($id){
        $orderItem = OrderItem::where('order_id',$id)-> get();
        foreach ($orderItem as $item){
            $product_update =Product::findOrFail($item-> product_id);
            $quantity_update = $product_update-> product_qty - $item-> qty;
                $product_update-> update([
                'product_qty' =>$quantity_update
            ]);
        }
        Order::findOrFail($id)-> update(['status'=>'delivered']);
        $noti = array(
            'message' => 'Order Delivered Success',
            'alert-type' => 'success'
        );
        return redirect() -> route('shipped-orders')-> with($noti);
    }
    public function AdminInvoiceDownload($id){
        $order = Order::with('division','district','state','user')->where('id',$id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$id)->orderBy('id','DESC')->get();

        $pdf = PDF::loadView('backend.order.order_invoice',compact('orderItem','order'))-> setPaper('a4')-> setOption([
            'temDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf-> download('invoice.pdf');
    }
}
