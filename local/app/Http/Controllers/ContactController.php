<?php

namespace App\Http\Controllers;

use Mail;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function get(){
        $request = Request::all();
        $ip = Request::ip();
        $response = json_decode($this->curlme($request['g-recaptcha-response'], $ip));
        if($response->success == true){
            Mail::raw($request['message'], function ($message) use ($request){
                $message->from($request['email'], '就業博覽會網站');
                $message->replyTo($request['email'], $request['name']);
                $message->to('career@mail.ntpu.edu.tw')->subject('就業博覽會網站留言');
            });
        }
    }

    private function curlme($data, $ip){
        $ch = curl_init();
        $options = array(CURLOPT_URL       => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_HEADER         => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6",
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS     => array( "secret"=>"6LexLwcTAAAAAN8rVmkRi-Ec9xtzbBFrl3KWdTYa", "response"=>"{$data}", 'remoteip'=>"{$ip}"),
            CURLOPT_TIMEOUT        => 150
        );
        curl_setopt_array($ch, $options);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

}
