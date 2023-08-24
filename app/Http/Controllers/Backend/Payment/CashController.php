<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CashController extends Controller
{
    //
    public function CashOrder(Request $request){
        $total= Cart::subtotal();
        $n =str_replace(',','',$total);
        $total_amount = floatval($n);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request -> division_id,
            'district_id' => $request -> district_id,
            'state_id' => $request -> state_id,
            'name' => $request -> name,
            'email' => $request -> email,
            'phone' => $request -> phone,
            'post_code' => $request -> post_code,
            'notes' => $request-> notes,
            'payment_method' => 'Cash',
            'payment_type' => 'Cash',
            'currency' => 'usd',
            'amount' => $total_amount,
            'order_number' => hexdec(uniqid()),
            'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now() -> format('d F Y'),
            'order_month' => Carbon::now() -> format('F'),
            'order_year' => Carbon::now() -> format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),

        ]);

        $order = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $order -> invoice_no,
            'amount' => $total_amount,
            'name' => $order-> name,
            'email' => $order-> email,
        ];
        Mail::to($request-> email) -> send(new SendMail($data));

        $carts = Cart::content();
        foreach ($carts as $cart){
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart-> id,
                'color' => $cart -> options -> color,
                'size' => $cart -> options -> size,
                'qty' => $cart-> qty ,
                'price' => $cart-> price,
                'created_at' => Carbon::now(),

            ]);
        }
        Cart::destroy();
        $notification = array(
            'message' => 'Order Successfully',
            'alert-type' => 'success'
        );
        return redirect() -> route('user.dashboard')-> with($notification);
    }

}
