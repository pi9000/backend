<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\RequestOtp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Mail\TwoFactor;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Models\LoginHistory;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        session(['attemp' => 5]);

        return view('auth.login');
    }

    public function verifyLogin()
    {
        if (auth()->user()->login_verifed != 10) {
            return redirect()->route('index');
        }
        session(['attemp' => 5]);
        return view('auth.verify');
    }

    public function login(Request $request)
    {
        $user = Admin::where('username', $request->u)->first();

        if (Session::get('captcha') != $request->v) {
            $s = 'f';
            $a = session()->get('attemp');
            $m = 'Invalid Captcha Validation.';
        } elseif (empty($user)) {
            $s = 'f';
            $a = session()->get('attemp');
            $m = 'Invalid  username or password.';
        } elseif (!Hash::check($request->p, $user->password)) {
            $attemp = session()->get('attemp');

            if ($attemp == 0) {
                session(['attemp' => 0]);
                $s = 'f';
                $a = $attemp;
                $m = 'Account Locked.';

                $user->status = 0;
                $user->save();
            } else {
                if ($attemp == 0) {
                    $attemps = 0;
                } else {
                    $attemps = $attemp - 1;
                }

                session(['attemp' => $attemps]);

                $s = 'f';
                $a = $attemps;
                $m = 'Invalid  username or password.';
            }

            return response()->json([
                's' => $s,
                'm' => $m,
                'attempt' => $a
            ]);
        } elseif ($user->status != 1) {
            $s = 'f';
            $m = 'Account Locked.';
            $a = session()->get('attemp');

            return response()->json([
                's' => $s,
                'm' => $m,
                'attempt' => $a
            ]);
        } else {
            session(['agent_request' => $user->agent_id]);

            $s = 's';
            $m = view('auth.secure-pin-code')->render();
            $a = session()->get('attemp');
            $ag = session()->get('agent_request');

            return response()->json([
                's' => $s,
                'sp' => $m,
                'agent' => $ag,
                'fa_enable' => 'true',
                'attempt' => $a
            ]);
        }
    }

    public function second_password(Request $request)
    {
        $user = Admin::where('agent_id', session()->get('agent_request'))->first();

        if (empty($user)) {
            $response = [
                's' => 'f',
                'm' => 'Invalid Secure PinCode !'
            ];
        } elseif (!Hash::check(implode('', $request->pincode), $user->secure_pin)) {
            $response = [
                's' => 'f',
                'm' => 'Invalid Secure PinCode !'
            ];
        } else {
            $user->login_verifed = 1;
            $user->last_login_ip = $request->ip();
            $user->last_login_time = Carbon::now();
            $user->last_logout_time = Carbon::now();
            $user->save();
            Auth::login($user);
            $loginHistory = new LoginHistory();
            $loginHistory->agent_id = $user->id;
            $loginHistory->ip_address = $request->ip();
            $loginHistory->country = geoLocation($request->ip())->country . ' / ' . geoLocation($request->ip())->city;
            $loginHistory->login_time = Carbon::now();
            $loginHistory->save();

            // Mail::to($user->email)->queue(new TwoFactor(setting()->brand_name,setting()->logo,$user->username, $user->agent_id, $otp->code,env('MAIL_FROM_ADDRESS')));
            $response = [
                's' => 'request_otp',
                'm' => 'request_otp'
            ];
        }

        return response()->json($response);
    }

    public function logout(Request $request)
    {
        $user = Admin::find(auth()->user()->id);
        $user->last_logout_time = Carbon::now();
        $user->save();
        Auth::logout($user);

        return redirect('/');
    }

    public function verifyCode(Request $request)
    {
        $user = Admin::find(auth()->user()->id);

        $check = RequestOtp::where('user_id', auth()->user()->id)->where('action', 'auth')->where('status', 0)->latest()->first();

        if (empty($check)) {
            $s = 0;
            $m = 'Code expired,please resend code.';
        } else if ($request->otp != $check->code) {

            $attemp = session()->get('attemp');

            if ($attemp == 0) {
                session(['attemp' => 0]);
                $s = 2;
                $a = $attemp;
                $m = 'Too many attempts, account blocked';

                $user->status = 0;
                $user->save();
                Auth::logout($user);
            } else {

                if ($attemp == 0) {
                    $attemps = 0;
                } else {
                    $attemps = $attemp - 1;
                }

                session(['attemp' => $attemps]);

                $s = 4;
                $a = $attemps;
                $m = 'Invalid Code.';
            }

            return response()->json([
                'status' => $s,
                'message' => $m,
                'otp_attempt' => $a
            ]);
        } else if ($check->expired_at < Carbon::now()) {
            $check->delete();
            $s = 0;
            $m = 'Code expired, please resend code.';
        } else {
            $user->last_login_ip = $request->ip();
            $user->last_login_time = Carbon::now();
            $user->last_logout_time = Carbon::now();
            $user->login_verifed = 1;
            $user->save();
            $check->delete();
            $user->save();
            $s = 1;
            $m = 'Success';
        }

        $loginHistory = new LoginHistory();
        $loginHistory->agent_id = $user->id;
        $loginHistory->ip_address = $request->ip();
        $loginHistory->country = geoLocation($request->ip())->country . ' / ' . geoLocation($request->ip())->city;
        $loginHistory->login_time = Carbon::now();
        $loginHistory->save();

        return response()->json([
            'status' => $s,
            'message' => $m
        ]);
    }

    public function verifyCodeResend(Request $request)
    {
        $user = Admin::find(auth()->user()->id);
        $check = RequestOtp::where('user_id', auth()->user()->id)->where('action', 'auth')->where('status', 0)->latest()->first();
        $check->code = rand(100000, 999999);
        $check->expired_at = Carbon::now()->addMinutes(5);
        $check->save();
        Mail::to($user->email)->queue(new TwoFactor(setting()->brand_name, setting()->logo, $user->username, $user->agent_id, $check->code, env('MAIL_FROM_ADDRESS'),));
        return response()->json([
            'status' => 1,
            'message' => 'OTP has been send to your email'
        ]);
    }
}
