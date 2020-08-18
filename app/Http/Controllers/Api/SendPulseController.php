<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;

class SendPulseController extends Controller
{
    public function index(){

//        $spa_client = new ApiClient(env('SEND_PULSE_API_USER_ID'),
//            env('SEND_PULSE_API_SECRET'), new FileStorage());

$api_user_id = env('SEND_PULSE_API_USER_id');
        $api_user_secret = env('SEND_PULSE_API_SECRET');
        $spa_client = new ApiClient($api_user_id,$api_user_secret, new FileStorage());


        $mailing_list = $spa_client->listAddressBooks();

        return response()->json($mailing_list,200);
    }
}
