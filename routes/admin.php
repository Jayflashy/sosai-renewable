<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('admin')->controller(AdminController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/profile', 'profile')->name('profile');
    Route::post('/profile', 'update_profile')->name('profile');

    Route::get('/deposit-history', 'deposit_history')->name('deposits');
    Route::get('/transactions', 'all_transactions')->name('transactions');
    Route::get('/transactions/angaza', 'angaza_transactions')->name('transactions.angaza');
    Route::get('/transactions/steama', 'steama_transactions')->name('transactions.steama');

    Route::post('/wallet', 'fund_wallet')->name('wallet');
    Route::get('/bank-generate', 'bank');
    // asteamaco meters
    Route::get('/steamaco/overview', 'steamaco_overview')->name('steamaco.overview');
    Route::get('/steamaco/customers', 'steamaco_customers')->name('steamaco.customers');
    Route::get('/steamaco/meters', 'steamaco_meters')->name('steamaco.meters');
    // angaza meters
    Route::get('/angaza/overview', 'angaza_overview')->name('angaza.overview');
    Route::get('/angaza/customers', 'angaza_customers')->name('angaza.customers');
    Route::get('/angaza/accounts', 'angaza_meters')->name('angaza.meters');

});
Route::middleware('admin')->controller(AdminController::class)->as('agents.')->prefix('agents')->group(function(){
    Route::get('/' , 'agents')->name('index');
    Route::post('/store' , 'store_agent')->name('store');
    Route::get('/create' , 'create_agent')->name('create');
    Route::get('/pending' , 'pending_agents')->name('pending');
    Route::get('/view/{id}' , 'view_agent')->name('view');
    Route::get('/approve/{id}' , 'approve_user')->name('approve');
    Route::get('/deposits/{id}' , 'user_deposit')->name('deposits');
    Route::get('/deposits/pay/{id}' , 'user_deposit_pay')->name('manual.pay');
    Route::get('/deposits/delete/{id}' , 'user_deposit_delete')->name('manual.delete');
    Route::get('/referrals/{id}' , 'user_referral')->name('referrals');
    Route::get('/transactions/{id}' , 'user_trx')->name('transactions');
    Route::get('/transaction/{type}/{id}' , 'agent_trx_type')->name('transaction.type');
    Route::get('/delete/{id}' , 'delete_user')->name('delete');
    Route::get('/ban/{id}/{status}' , 'ban_user')->name('ban');
    Route::post('/edit/{id}' , 'update_user')->name('update');
    Route::post('/balance/{id}' , 'update_user_balance')->name('balance');
});
Route::middleware('admin')->controller(AdminController::class)->as('users.')->prefix('users')->group(function(){
    Route::get('/' , 'users')->name('index');
    Route::get('/pending' , 'pending_users')->name('pending');
    Route::get('/banned' , 'banned_users')->name('banned');

    Route::get('/view/{id}' , 'view_user')->name('view');
    Route::get('/edit/{id}' , 'edit_user')->name('edit');
    Route::get('/approve/{id}' , 'approve_user')->name('approve');
    Route::get('/deposits/{id}' , 'user_deposit')->name('deposits');
    Route::get('/deposits/pay/{id}' , 'user_deposit_pay')->name('manual.pay');
    Route::get('/deposits/delete/{id}' , 'user_deposit_delete')->name('manual.delete');
    Route::get('/referrals/{id}' , 'user_referral')->name('referrals');
    Route::get('/transactions/{id}' , 'user_trx')->name('transactions');
    Route::get('/delete/{id}' , 'delete_user')->name('delete');
    Route::get('/ban/{id}/{status}' , 'ban_user')->name('ban');
    Route::post('/edit/{id}' , 'update_user')->name('update');
    Route::post('/balance/{id}' , 'update_user_balance')->name('balance');
    Route::get('/settings' , 'user_settings')->name('settings');
});
Route::middleware('admin')->controller(SettingController::class)->as('settings.')->prefix('settings')->group(function(){
    Route::get('/payment' , 'payment')->name('payment');
    Route::get('/' , 'website')->name('index');
    Route::get('/api' , 'api')->name('api');

    Route::post('/update', 'update')->name('update');
    Route::post('/system', 'systemUpdate')->name('sys_settings');
    Route::post('/system/store', 'store_settings')->name('store_settings');
    Route::post('env_key', 'envkeyUpdate')->name('env_key');
});
