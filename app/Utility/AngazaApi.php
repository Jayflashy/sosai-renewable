<?php

namespace App\Utility;

use Http;

class AngazaApi

{
    protected $username ;
    protected $password;
    protected $baseurl ;
    
    public function __construct()
    {
        $this->username = env('ANGAZA_USERNAME');
        $this->password = env('ANGAZA_PASSWORD');
        $this->baseurl = "https://payg.angazadesign.com/data";
        $this->baseurl1 ="https://stoplight.io/mocks/angaza/dev-portal-connects/67771774";
    }
    
    public function generateReference()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for the time_low
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            // 16 bits for the time_mid
            mt_rand(0, 0xffff),
            // 16 bits for the time_hi,
            mt_rand(0, 0x0fff) | 0x4000,

            // 8 bits and 16 bits for the clk_seq_hi_res,
            // 8 bits for the clk_seq_low,
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for the node
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
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

    public function getAccountDetails($id)
    {
        $response = Http::withBasicAuth($this->username, $this->password)->withHeaders([
            'Content-type' => "Application/json"
        ])->get($this->baseurl.'/accounts_by_number/'.$id);
        return $response;
    }

    public function getClientDetails($id)
    {
        $response = Http::withBasicAuth($this->username, $this->password)->withHeaders([
            'Content-type' => "Application/json"
        ])->get($this->baseurl.'/clients/'.$id);
        return $response;
    }
    public function allAccounts()
    {
        $response = Http::withBasicAuth($this->username, $this->password)->withHeaders([
            'Content-type' => "Application/json"
        ])->get($this->baseurl.'/accounts?')->json();
        return $response;
    }
    public function allClients()
    {
        $response = Http::withBasicAuth($this->username, $this->password)->withHeaders([
            'Content-type' => "Application/json"
        ])->get($this->baseurl.'/clients?')->json();
        return $response;
    }
    public function userPayment($data, $ref)
    {
        // $url = ;
        // return $ref;
        $response = Http::withBasicAuth($this->username, $this->password)
        ->put($this->baseurl.'/payments/'.$ref, $data)->json();
        return $response;
    }
}