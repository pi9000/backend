<?php

use Illuminate\Support\Str;
use App\Models\PanelSetting;
use App\Models\Admin;
use App\Models\BrandList;
use App\Models\LogActivity;

function censor_email($email)
{
    $parts = explode("@", $email);
    if (count($parts) !== 2) return $email;

    $name = substr($parts[0], 0, 2) . '****';
    $domain = explode(".", $parts[1]);

    return $name . '@' . substr($domain[0], 0, 2) . '***.' . end($domain);
}


function generateCustomPrefix()
{
    $firstDigit = rand(1, 9);
    $randomLetters = Str::upper(Str::random(4));
    $fixedSuffix = 'AA';

    return $firstDigit . $randomLetters . $fixedSuffix;
}


function currencyFormat($num, $dec)
{
    $number = number_format($num, 2, '.', ',');
    return $number;
}


function setting()
{
    $setting = PanelSetting::first();

    return $setting;
}

function geoLocation($ip)
{
    $url = "http://ip-api.com/json/{$ip}";
    $response = file_get_contents($url);
    $data = json_decode($response, false);
    return $data;
}

function applogo()
{
    if (auth()->user()->logo != NULL) {
        $setting = Admin::find(auth()->user()->id);
    } else {
        $setting = PanelSetting::first();
    }

    return $setting;
}

function getTemplates($id)
{
    $template = BrandList::where('id', $id)->first();
    if ($template) {
        return $template;
    } else {
        return null;
    }
}

function curl_post_form($url, $data,$brand_id)
{
    $brand = BrandList::where('id', $brand_id)->first();
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $brand->domain_api .'/api/bo/v2/' . $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded',
            'X-API-KEY: ' . $brand->access_key,
            'X-SECRET-KEY: ' . $brand->secret_key
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);
}

function curl_post($url, $data,$brand_id)
{
    $brand = BrandList::where('id', $brand_id)->first();
    $jsonData = json_encode($data);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $brand->domain_api .'/api/bo/v2/' . $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => array(
            'X-API-KEY: ' . $brand->access_key,
            'X-SECRET-KEY: ' . $brand->secret_key,
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);
}

function logActivity($userId, $agent_id,$action,$description,$ip_address)
{
    $log = new LogActivity();
    $log->user_id = $userId;
    $log->agent_id = $agent_id;
    $log->action = $action;
    $log->description = $description;
    $log->ip_address = $ip_address;
    $log->country = geoLocation($ip_address)->country ?? null;
    $log->status = 0;
    $log->save();
}
