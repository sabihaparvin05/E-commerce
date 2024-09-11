<?php

namespace App\Http\Controllers\Frontend;

use Throwable;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;

class OrderController extends Controller
{
    public function checkout()
    {
        return view('frontend.pages.order.checkout');
    }


    public function placeOrder(Request $request)
{
   
        $cartData = session()->get('cart');
        
        //insert data into order table
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'receiver_name' => $request->receiver_name,
            'receiver_mobile' => $request->receiver_phone,
            'receiver_address' => $request->receiver_address,
            'order_note' => $request->order_note,
            'status' => 'pending',
            'total_price' => array_sum(array_column($cartData, 'subtotal')),
            'transaction_id' => date('YmdHis'),
            'payment_method' => $request->paymentMethod,
            'payment_status' => 'pending',
        ]);

        //insert cart data into order details table
        foreach ($cartData as $data) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $data['id'],
                'unit_price' => $data['price'],
                'quantity' => $data['quantity'],
                'subtotal' => $data['subtotal'],
            ]);
          
        }

        session()->forget('cart');

        if ($request->paymentMethod == 'ssl') {
            $this->payNow($order);
        }
        notify()->success('Order placed successfully.');
        return redirect()->route('customer.profile');
    } 

        public function payNow($order)
        {
            //    dd($order);
            $post_data = array();
            $post_data['total_amount'] = (int)$order->total_price; # You cant not pay less than 10
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = $order->transaction_id; // tran_id must be unique
    
            # CUSTOMER INFORMATION
            $post_data['cus_name'] = $order->name;
            $post_data['cus_email'] = $order->email;
            $post_data['cus_add1'] = $order->address;;
            $post_data['cus_add2'] = "";
            $post_data['cus_city'] = "";
            $post_data['cus_state'] = "";
            $post_data['cus_postcode'] = "";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = '8801XXXXXXXXX';
            $post_data['cus_fax'] = "";
    
            # SHIPMENT INFORMATION
            $post_data['ship_name'] = "Store Test";
            $post_data['ship_add1'] = "Dhaka";
            $post_data['ship_add2'] = "Dhaka";
            $post_data['ship_city'] = "Dhaka";
            $post_data['ship_state'] = "Dhaka";
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_phone'] = "";
            $post_data['ship_country'] = "Bangladesh";
    
            $post_data['shipping_method'] = "NO";
            $post_data['product_name'] = "Computer";
            $post_data['product_category'] = "Goods";
            $post_data['product_profile'] = "physical-goods";
    
            # OPTIONAL PARAMETERS
            $post_data['value_a'] = "ref001";
            $post_data['value_b'] = "ref002";
            $post_data['value_c'] = "ref003";
            $post_data['value_d'] = "ref004";
    
    
    
            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');
    
            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }
        }

        public function viewOrder($oID)
        {
            $orderview = OrderDetail::with('product')->where('order_id', $oID)->get();
            $order=Order::all();
            return view('frontend.pages.order.view',compact('order', 'orderview'));
        }
    }
    
   