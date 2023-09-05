<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
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

Auth::routes();
Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/home', 'index')->name('home');
    Route::get('/admin/login', 'admin_login')->name('admin.login')->middleware('guest');
    Route::get('/logout', 'logout')->name('logout');
    Route::post('/register', 'register')->name('register');
});

Route::middleware('user')->prefix('user')->as('user.')->controller(UserController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/profile', 'profile')->name('profile');
    Route::post('/profile', 'update_profile')->name('profile');
    Route::post('/password/update', 'update_password')->name('password.update');
    Route::get('/deposit-history', 'deposit_history')->name('deposits');
    Route::get('/payment', 'package_payment')->name('payment');
    Route::post('/payment', 'make_payment')->name('payment');
    Route::get('/wallet', 'wallet')->name('wallet');
    Route::post('/wallet', 'fund_wallet')->name('wallet');
    Route::get('/transactions', 'transactions')->name('transactions');
    Route::get('/bank-generate', 'bank');
});

Route::middleware('agent')->prefix('agent')->as('agent.')->controller(AgentController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/profile', 'profile')->name('profile');
    Route::post('/profile', 'update_profile')->name('profile');
    Route::post('/password/update', 'update_password')->name('password.update');
    Route::get('/deposit-history', 'deposit_history')->name('deposits');
    Route::get('/payment', 'package_payment')->name('payment');
    Route::post('/payment', 'make_payment')->name('payment');
    Route::get('/wallet', 'wallet')->name('wallet');
    Route::post('/wallet', 'fund_wallet')->name('wallet');
    Route::get('/transactions', 'transactions')->name('transactions');
    Route::get('/bank-generate', 'bank');
    // Meter Verification
    Route::any('/steamaco/verify', 'verify_steamaco')->name('verify.steama');
    Route::any('/angaza/verify', 'verify_angaza')->name('verify.angaza');
});

// Payment Callback
Route::controller(PaymentController::class)->group(function(){
    Route::get('/paystack/success/', 'paystack_success')->name('paystack.success');
    Route::post('/paystack/callback', 'paystack_callback')->name('paystack.callback');
});
