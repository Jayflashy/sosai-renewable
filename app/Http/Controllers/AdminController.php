<?php

namespace App\Http\Controllers;

use App\Models\{
    Deposit, User
};
use App\Models\Transaction;
use App\Utility\AngazaApi;
use App\Utility\SteamaApi;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function index(){
        $users = User::whereBlocked(0)->whereUserRole('user')->orderByDesc('id')->get();
        $agents = User::whereBlocked(0)->whereUserRole('agent')->orderByDesc('id')->get();
        $deposit = Deposit::orderByDesc('id')->get();
        $transactions = Transaction::orderByDesc('id')->get();
        $trx = Transaction::orderByDesc('id')->limit(20)->get();
        return view('admin.index', compact('users','deposit','transactions','agents','trx'));
    }
    function profile(){
        return view('admin.profile');
    }
    function update_profile (Request $request){

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;

        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return back()->withSuccess(__('Profile Updated Successfully.'));
    }
    public function deposit_history(){

        $deposits = Deposit::orderByDesc('id')->get();
        return view('admin.deposits', \compact('deposits'));
    }
    // transactions
    public function all_transactions(){
        $transactions = Transaction::orderByDesc('updated_at')->get();
        return view('admin.trx.index', \compact('transactions'));
    }
    public function angaza_transactions(){
        $transactions = Transaction::whereType('angaza')->orderByDesc('updated_at')->get();
        $title = "Angaza Transactions";
        return view('admin.trx.type', \compact('transactions','title'));
    }
    public function steama_transactions(){
        $transactions = Transaction::whereType('steama')->orderByDesc('updated_at')->get();
        $title = "Steama Transactions";
        return view('admin.trx.type', \compact('transactions','title'));
    }
    public function users(){
        $users = User::where('user_role', '!=', 'admin')->whereBlocked(0)->orderByDesc('id')->get();
        return view('admin.users.index', compact('users'));
    }
    public function pending_users(){
        $users = User::whereMeterVerify(2)->orderByDesc('id')->get();
        return view('admin.users.pending', compact('users'));
    }
    public function ban_user($id,$status)
    {
        $user = User::findorFail($id);
        $user->suspend = $status;
        $user->save();
        return redirect()->back()->withSuccess(__('User updated Successfully.'));
    }
    public function delete_user($id)
    {
        $user = User::findorFail($id);
        $user->blocked = 1;
        $user->save();
        return redirect()->back()->withSuccess(__('User deleted Successfully.'));
    }
    public function approve_user($id)
    {
        $user = User::findorFail($id);
        $user->meter_verify = 1;
        $user->save();
        return redirect()->back()->withSuccess(__('User Approved Successfully.'));
    }
    function view_user ($id){
        $user = User::findorFail($id);
        return view('admin.users.view', compact('user'));
    }
    function update_user ($id, Request $request){
        $user = User::findorFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->acc_type = $request->acc_type;
        $user->meter = $request->meter;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->back()->withSuccess(__('User updated Successfully.'));
    }
    function user_deposit ($id){
        $user = User::findorFail($id);
        $deposits = Deposit::orderByDesc('id')->whereUserId($user->id)->get();
        return view('admin.users.deposits', compact('deposits','user'));
    }
    function user_trx ($id){
        $user = User::findorFail($id);
        $trx = Transaction::orderByDesc('id')->whereUserId($user->id)->get();
        return view('admin.users.trx', compact('trx','user'));
    }
    function update_user_balance ($id, Request $request){
        $this->validate($request, [
            'amount' => 'required|numeric|min:0',
            'type' => 'required',
            'message' => 'required'
        ]);
        $user = User::findorFail($id);
        if($request->type == 1){
            // Add User Balance
            $user->balance =  $user->balance + $request->amount ;
            $user->save();
        } else{
            // create transaction
            // Add User Balance
            $user->balance =  $user->balance - $request->amount;
            $user->save();

        }
        return redirect()->back()->withSuccess(__('User Balance updated Successfully.'));
    }

    // steamaco apis
    function steamaco_overview(){
        $steamaco = new SteamaApi();
        $agents = $steamaco->allAgents();
        $sites = $steamaco->allSites();
        $customers = $steamaco->allCustomers();
        $meters = $steamaco->allMeters();
        return view('admin.steama.overview',compact('agents','sites','meters','customers'));
    }
    function steamaco_meters(){
        $steamaco = new SteamaApi();
        $meters = $steamaco->allMeters();
        return view('admin.steama.meters',compact('meters'));
    }
    function steamaco_customers(){
        $steamaco = new SteamaApi();
        $customers = $steamaco->allCustomers();
        return view('admin.steama.customers',compact('customers'));
    }

    function angaza_meters(){
        $steamaco = new AngazaApi();
        // dd($steamaco->allAccounts());
        $meters = $steamaco->allAccounts()['_embedded'];
        // dd($meters);
        return view('admin.angaza.meters',compact('meters'));
    }
    function angaza_customers(){
        $steamaco = new AngazaApi();
        $customers = $steamaco->allClients()['_embedded'];
        return view('admin.angaza.customers',compact('customers'));
    }

    // agents
    public function agents(){
        $agents = User::where('user_role', '=', 'agent')->whereBlocked(0)->orderByDesc('id')->get();
        return view('admin.agents.index', compact('agents'));
    }
    public function pending_agents(){
        $agents = User::whereMeterVerify(2)->orderByDesc('id')->get();
        return view('admin.agents.pending', compact('agents'));
    }
    public function ban_agent($id,$status)
    {
        $user = User::findorFail($id);
        $user->suspend = $status;
        $user->save();
        return redirect()->back()->withSuccess(__('Agent updated Successfully.'));
    }
    function view_agent ($id){
        $agent = User::findorFail($id);
        return view('admin.agents.view', compact('agent'));
    }
    function agent_trx_type ($type,$id){;
        $user = User::findorFail($id);
        $trx = Transaction::orderByDesc('id')->whereUserId($user->id)->whereType($type)->get();
        $title ="Agent ".$user->username." ". $type ." Transactions";
        return view('admin.agents.trx', compact('trx','user','title'));
    }
    function create_agent (){
        return view('admin.agents.create');
    }
    function store_agent(Request $request){
        // validate request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'numeric'],
            'address' => [ 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:25', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = new User();
        $user->meter_verify = 1;
        $user->status = 1;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->user_role = "agent";
        $user->email_verified_at = date('Y-m-d H:m:s');
        $user->save();

        return redirect()->route('admin.agents.index')->withSuccess('Agent created Successfully');
    }
}
