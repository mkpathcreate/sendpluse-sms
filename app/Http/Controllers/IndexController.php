<?php

namespace App\Http\Controllers;

use App\Rules\DateGreaterThanNow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;

class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('index');
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function send_sms(Request $request){
        $api_user_id = env('SEND_PULSE_API_USER_id');
        $api_user_secret = env('SEND_PULSE_API_SECRET');
        
        $request->validate([
            'sender' => 'required|max:11',
            'sms_text' => 'required|max:160',
            'mailing_list_id' => 'required|integer',
            'date' => !$request->send_now ? ['required', 'date', new DateGreaterThanNow] : ''
        ]);
        $date = $request->send_now ? Carbon::now()->addMinutes(15) : $request->date;
        $spa_client = new ApiClient($api_user_id,$api_user_secret, new FileStorage());

        // Create SMS campaign by book
        $params = [
            'sender' => 'testsender',
            'body' => 'test'
        ];
        $additionalParams = [
            'transliterate' => 0
        ];

        $send_sms_mailing_list = $spa_client->sendSmsByBook("949316",$params,$additionalParams);
        var_dump($send_sms_mailing_list);
    }
}
