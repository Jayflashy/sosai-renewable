<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Validator;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()){
            if(auth()->user()->user_role == 'admin' || auth()->user()->user_role == 'staff') {
                return redirect()->route('admin.index');
            }else if(auth()->user()->user_role == 'agent') {
                return redirect()->route('agent.index');
            }else{
                return redirect()->route('user.index');
            }
        }
        return view('auth.login');
    }
    public function admin_login()
    {
        return view('admin.login');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('index')->withSuccess('User Logged Out Successfully');
    }

    function register(Request $request){
        // validate
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'numeric'],
            'meter' => ['required', 'string'],
            'address' => ['required', 'string'],
            'state' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:25', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        // return $request;
        $user = new User();
        $user->meter = $request->meter;
        if(strlen($request->meter) == 6 || strlen($request->meter) == 7){
            $acc_type = 'steama';
        }elseif(strlen($request->meter) == 9 || strlen($request->meter) == 8){
            $acc_type = 'angaza';
        }else{
            $acc_type = "others";
        }
        $user->acc_type = $acc_type;
        $user->meter_verify = 2;
        $user->status = 1;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->state = $request->state;
        $user->password = Hash::make($request->password);
        $user->user_role = "user";
        $user->email_verified_at = date('Y-m-d H:m:s');
        $user->save();
        // login new user
        auth()->login($user);
        // redirect to dashboard
        return redirect()->route('user.index');
    }
}
