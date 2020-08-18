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
        $request->validate([
            'sender' => 'required|max:11',
            'sms_text' => 'required|max:160',
            'mailing_list_id' => 'required|integer',
            'date' => !$request->send_now ? ['required', 'date', new DateGreaterThanNow] : ''
        ]);
        $date = $request->send_now
            ? Carbon::now()->addMinutes(15)->toDateTimeString()
            : (new Carbon($request->date))->toDateTimeString();



//        $spa_client = new ApiClient(env('SEND_PULSE_API_USER_ID'),
//            env('SEND_PULSE_API_SECRET'), new FileStorage());
$api_user_id = env('SEND_PULSE_API_USER_id');
        $api_user_secret = env('SEND_PULSE_API_SECRET');
        $spa_client = new ApiClient($api_user_id,$api_user_secret, new FileStorage());

//	var_dump($date);
        // Create SMS campaign by book
        $params = [
            'sender' => $request->sender,
            'body' => $request->sms_text,
            'date' => $date,
        ];
        $additionalParams = [
            'transliterate' => 0
        ];

        $send_sms_mailing_list = $spa_client->sendSmsByBook($request->mailing_list_id, $params, $additionalParams);
var_dump($send_sms_mailing_list);       
if($send_sms_mailing_list->result){
            session()->flash('success', 'Campaign was created successfully');
        }
        return back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function my_campaigns(){
        return view('my-campaigns');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function my_campaign_info($id){
//  $spa_client = new ApiClient(env('SEND_PULSE_API_USER_ID'),
//            env('SEND_PULSE_API_SECRET'), new FileStorage());

$api_user_id = env('SEND_PULSE_API_USER_id');
        $api_user_secret = env('SEND_PULSE_API_SECRET');
        $spa_client = new ApiClient($api_user_id,$api_user_secret, new FileStorage());


        $campaign = $spa_client->getCampaignInfo($id);
        $sms_campaign = $spa_client->getSmsCampaignInfo($id);
        $summary = [
            'sent' => count($sms_campaign->data->task_phones_info),
            'delivered' => 0,
            'undelivered' => 0
        ];
        foreach ($sms_campaign->data->task_phones_info as $phone){
            if($phone->status == 2){
                $summary['delivered'] += 1;
            }elseif ($phone->status == 12){
                $summary['undelivered'] += 1;
            }
        }
        return view('my-campaign', compact('campaign', 'sms_campaign',
            'summary'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function my_campaign_cancel($id){
//        $spa_client = new ApiClient(env('SEND_PULSE_API_USER_ID'),
//            env('SEND_PULSE_API_SECRET'), new FileStorage());
$api_user_id = env('SEND_PULSE_API_USER_id');
        $api_user_secret = env('SEND_PULSE_API_SECRET');
        $spa_client = new ApiClient($api_user_id,$api_user_secret, new FileStorage());


        $cancel = $spa_client->cancelSmsCampaign($id);
        if($cancel->result){
            session()->flash('success', 'Campaign was cancelled');
        }else if($cancel->is_error){
            session()->flash('error', $cancel->message);
        }
        return back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function my_campaign_delete($id){
//        $spa_client = new ApiClient(env('SEND_PULSE_API_USER_ID'),
//            env('SEND_PULSE_API_SECRET'), new FileStorage());

$api_user_id = env('SEND_PULSE_API_USER_id');
        $api_user_secret = env('SEND_PULSE_API_SECRET');
        $spa_client = new ApiClient($api_user_id,$api_user_secret, new FileStorage());


        $delete = $spa_client->deleteSmsCampaign($id);
        if($delete->result){
            session()->flash('success', 'Campaign was deleted');
        }else{
            session()->flash('error', 'was not deleted');
        }
        return redirect()->to('/my-campaigns');
    }
}
