<?php

namespace App\Utility;

use Http;

class PaygeeApi

{
    protected $apikey ;
    protected $baseurl ;

    public function __construct()
    {
        $this->apikey = env('PAYGEE_API');
        $this->baseurl = "https://payments.plugintheworld.com/payment_gateway";
    }

    public function generateReference()
    {
        return 'paygee_' . uniqid(time());
    }

    public function getHeader(){

        return $response = [
            'Content-type' => "application/json",
            'Accept' => "application/json",
            "API-KEY" => $this->apikey
        ];

    }

    public function getMeterDetails($id)
    {
        $response = Http::withHeaders(
            $this->getHeader()
        )->post($this->baseurl.'/meters/'.$id);
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
