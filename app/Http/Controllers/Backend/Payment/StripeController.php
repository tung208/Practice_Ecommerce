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

class StripeController extends Controller
{
    //
    public function StripeOrder(Request $request)
    {

        $total= Cart::subtotal();
        $n =str_replace(',','',$total);
        $total_amount = floatval($n);
        \Stripe\Stripe::setApiKey('sk_test_51NarctAVAm7MGJxYOu6iwPQ6u5Dqq1mNSkxnmRDim5Ut5BLrdT62LBOIFqMwDuLcrM3uBw8kyjrkSg0Lj8eqWgTo005lT85Rxv');

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $total_amount*100,
            'currency' => 'usd',
            'description' => 'Online Shopping',
            'source' => $token,
            'metadata' => ['order_id' => hexdec(uniqid())],
        ]);
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
            'payment_method' => 'Stripe',
            'payment_type' => $charge-> payment_method,
            'transaction_id' => $charge -> balance_transaction,
            'currency' => $charge -> currency,
            'amount' => $total_amount,
            'order_number' => $charge-> metadata ->order_id,
            'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now() -> format('d F Y'),
            'order_month' => Carbon::now() -> format('F'),
            'order_year' => Carbon::now() -> format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),

        ]);



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
        $order = Order::findOrFail($order_id);
        $orderItem= OrderItem::with('product')-> where('order_id',$order_id)-> orderBy('id','DESC') -> get();
        $data = [
            'invoice_no' => $order -> invoice_no,
            'amount' => $total_amount,
            'name' => $order-> name,
            'email' => $order-> email,
            'order_item' =>$orderItem,
        ];
        Mail::to($request-> email) -> send(new SendMail($data));
Cart::destroy();
        $notification = array(
            'message' => 'Order Successfully',
            'alert-type' => 'success'
        );
        return redirect() -> route('user.dashboard')-> with($notification);
    }
}
