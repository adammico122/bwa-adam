<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\{ Cart, Transaction, TransactionDetail };

use Exception;

use Midtrans\{ Config, Snap };

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Save Data Users
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // Proses Checkout
        $code = 'STORE-'. mt_rand(000000,999999);
        $carts = Cart::with(['product','user'])
                        ->Where('users_id', Auth::user()->id)
                        ->get();

        // Transaction Create
        $transaction = Transaction::create([
            'users_id'              =>  Auth::user()->id,
            'insurance_price'       =>  0,
            'shipping_price'        =>  0,  
            'total_price'           =>  $request->total_price, 
            'transaction_status'    =>  'PENDING',  
            'code'                  =>  $code  
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-'. mt_rand(000000,999999);

            TransactionDetail::create([
            'transactions_id'   =>  $transaction->id,
            'products_id'       =>  $cart->product->id,
            'price'             =>  $cart->product->price,  
            'shipping_status'   =>  'PENDING', 
            'resi'              =>  '',  
            'code'              =>  $trx  
            ]);
        }

        // Delete Cart Data
        Cart::with(['product','user'])->Where('users_id', Auth::user()->id)->delete();

        // Configuration Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat Array Untuk Dikirim Ke Midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id'  => $code,
                'gross_amount' => (int) $request->total_price,
            ],
            'customer_details'  => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enabled_payments'  => [
                "bank_transfer","credit_card", "cimb_clicks",
                "bca_klikbca", "bca_klikpay", "bri_epay", "echannel", "permata_va",
                "bca_va", "bni_va", "bri_va", "other_va", "gopay", "indomaret",
                "danamon_online", "akulaku", "shopeepay"
            ],
            'vtweb' => []
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            
            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function callback(Request $request)
    {

    }
}