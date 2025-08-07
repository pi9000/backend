<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\RequestOtp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function myprofile(Request $request)
    {
        $pageTitle = 'Profile Settings';
        return view('account.myprofile', compact('pageTitle'));
    }

    public function update_profile_username(Request $request)
    {
        $request->validate([
            'new_username' => 'required|string|min:6',
        ]);

        $user = Admin::find(auth()->user()->id);

        $check = RequestOtp::where('user_id', auth()->user()->id)->where('action', 'Update Username')->where('status', 0)->latest()->first();


        if (empty($check)) {
            $s = 0;
            $m = 'OTP Code expired,please resend code.';
        } else if ($request->otp_verify_username != $check->code) {
            $s = 0;
            $m = 'Invalid OTP Code.';
        } else if ($check->expired_at < Carbon::now()) {
            $check->delete();
            $s = 0;
            $m = 'OTP Code expired, please resend code.';
        } else {
            $user->username = $request->new_username;
            $check->delete();
            $user->save();
            $s = 200;
            $m = 'Username Changed';
        }

        return response()->json([
            'status' => $s,
            'm' => $m
        ]);
    }

    public function update_profile_pin(Request $request)
    {
        $user = Admin::find(auth()->user()->id);

        $request->validate([
            'new_password' => 'required|numeric|min:6|max:6',
        ]);

        $check = RequestOtp::where('user_id', auth()->user()->id)->where('action', 'Update Second PIN')->where('status', 0)->latest()->first();


        if (empty($check)) {
            $s = 0;
            $m = 'OTP Code expired,please resend code.';
        } else if ($request->otp_verify_username != $check->code) {
            $s = 0;
            $m = 'Invalid OTP Code.';
        } else if ($check->expired_at < Carbon::now()) {
            $check->delete();
            $s = 0;
            $m = 'OTP Code expired, please resend code.';
        } else {
            $user->second_pin = Hash::make($request->new_pin);
            $check->delete();
            $user->save();
            $s = 200;
            $m = 'Second PIN Changed';
        }

        return response()->json([
            'status' => $s,
            'm' => $m
        ]);
    }

    public function update_profile_password(Request $request)
    {

        $request->validate([
            'new_password' => 'required|string|min:6',
        ]);

        $user = Admin::find(auth()->user()->id);

        $check = RequestOtp::where('user_id', auth()->user()->id)->where('action', 'Update Second PIN')->where('status', 0)->latest()->first();


        if (empty($check)) {
            $s = 0;
            $m = 'OTP Code expired,please resend code.';
        } else if ($request->otp_verify_username != $check->code) {
            $s = 0;
            $m = 'Invalid OTP Code.';
        } else if ($check->expired_at < Carbon::now()) {
            $check->delete();
            $s = 0;
            $m = 'OTP Code expired, please resend code.';
        } else if (!Hash::check($request->old_password, $user->password)) {
            $s = 0;
            $m = 'Invalid  Old Password';
        } else {
            $user->password = Hash::make($request->new_password);
            $check->delete();
            $user->save();
            $s = 200;
            $m = 'Second PIN Changed';
        }

        return response()->json([
            'status' => $s,
            'm' => $m
        ]);
    }

    public function upload_app_logo(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,svg,jpg,gif,webp|max:2240',
        ]);

        $file_name = $request->file('file')->storePublicly(
            'AppBrandLogo',
            's3',
            'public'
        );
        $user = Admin::find(auth()->user()->id);
        if ($request->title == 'favicon') {
            $user->favicon = $file_name;
        } else {
            $user->logo = $file_name;
        }
        $user->save();

        return response()->json([
            'status' => 200,
            'm' => 'App Logo Has Updated'
        ]);
    }
}
