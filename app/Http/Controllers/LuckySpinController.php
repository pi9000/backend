<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LuckySpinController extends Controller
{
    public function index(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
        ];
        $data = curl_post('settings/lucky_whell', $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.tools.luckyspin.index', compact('data'));
    }

    public function post_index(Request $request)
    {
        if ($request->hasFile('logo')) {
            $url = $request->file('logo')->storePublicly(
                'imageFiles',
                's3',
            );

            $logo = config('filesystems.disks.s3.url') . $url;
        } else {
            $logo = $request->logo_url;
        }

        if ($request->hasFile('favicon')) {
            $url = $request->file('favicon')->storePublicly(
                'imageFiles',
                's3'
            );

            $favicon = config('filesystems.disks.s3.url') . $url;
        } else {
            $favicon = $request->favicon_url;
        }

        if ($request->hasFile('spinner')) {
            $url = $request->file('spinner')->storePublicly(
                'imageFiles',
                's3',
            );

            $spinner = config('filesystems.disks.s3.url') . $url;
        } else {
            $spinner = $request->spinner_url;
        }

        if ($request->hasFile('background')) {
            $url = $request->file('background')->storePublicly(
                'imageFiles',
                's3'
            );

            $background = config('filesystems.disks.s3.url') . $url;
        } else {
            $background = $request->background_url;
        }

        if ($request->hasFile('background_mobile')) {
            $url = $request->file('background_mobile')->storePublicly(
                'imageFiles',
                's3',
            );

            $background_mobile = config('filesystems.disks.s3.url') . $url;
        } else {
            $background_mobile = $request->background_mobile_url;
        }

        $params = [
            'agent_id' => auth()->user()->agent_id,
            'brand' => $request->brand,
            'title' => $request->title,
            'logo' => $logo,
            'favicon' => $favicon,
            'spinner' => $spinner,
            'background' => $background,
            'background_mobile' => $background_mobile,
            'gameOverText' => $request->gameOverText,
            'invalidSpinText' => $request->invalidSpinText,
            'introText' => $request->introText,
            'spin_text' => $request->spin_text,
            'history_text' => $request->history_text,
            'prize_text' => $request->prize_text,
        ];
        $data = curl_post('settings/lucky_whell/update', $params, auth()->user()->brand_id);
        return redirect()->back()->with($data->status, $data->message);
    }

    public function prize_index(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
        ];
        $data = curl_post('settings/lucky_whell', $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.tools.luckyspin.prize', compact('data'));
    }

    public function prize_delete(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'id' => $request->uid,
        ];
        $data = curl_post('settings/lucky_whell/luckywheel_prize_delete', $params, auth()->user()->brand_id);
        return redirect()->back()->with($data->status, $data->message);
    }

    public function prize_create(Request $request)
    {
        return view('page.tools.luckyspin.create');
    }

    public function prize_create_new(Request $request)
    {
        if ($request->hasFile('image')) {
            $url = $request->file('image')->storePublicly(
                'imageFiles',
                's3',
            );

            $image = config('filesystems.disks.s3.url') . $url;
        } else {
            $image = 'nol';
        }

        $params = [
            'agent_id' => auth()->user()->agent_id,
            'title' => $request->title,
            'image' => $image,
            'probability' => $request->probability,
            'win' => $request->win,
        ];
        $data = curl_post('settings/lucky_whell/prize', $params, auth()->user()->brand_id);
        return redirect()->back()->with($data->status, $data->message);
    }
}
