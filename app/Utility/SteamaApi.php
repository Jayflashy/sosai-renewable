<?php

namespace App\Utility;

use Http;

class SteamaApi

{
    protected $username ;
    protected $password;
    protected $baseurl ;
    
    public function __construct()
    {
        $this->username = env('STEAMACO_USERNAME');
        $this->password = env('STEAMACO_PASSWORD');
        $this->baseurl = "https://api.steama.co";
    }
    
    public function generateReference()
    {
        return 'sosai_' . uniqid(time());
    }

    public function getHeader(){
        $data = [
            "username" => $this->username,
            "password" => $this->password
        ];
        $response = Http::withHeaders([
            'Content-type' => "Application/json"
        ])->post($this->baseurl.'/get-token/', $data);

        return 'Token ' . $response['token'];
    } 

    public function getMeterDetails($id)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->getHeader()
        ])->post($this->baseurl.'/meters/'.$id);
        return $response;
    }

    public function getCustomerDetails($id)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->getHeader()
        ])->post($this->baseurl.'/customers/'.$id);
        return $response;
    }

    public function userPayment($customer, $data)
    {
        // $url = ;
        // return $data;
        $response = Http::withHeaders([
            'Authorization' => $this->getHeader()
        ])->post($this->baseurl.'/customers/'.$customer.'/transactions/', $data)->json();
        return $response;
    }

    public function allMeters()
    {
        $response = Http::withHeaders([
            'Authorization' => $this->getHeader()
        ])->get($this->baseurl.'/meters/?page=1&page_size=500&ordering=-id&is_active=true')->json();
        return $response;
    }
    public function allCustomers()
    {
        $response = Http::withHeaders([
            'Authorization' => $this->getHeader()
        ])->get($this->baseurl.'/customers/?page=1&page_size=500&ordering=-id')->json();
        return $response;
    }
    public function allAgents()
    {
        $response = Http::withHeaders([
            'Authorization' => $this->getHeader()
        ])->get($this->baseurl.'/agents/')->json();
        return $response;
    }
    public function allSites()
    {
        $response = Http::withHeaders([
            'Authorization' => $this->getHeader()
        ])->get($this->baseurl.'/sites/')->json();
        return $response;
    }

}