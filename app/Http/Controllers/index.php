<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class index extends Controller
{
    protected $appid="7b019d433529d449";
    protected $appscript="434787ce017b4ff4f800678b33244325";
    protected $callback="http://yiban.dlinkblog.cn";
    public function index(){
$token=$this->gettoken();
$this->getaccesstoken($token);
    }
    public function gettoken(){
        $tokenurl="https://openapi.yiban.cn/oauth/authorize?client_id=".$this->appid."&redirect_uri=".$this->callback;
 $token=file_get_contents($tokenurl);
var_dump($token);
return $token;
    }
    public function getaccesstoken($token){
        $data=array('client_id'=>$this->appid,'client_secret'=>$this->appscript,'code'=>$token,'redirect_uri'=>$this->callback);
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,'https://openapi.yiban.cn/oauth/access_token');
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_HEADER,$token);
        curl_exec($ch);
        dump($ch);

    }
}