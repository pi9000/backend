<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Update;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\RequestOtp;
use App\Models\LogActivity;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function _get_me_count(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id
        ];

        $data = curl_post('_get_me_count', $params, auth()->user()->brand_id);
        return $data->count ?? 0;
    }

    public function _get_latest(Request $request)
    {

        $params = [
            'agent_id' => auth()->user()->agent_id
        ];

        $data = curl_post('_get_latest', $params, auth()->user()->brand_id);
        $actions = LogActivity::where('agent_id', auth()->user()->agent_id)->where('status', 0)->count();

        return response()->json([
            'instant_withd' => $data->instant_wd ?? 0,
            'balance' => currencyFormat(auth()->user()->balance, 0),
            'actions' => $actions,
            'instant_depo' => $data->instant_depo ?? 0,
        ]);
    }

    public function _get_latest_promotion(Request $request)
    {
        return response()->json([
            'promo' => 0,
            'bonus' => 0
        ]);
    }

    public function comingsoon(Request $request)
    {
        $pageTitle = 'Coming Soon';
        return view('page.addtional.coomingson', compact('pageTitle'));
    }

    public function request_otp_session(Request $request)
    {
        $otp = new RequestOtp();
        $otp->agent_code = auth()->user()->parent;
        $otp->user_id = auth()->user()->id;
        $otp->code = rand(100000, 999999);
        $otp->action = $request->update_details;
        $otp->ip_address = $request->ip();
        $otp->expired_at = Carbon::now()->addMinutes(5);
        $otp->save();

        Mail::to(auth()->user()->email)->queue(new Update(setting()->brand_name, setting()->logo, auth()->user()->username, auth()->user()->agent_id, $otp->code, $request->update_details, env('MAIL_FROM_ADDRESS')));

        return response()->json([
            'status' => 1,
            'destination' => censor_email(auth()->user()->email),
            'method' => 'Email',
            'token' => $request->_token
        ]);
    }
}
