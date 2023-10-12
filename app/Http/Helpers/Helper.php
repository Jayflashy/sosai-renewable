<?php

use App\Models\Setting;
use App\Models\SystemSetting;
use App\Utility\AngazaApi;
use App\Utility\Bulksmsng;

if (!function_exists('static_asset')) {
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('public/assets/' . $path, $secure);
    }
}

//return file uploaded via uploader
if (!function_exists('my_asset')) {
    function my_asset($path, $secure = null)
    {
        return app('url')->asset('public/uploads/' . $path, $secure);
    }
}
if (!function_exists('get_setting')) {
    function get_setting($key)
    {
        $settings = Setting::first();
        $setting = $settings->$key;
        return $setting;
    }
}
if (!function_exists('sys_setting')) {
    function sys_setting($key, $default = null)
    {
        $settings = SystemSetting::all();
        $setting = $settings->where('name', $key)->first();

        return $setting == null ? $default : $setting->value;
    }
}

function text_trim($string, $length = null)
{
    if (empty($length)) $length = 100;
    return Str::limit($string, $length, "...");
}
function show_datetime($date, $format = 'F d, Y h:ia')
{
    return \Carbon\Carbon::parse($date)->format($format);
}
function show_date($date, $format = 'd M, Y')
{
    return \Carbon\Carbon::parse($date)->format($format);
}

function show_time($date, $format = 'h:ia')
{
    return \Carbon\Carbon::parse($date)->format($format);
}
//formats currency
if (!function_exists('format_price')) {
    function format_price($price)
    {
        $fomated_price = number_format($price, 2);
        $currency = get_setting('currency');
        return $currency .$fomated_price;
    }
}

// random string
function getTrxcode($length)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function getNumber($length)
{
    $characters = '1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function format_number($price)
{
    $fomated_price = number_format($price, 2);
    return $fomated_price;
}

function getPayCode($code){
    return $code.'_' . uniqid(time());
}

function angaza_clientName($id){

}

function send_sms($phone, $message){

    $data = [
        'from' => "SOSAI Energy",
        'body' => $message,
        'to' => $phone,
        "gateway" => "direct-refund",
    ];

    $api = new Bulksmsng();
    $response = $api->sendSms($data);
    if(isset($response['data']['status']) && $response['data']['status'] == "success"){
        return true;
    }else{
        return false;
    }
}

function angaza_token_from_link($url){
    $api = new AngazaApi();
    try{
        $res = $api->payment_token($url);
        return $res['keycode'] ?? "";
    }catch(Exception $e){
        return "";
    }

}
