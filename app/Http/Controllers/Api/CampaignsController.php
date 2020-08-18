<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;

class CampaignsController extends Controller
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function index(){
//        $spa_client = new ApiClient(env('SEND_PULSE_API_USER_ID'),env('SEND_PULSE_API_SECRET'), new FileStorage());
//        $spa_client = new ApiClient('b13edf69376b0d4b925d4d7394bbc62e',('78282d5c5cae2a342a11b714914895d2'), new FileStorage());
$api_user_id = env('SEND_PULSE_API_USER_id');
        $api_user_secret = env('SEND_PULSE_API_SECRET');
        $spa_client = new ApiClient($api_user_id,$api_user_secret, new FileStorage());



        $campaigns = $spa_client->listCampaigns();
        return $campaigns;
    }
}
