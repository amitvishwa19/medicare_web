<?php

namespace App\Services;


class Fyers{
    private $auth_code = null;
    private $access_token = null;
    private $profile = null;
    private $funds = null;
    private $orders = null;
    private $trades = null;
    private $base_url;   
    private $client_id;
    private $ap_secret;
    private $redirect_url;
    private $state;


    public function __construct(){

        $this->base_url = env('FYERS_URL');   
        $this->client_id = env('FYERS_CLIENT_ID');
        $this->ap_secret = env('FYERS_CLIENT_SECRET');
        $this->redirect_url = env('FYERS_REDIERECT_URL');
        $this->state = 'tada';

    }

    public function auth_url(){
        return $fyers_auth_url = $this->base_url . 'client_id=' . $this->client_id . '&redirect_uri=' . $this->redirect_url . '&response_type=code&state=' . $this->state;
    }

    public function set_auth_code($auth_code){
        $this->auth_code = $auth_code;
    }

    public function access_token($auth_code){

        $curl_url = 'https://api.fyers.in/api/v2/' . $auth_code;
        
        $data = json_encode(array(
            "grant_type"  => "authorization_code",
            "appIdHash" => "f86d6ca70e4f52f3e2a6cb614d4330702675fd55f05012216607c8e9b3a6e06f",
            "code" => $auth_code
        ));

        //Getting Auth Token;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.fyers.in/api/v2/validate-authcode');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);
        $this->access_token = $result['access_token'];
        return $this->access_token;
    }

    public function get_profile($access_token){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.fyers.in/api/v2/profile');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array();
        $headers[] = 'Authorization:'.$this->client_id.':' . $access_token ;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = json_decode(curl_exec($ch), true);
        $this->profile = $result['data'];
        curl_close($ch);
        return $this->profile;
        
    }


    public function get_funds($access_token){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.fyers.in/api/v2/funds');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Authorization:'.$this->client_id.':' . $access_token ;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);
        $this->funds =  $result['fund_limit'];
        return $this->funds;
    }


    public function get_order_book($access_token){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.fyers.in/api/v2/orders');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Authorization:'.$this->client_id.':' . $access_token ;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);
        $this->orders = $result['orderBook'];
        return $this->orders;
    }

    public function get_trades($access_token){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.fyers.in/api/v2/tradebook');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Authorization:'.$this->client_id.':' . $access_token ;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);
        $this->trades = $result['tradeBook'];
        return $this->trades;
    }

}