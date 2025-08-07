<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrandList;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class MasterController extends Controller
{
    public function index()
    {
        if (auth()->user()->roles != 0) {
            return redirect('/dashboard');
        }

        $template = BrandList::get();
        return view('page.master.brand_management', compact('template'));
    }

    public function brand_management($id)
    {
        if (auth()->user()->roles != 0) {
            return redirect('/dashboard');
        }

        $template = BrandList::where('id', $id)->first();
        $params = [
            'agent_id' => auth()->user()->agent_id,
        ];
        $data = curl_post('brand_management', $params, $id);
        if ($data->status != 'success') {
            return redirect()->back()->with('error', $data->message);
        }
        $template_list = BrandList::get();
        return view('page.master.brand_management_table', compact('template', 'template_list', 'data'));
    }

    public function create_brand(Request $request)
    {
        if (auth()->user()->roles != 0) {
            return redirect('/dashboard');
        }


        $template = BrandList::where('id', $request->template)->first();
        if (empty($template)) {
            return redirect()->back()->with('error', 'Template not found');
        }
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'title' => $request->title,
            'apikey_nexusggr' => $request->apikey_nexusggr,
            'agentcode_nexusggr' => $request->agentcode_nexusggr,
            'secretkey_nexusggr' => $request->secretkey_nexusggr,
            'apikey_reviplay' => $request->apikey_reviplay,
            'agentcode_reviplay' => $request->agentcode_reviplay,
            'secretkey_reviplay' => $request->secretkey_reviplay
        ];
        $data = curl_post('brand_management/create', $params, $request->template);
        if ($data->status != 'success') {
            return redirect()->back()->with('error', $data->message);
        }

        $user =  new Admin();
        $user->agent_id    = $data->agent_id;
        $user->agent_code    = $data->agent_id;
        $user->fullname    = $request->username;
        $user->username    = $request->username;
        $user->email    = $request->email;
        $user->password    = Hash::make($request->password);
        $user->secure_pin = Hash::make(000000);
        $user->balance    = $request->balance;
        $user->currency    = auth()->user()->currency;
        $user->status    = 1;
        $user->brand_id    = $request->template;
        $user->created_by    = auth()->user()->username;
        $user->permissions    = auth()->user()->permissions;
        $user->save();

        return redirect()->back()->with('success', $data->message);
    }

    public function delete_brand($id, Request $request)
    {
        if (auth()->user()->roles != 0) {
            return redirect('/dashboard');
        }

        $params = [
            'agent_id' => auth()->user()->agent_id,
        ];
        $data = curl_post('brand_management/' . $id . '/delete', $params, $request->brand_id);
        if ($data->status != 'success') {
            return redirect()->back()->with('error', $data->message);
        }

        Admin::where('agent_id', $id)->delete();

        return redirect()->back()->with('success', $data->message);
    }

    public function account_management()
    {
        if (auth()->user()->roles != 0) {
            return redirect('/dashboard');
        }

        $admin = Admin::where('username', '!=', 'mastersite')
            ->whereColumn('agent_id', 'agent_code')
            ->get();
        return view('page.master.account_management', compact('admin'));
    }

    public function account_management_table(Request $request)
    {
        if (auth()->user()->roles != 0) {
            return redirect('/dashboard');
        }

        $admin = Admin::where('username', '!=', 'mastersite')
            ->whereColumn('agent_id', 'agent_code')
            ->get();
        return view('page.master.account_management_table', compact('admin'));
    }

    public function game_providers()
    {
        if (auth()->user()->roles != 0) {
            return redirect('/dashboard');
        }

        $template = BrandList::get();
        return view('page.master.game_providers', compact('template'));
    }

    public function game_providers_table($id)
    {
        if (auth()->user()->roles != 0) {
            return redirect('/dashboard');
        }

        $template = BrandList::where('id', $id)->first();
        $params = [
            'agent_id' => auth()->user()->agent_id,
        ];
        $data = curl_post('provider_list', $params, $id);
        if ($data->status != 'success') {
            return redirect()->back()->with('error', $data->message);
        }
        $template_list = BrandList::get();
        return view('page.master.game_providers_table', compact('template', 'template_list', 'data'));
    }

    public function game_providers_update($id, Request $request)
    {
        if (auth()->user()->roles != 0) {
            return redirect('/dashboard');
        }

        $template = BrandList::where('id', $id)->first();
        if (empty($template)) {
            return redirect()->back()->with('error', 'Template not found');
        }

        if ($request->hasFile('banner')) {
            $url = $request->file('banner')->storePublicly(
                'providers_image',
                's3',
            );

            $banner = config('filesystems.disks.s3.url') . $url;
        } else {
            $banner = $request->banner_url;
        }

        if ($request->hasFile('icon')) {
            $url = $request->file('icon')->storePublicly(
                'providers_image',
                's3'
            );

            $icon = config('filesystems.disks.s3.url') . $url;
        } else {
            $icon = $request->icon_url;
        }

        $params = [
            'agent_id' => auth()->user()->agent_id,
            'id' => $request->id,
            'icon' => $icon,
            'banner' => $banner,
            'status' => $request->status
        ];
        $data = curl_post('provider_list/update_provider', $params, $id);
        if ($data->status != 'success') {
            return redirect()->back()->with('error', $data->message);
        }

        return redirect()->back()->with('success', $data->message);
    }

    public function game_list_management(Request $request)
    {
        if (auth()->user()->roles != 0) {
            return redirect('/dashboard');
        }

        $template = BrandList::find($request->t);
        if (empty($template)) {
            return redirect()->back()->with('error', 'Template not found');
        }

        $params = [
            'agent_id' => auth()->user()->agent_id,
        ];
        $data = curl_post('provider_list/game_lists/' . $request->i, $params, $request->t);
        if ($data->status != 'success') {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.master.game_list_management', compact('template', 'data'));
    }


    public function game_list_management_update($id, Request $request)
    {
        if (auth()->user()->roles != 0) {
            return redirect('/dashboard');
        }

        $template = BrandList::where('id', $id)->first();
        if (empty($template)) {
            return redirect()->back()->with('error', 'Template not found');
        }

        if ($request->hasFile('banner')) {
            $url = $request->file('banner')->storePublicly(
                'providers_image',
                's3',
            );

            $banner = config('filesystems.disks.s3.url') . $url;
        } else {
            $banner = $request->game_image_url;
        }

        $params = [
            'agent_id' => auth()->user()->agent_id,
            'id' => $request->id,
            'game_image' => $banner,
            'sequence' => $request->sequence
        ];
        $data = curl_post('provider_list/game_lists/'.$request->id.'/update', $params, $id);
        if ($data->status != 'success') {
            return redirect()->back()->with('error', $data->message);
        }

        return redirect()->back()->with('success', $data->message);
    }
}
