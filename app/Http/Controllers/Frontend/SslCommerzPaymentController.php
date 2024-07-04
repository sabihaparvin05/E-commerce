<?php

namespace App\Http\Controllers\Frontend;

use DB;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Http\Controllers\Controller;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }




    public function success(Request $request)
    {
        // dd($request->all());

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount'); 
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order = Order::where('transaction_id',$tran_id)->first();
        // dd($order);

        if ($order->status == 'pending') {
            
            $validation = $sslc->orderValidate($request->all(),$tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $order->update([
                'payment_status'=>'Paid'
                ]);
            
                session()->forget('cart');
               notify()->success('payment succesful');
               return redirect()->route('customer.profile');
            }
        

        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

   
   

}
