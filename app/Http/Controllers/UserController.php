<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\User;
use App\Utility\AngazaApi;
use App\Utility\SteamaApi;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Paystack;
use Str;

class UserController extends Controller
{
    //
    function index(){
        $transactions = Transaction::whereUserId(Auth::user()->id)->orderByDesc('updated_at')->limit(10)->get();
        return view('user.index', compact('transactions'));
    }
    public function profile(){
        return view('user.profile');
    }
    function update_password(Request $request){
        $request->validate([
            'old_password' => 'required|string|min:5',
            'new_password' => 'required|string|min:5'
        ]);
        $user = Auth::User();
        // check if pssword matches
        if(Hash::check($request->old_password, $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->withSuccess('Password successfully changed');
        }
        return redirect()->back()->withError('Old Password is incorrect');
    }
    function update_profile(Request $request){
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'nullable|string',
        ]);
        // return $request;
        $user = Auth::User();
        $user->meter = $request->meter;
        $user->name = $request->name;
        // check if no user exists with the email and then save
        if(User::where('id','!=', $user->id)->where('phone', $request->phone)->first() == null){
            $user->phone = $request->phone;
        }else{
            return redirect()->back()->withError('Phone Number has been used');
        }
        $user->state = $request->state;
        $user->address = $request->address;

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = Str::random(23).'.jpg';
            // if aws or local storage
            if($user->image != null){
                try {
                    unlink(public_path('uploads/'.$user->image));
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            $image->move(public_path('uploads/users'),$imageName);

            $user->image = "users/".$imageName;
        }
        $user->save();
        // return $user;
        return redirect()->back()->withSuccess('Profile updated successfully');
    }
    function package_payment(){
        if(Auth::user()->meter_verify != 1)
        {
            return redirect()->back()->withError('Account Under Verification. You cant make payment at the moment');
        }
        $steama = new SteamaApi();
        $angaza = new AngazaApi();
        if(Auth::user()->acc_type == "steama"){
            try{
                $meter = $steama->getMeterDetails(Auth::user()->meter);
                $customer = $steama->getCustomerDetails($meter['customer']);
                return view('user.pay',compact('meter','customer'));
            }catch(\Exception $e){
                return back()->withError('Meter Number Not Found. Please Try Again');
            }
        }
        if(Auth::user()->acc_type == "angaza"){
            try{
                $meter = $angaza->getAccountDetails(Auth::user()->meter);
                $customer = $angaza->getClientDetails($meter['client_qids'][0]);
                // return $customer;
                return view('user.pay',compact('meter','customer'));
            } catch(\Exception $e){
                return back()->withError('Meter Number Not Found. Please Try Again');
            }

        }
        return view('user.pay');
    }
    function make_payment(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'amount' => 'required|numeric|min:10',
        ]);
        if ($request->amount > $user->balance){
            return back()->with('error', 'Insufficient Balance. Please fund your account')->withInput();
        }
        // return $request;
        if($request->meter_type == "steama"){
            $request->validate([
                'customer' => 'required|numeric',
                'meter' => 'required|numeric',
                'name' => 'required|string',
                'amount' => 'required|numeric|min:10',
            ]);
            $steama = new SteamaAPi();
            $ref = \getTrxcode(16);
            $date = Date('F d, Y h:ia');
            // check user balance
            $user->balance = $user->balance - $request->amount;
            $user->save();
            $customer = $request->customer;
            // create to transaction
            $trx = new Transaction();
            $trx->user_id = $user->id;
            $trx->amount = $request->amount;
            $trx->message = "Payment of ".format_price($request->amount). " for {$request->name}";
            $trx->type = "steama";
            $trx->code = $ref;
            $trx->oldbal = $user->balance + $request->amount;
            $trx->newbal = $user->balance;
            $trx->merchant = $request->customer;
            $trx->meter = $request->meter;
            $trx->name = $request->name;
            $trx->phone = $user->phone;
            $trx->save();

            $data = [
                'amount' => $request->amount,
                'reference' => $ref,
                'category' => 'UCU',
                'raw_message' => "Payment of {$request->amount} for {$request->name} via our website at {$date}"
            ];
            $response = $steama->userPayment($customer,$data);

            if( isset($response['id']) && isset($response['reference']) )
            {
                $trx->status = 1;
                $trx->response = json_encode($response);
                $trx->save();
                // send sms and email

                return redirect()->route('user.transactions')->withSuccess($trx->message ."was successful");
            }
            else{
                // refund wallet
                $user->balance += $request->amount;
                $user->save();
                $trx->status = 3;
                $trx->response = json_encode($response);
                $trx->save();
                return redirect()->route('user.payment')->withError($trx->message.' was not successful. Please try again');
            }

        }
        if($request->meter_type == "angaza"){
            $request->validate([
                'customer' => 'required|string',
                'meter' => 'required|numeric',
                'phone' => 'required|string',
                'name' => 'required|string',
                'amount' => 'required|numeric|min:500',
            ]);
            $steama = new AngazaAPi();
            $ref = \getTrxcode(16);
            $date = Date('F d, Y h:ia');
            // check user balance
            $user->balance = $user->balance - $request->amount;
            $user->save();
            $customer = $steama->getAccountDetails($request->meter);
            // create to transaction
            $trx = new Transaction();
            $trx->user_id = $user->id;
            $trx->amount = $request->amount;
            $trx->message = "Payment of ".format_price($request->amount). " for {$request->name}";
            $trx->type = "angaza";
            $trx->code = $ref;
            $trx->oldbal = $user->balance + $request->amount;
            $trx->newbal = $user->balance;
            $trx->merchant = $request->customer;
            $trx->meter = $request->meter;
            $trx->name = $request->name;
            $trx->phone = $request->phone;
            $trx->status = 2;
            $trx->save();
            $uuid = $steama->generateReference();
            $data = [
                'amount' => floatval($request->amount),
                'external_xref' => $ref,
                'msisdn' => $request->phone,
                'account_qid' => $customer['qid'],
            ];
            $response = $steama->userPayment($data, $uuid);
            if( isset($response['qid']) && isset($response['account_qid']) )
            {
                $trx->status = 1;
                $trx->response = ($response);
                $trx->save();
                // send sms and email
                return redirect()->route('user.transactions')->withSuccess($trx->message ."was successful");
            }
            else{
                // refund wallet
                $user->balance += $request->amount;
                $user->save();
                $trx->status = 3;
                $trx->response = json_encode($response);
                $trx->save();
                return redirect()->route('user.payment')->withError($trx->message.' was not successful. Please try again');
            }

        }

        // paygee

        // lumeter

        return back()->with('error', 'Invalid Request. Please try again')->withInput();
    }
    // transactions
    public function transactions(){
        $transactions = Transaction::whereUserId(Auth::user()->id)->orderByDesc('updated_at')->get();
        return view('user.transactions', \compact('transactions'));
    }
    public function wallet(){

        $deposits = Deposit::whereUserId(Auth::user()->id)->orderByDesc('id')->get();
        return view('user.wallet', \compact('deposits'));
    }
    public function fund_wallet(Request $request)
    {
        $request->validate([
            'amount' => 'required|min:1',
            'email' => 'required|email',
        ]);
        $ref = getPayCode('psk');
        $payment = new PaymentController;
        $user = Auth::user();
        // create deposit trx
        $deposit = new Deposit();
        $deposit->user_id = $user->id;
        $deposit->email = $request->email;
        $deposit->gateway = "paystack";
        $deposit->trx = $ref;
        $deposit->message = "Wallet Funding Payment";
        $deposit->amount = $request['amount'];
        $deposit->status = 3;
        $deposit->save();
        $details['amount'] = $request->amount;
        $details['name'] = $user->name;
        $details['user_id'] = $user->id;
        $details['deposit_id'] = $deposit->id;
        $details['description'] = "Wallet Funding Payment";
        $details['reference'] = $ref;
        $details['email'] = $request->email;
        // put details to session
        $request->session()->put('payment_data', $details);
        return $payment->initPaystack($details);

    }
    function complete_walletDeposit($ref, $payment)
    {
        $deposit = Deposit::whereTrx($ref)->first();
        if($deposit->status == 1){
            return redirect()->route('user.wallet')->withError('Transaction already Approved. Please try again');
        }
        $deposit->status = 1;
        $deposit->response = $payment;
        $deposit->save();
        // Add User Balance
        $user = $deposit->user;
        $user->balance += $deposit->amount;
        $user->save();
        return redirect()->route('user.index')->withSuccess('Payment was successful');
    }
    public function deposit_history(){

        $deposits = Deposit::whereUserId(Auth::user()->id)->orderByDesc('id')->get();
        return view('user.deposits', \compact('deposits'));
    }
    function bank(){
        // return "helpp";
        $user = Auth::user();
        $payment = new PaymentController();
        $name = explode(" ", $user['name']);
        $data = [
            'email' => $user['email'],
            'first_name' => $name[0],
            'last_name' => $name[1],
            'phone' => $user['phone'],
        ];
        // create customer first

        $customer = $payment->createCustomer($data);
        if($customer['status'] == true){
            $customer_code = $customer['data']['customer_code'];
            $user->virtual_ref = $customer_code;
            $user->save();
            // create dedicated account
            return $response = $payment->reserveAccount($customer_code);
        }


        return $response = $payment->reserveAccount($data);
        if($response['responseMessage'] == 'success'){
            $banks = $response['responseBody']['accounts'];
            $user->virtual_ref = $data['reference'];
            $user->virtual_banks = $banks;
            $user->save();
        }else{
            return;
        }
    }

}
