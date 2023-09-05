<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;
use Paystack;

class PaymentController extends Controller
{
    //
    public function initPaystack($details)
    {
        // return $details;

        $data['amount'] = $details['amount'] *100;
        $data['reference'] = $details['reference'];
        $data['email'] = $details['email'];
        $data['first_name'] = $details['name'];
        $data['metadata'] = $details;
        $data['currency'] = get_setting('currency_code') ?? "NGN";
        $data['callback_url'] = route('paystack.success') ;
        
        return Paystack::getAuthorizationUrl($data)->redirectNow();
    }
    public function paystack_success(Request $request)
    {
        $complete = new UserController();
        $payment = Paystack::getPaymentData();           
        if(!empty($payment['data']) && $payment['data']['status'] == 'success'){
            // return success url
            $ref = $payment['data']['reference'];
            return $complete->complete_walletDeposit($ref,$payment); 
        }
        else{
            $request->session()->remove('payment_data');
            return redirect()->route('user.wallet')->withError('Payment not successful'); 
        }
    }

    function reserveAccount($code)
    {
        // return $code;
        $data = [
            "customer" => $code
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.env('PAYSTACK_SECRET_KEY'),
        ])->post(env('PAYSTACK_PAYMENT_URL').'/dedicated_account', $data)->json();
        
        return $response;
    }

    function createCustomer($data){
        // return $data;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.env('PAYSTACK_SECRET_KEY'),
        ])->post(env('PAYSTACK_PAYMENT_URL').'/customer', $data)->json();
        
        return $response;
    }
}
