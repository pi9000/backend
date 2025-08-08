<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Http;

class WebSettingController extends Controller
{
    public function index(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
        ];
        $data = curl_post('settings/website', $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.Website.WebSetting.index', compact('data'));
    }

    public function edit_website(Request $request)
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

        if ($request->hasFile('icon_web')) {
            $url = $request->file('icon_web')->storePublicly(
                'imageFiles',
                's3'
            );

            $icon_web = config('filesystems.disks.s3.url') . $url;
        } else {
            $icon_web = $request->icon_web_url;
        }
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'judul' => $request->judul,
            'logo' => $logo,
            'icon_web' => $icon_web,
            'title' => $request->title,
            'keyword' => $request->keyword,
            'deskripsi' => $request->deskripsi,
            'notif_bar' => $request->notif_bar,
            'no_whatsapp' => $request->no_whatsapp,
            'script' => $request->script,
            'min_depo' => $request->min_depo,
            'min_wd' => $request->min_wd,
            'tutorial_register' => $request->tutorial_register,
            'tutorial_deposit' => $request->tutorial_deposit,
            'tutorial_withdraw' => $request->tutorial_withdraw,
            'home_footer' => $request->home_footer,
            'gateway_merchant' => $request->gateway_merchant,
            'gateway_apikey' => $request->gateway_apikey,
            'gateway_secretkey' => $request->gateway_secretkey,
            'gateway_endpoint' => $request->gateway_endpoint,
            'telegram_chat_id' => $request->telegram_chat_id,
            'costum_script' => $request->costum_script,
            'warna' => $request->web_styles,
        ];
        $data = curl_post_form('settings/website/update', $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect()->back()->with('error', $data->message);
        }
        return redirect()->back()->with('success', $data->message);
    }

    public function edit_api(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'apikey' => $request->apikey,
            'secretkey' => $request->secretkey,
            'url' => $request->url,
            'agentcode' => $request->agentcode,
        ];
        $data = curl_post('settings/api/update/' . $request->id, $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect()->back()->with('error', $data->message);
        }
        return redirect()->back()->with('success', $data->message);
    }

    public function domainSettings(Request $request)
    {
        return view('page.Website.WebSetting.domain');
    }

    public function cloudflareList($agent_id)
    {
        $params = [
            'agent_id' => $agent_id,
        ];
        $data = curl_post('settings/domain_list', $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.Website.cloudflare.list', compact('data'));
    }

    public function bulkStatusCloudflare(Request $request)
    {
        $zoneIds = $request->input('zones', []);

        $statuses = [];

        foreach ($zoneIds as $zoneId) {
            $response = Http::withToken(env('CLOUDFLARE_API_TOKEN'))->get("https://api.cloudflare.com/client/v4/zones/{$zoneId}");

            $statuses[$zoneId] = $response->successful()
                ? $response->json('result.status')
                : 'error';
        }

        return response()->json(['status' => $statuses]);
    }

    public function add_domain(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'domain' => $request->domain
        ];
        $data = curl_post('settings/domain/add', $params, auth()->user()->brand_id);
        return response()->json([
            'status' => $data->status,
            'message' => $data->message,
        ]);
    }

    public function remove_domain($id)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
        ];
        $data = curl_post('settings/domain/remove/' . $id, $params, auth()->user()->brand_id);
        return response()->json([
            'status' => $data->status,
            'message' => $data->message,
        ]);
    }

    public function sliding_banner(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
        ];
        $data = curl_post('settings/sliding_banner', $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.Website.WebSetting.sliding_banner', compact('data'));
    }

    public function sliding_banner_post(Request $request)
    {
        if ($request->hasFile('banner_image')) {
            $url = $request->file('banner_image')->storePublicly(
                'banner_image',
                's3'
            );

            $banner_image = config('filesystems.disks.s3.url') . $url;
        } else {
            return redirect()->back()->with('error', 'Banner image is required.');
        }

        $params = [
            'agent_id' => auth()->user()->agent_id,
            'banner_image' => $banner_image,
        ];
        $data = curl_post('settings/sliding_banner/create', $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect()->back()->with('error', $data->message);
        }
        return redirect()->back()->with('success', $data->message);
    }

    public function sliding_banner_delete($id,Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
        ];
        $data = curl_post('settings/sliding_banner/delete/' . $id, $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect()->back()->with('error', $data->message);
        }
        return redirect()->back()->with('success', $data->message);
    }
}
