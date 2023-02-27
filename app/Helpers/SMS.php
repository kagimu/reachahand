<?php
/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 26/03/2022
 * Time: 18:44
 */

namespace App\Helpers;
use AfricasTalking\SDK\AfricasTalking;


class SMS
{
    protected $username = 'zaploansug'; //'treeclinic';
    protected $apiKey = '26f45c2a94667f9cf75cc843d39c817104eb80e62b4cc36562b174f2f1ee08c1'; //'f6345ba7f3198a6199378fc7cb1be3f4710fba818ab2742368c517e8ddc3f0c0';
    protected $sms;

    public function __construct()
    {
        $AT = new AfricasTalking($this->username, $this->apiKey);
        $this->sms = $AT->sms();
    }

    public function sendCode($phone, $code){

        $result   = $this->sms->send([
            'to'      => '+256' . substr($phone, 1),
            'message' => 'Your LandVille code is ' . $code
        ]);

        return $result;
    }


}